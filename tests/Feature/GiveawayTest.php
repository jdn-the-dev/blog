<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\GiveawayCampaign;
use App\Models\GiveawayEntry;
use App\Models\SurveyResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GiveawayTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_giveaway_page_is_public(): void
    {
        Carbon::setTestNow('2026-07-25 12:00:00');

        $this->get(route('giveaway.show'))
            ->assertOk()
            ->assertSee('Win $100')
            ->assertSee('August 1, 2026');
    }

    public function test_valid_entry_is_saved_with_private_proof(): void
    {
        Carbon::setTestNow('2026-07-25 12:00:00');
        Storage::fake('local');

        $response = $this->post(route('giveaway.submit'), [
            'name' => 'Taylor Test',
            'email' => 'taylor@example.com',
            'review_name' => 'Taylor T.',
            'review_url' => 'https://example.com/review/123',
            'proof' => UploadedFile::fake()->image('review.png'),
            'rules' => '1',
        ]);

        $response->assertRedirect(route('giveaway.show'));
        $this->assertDatabaseHas('giveaway_entries', [
            'email' => 'taylor@example.com',
            'review_name' => 'Taylor T.',
        ]);

        $path = \App\Models\GiveawayEntry::firstOrFail()->proof_path;
        Storage::disk('local')->assertExists($path);
    }

    public function test_duplicate_email_is_rejected(): void
    {
        Carbon::setTestNow('2026-07-25 12:00:00');
        Storage::fake('local');

        $entry = [
            'name' => 'Taylor Test',
            'email' => 'taylor@example.com',
            'review_name' => 'Taylor T.',
            'proof' => UploadedFile::fake()->image('review.png'),
            'rules' => '1',
        ];

        $this->post(route('giveaway.submit'), $entry);
        $entry['proof'] = UploadedFile::fake()->image('review-again.png');

        $this->post(route('giveaway.submit'), $entry)
            ->assertSessionHasErrors('email');
    }

    public function test_entries_close_after_deadline(): void
    {
        Carbon::setTestNow('2026-08-02 12:00:00');

        $this->post(route('giveaway.submit'), [])->assertForbidden();
    }

    public function test_admin_entry_list_requires_login(): void
    {
        $this->get(route('admin.giveaway.index'))
            ->assertRedirect(route('login'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.giveaway.index'))
            ->assertRedirect(route('admin.posts.index').'#giveaways');
    }

    public function test_admin_can_update_and_pause_campaign(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)->put(route('admin.giveaway.update'), [
            'name' => 'Titan summer giveaway',
            'headline' => 'Try Titan. Win $250.',
            'description' => 'A newly updated campaign.',
            'prize_amount' => 250,
            'download_url' => 'https://example.com/titan',
            'starts_at' => '2026-08-01T09:00',
            'ends_at' => '2026-08-08T21:30',
            'minimum_age' => 21,
            'eligible_region' => 'New York',
            'winner_message' => 'This campaign is now closed.',
        ])->assertRedirect(route('admin.giveaway.edit'));

        $campaign = GiveawayCampaign::current()->fresh();
        $this->assertFalse($campaign->is_active);
        $this->assertSame('Try Titan. Win $250.', $campaign->headline);
        $this->assertSame('2026-08-08 21:30', $campaign->ends_at->timezone('America/New_York')->format('Y-m-d H:i'));
    }

    public function test_admin_can_archive_campaign_and_start_a_fresh_entry_pool(): void
    {
        Carbon::setTestNow('2026-07-25 12:00:00');
        $admin = User::factory()->create();
        $oldCampaign = GiveawayCampaign::current();
        GiveawayEntry::create([
            'campaign_id' => $oldCampaign->id,
            'name' => 'Archived Entrant',
            'email' => 'repeat@example.com',
            'review_name' => 'Reviewer',
            'proof_path' => 'giveaway-proofs/old.png',
            'rules_accepted_at' => now(),
        ]);

        $this->actingAs($admin)
            ->post(route('admin.giveaway.close'))
            ->assertRedirect(route('admin.posts.index').'#giveaways');

        $this->assertNotNull($oldCampaign->fresh()->closed_at);

        $this->post(route('admin.giveaway.new'))
            ->assertRedirect(route('admin.giveaway.edit'));

        $newCampaign = GiveawayCampaign::current();
        $this->assertNotSame($oldCampaign->id, $newCampaign->id);
        $this->assertTrue($newCampaign->isOpen());
        $this->assertSame(0, $newCampaign->entries()->count());
        $this->assertSame(1, $oldCampaign->entries()->count());

        $this->get(route('admin.posts.index', ['campaign' => $oldCampaign->id]))
            ->assertOk()
            ->assertSee('Archived Entrant');
    }

    public function test_main_admin_page_combines_current_and_historical_giveaway_stats(): void
    {
        $campaign = GiveawayCampaign::current();
        GiveawayEntry::create([
            'campaign_id' => $campaign->id,
            'name' => 'Current Entrant',
            'email' => 'current@example.com',
            'review_name' => 'Current Reviewer',
            'proof_path' => 'giveaway-proofs/current.png',
            'rules_accepted_at' => now(),
        ]);
        SurveyResponse::create([
            'experience' => 'beginner',
            'has_traded' => 'no',
            'frequency' => 'weekly',
            'risk_tolerance' => 'medium',
            'motivation' => 'learning',
            'email' => 'legacy@example.com',
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.posts.index'))
            ->assertOk()
            ->assertSee('Giveaway dashboard')
            ->assertSee('Current Entrant')
            ->assertSee('Historical $40 crypto survey')
            ->assertSee('legacy@example.com');
    }
}
