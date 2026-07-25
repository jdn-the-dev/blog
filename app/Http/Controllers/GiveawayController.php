<?php

namespace App\Http\Controllers;

use App\Models\GiveawayEntry;
use App\Models\GiveawayCampaign;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class GiveawayController extends Controller
{
    public function show()
    {
        $campaign = GiveawayCampaign::current();

        return view('giveaway', [
            'campaign' => $campaign,
            'startsAt' => $campaign->entryStartsAt()->timezone('America/New_York'),
            'deadline' => $campaign->ends_at->timezone('America/New_York'),
            'isOpen' => $campaign->isOpen(),
            'downloadUrl' => $campaign->download_url,
        ]);
    }

    public function submit(Request $request)
    {
        $campaign = GiveawayCampaign::current();
        abort_unless($campaign->isOpen(), 403, 'This giveaway is not accepting entries.');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email:rfc',
                'max:255',
                Rule::unique('giveaway_entries', 'email')
                    ->where(fn ($query) => $query->where('campaign_id', $campaign->id)),
            ],
            'review_name' => ['required', 'string', 'max:100'],
            'review_url' => ['nullable', 'url:http,https', 'max:2048'],
            'proof' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
            'rules' => ['accepted'],
        ], [
            'email.unique' => 'This email address has already been entered.',
            'proof.max' => 'The proof file must be 5 MB or smaller.',
            'rules.accepted' => 'You must accept the giveaway rules to enter.',
        ]);

        $path = $request->file('proof')->store('giveaway-proofs', 'local');

        try {
            GiveawayEntry::create([
                'campaign_id' => $campaign->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'review_name' => $validated['review_name'],
                'review_url' => $validated['review_url'] ?? null,
                'proof_path' => $path,
                'rules_accepted_at' => now(),
            ]);
        } catch (\Throwable $exception) {
            Storage::disk('local')->delete($path);
            throw $exception;
        }

        return redirect()
            ->route('giveaway.show')
            ->with('success', 'You’re entered! We’ll contact the winner by email after the giveaway closes.');
    }

    public function index()
    {
        return redirect(route('admin.posts.index').'#giveaways');
    }

    public function edit()
    {
        return view('admin.giveaway.edit', [
            'campaign' => GiveawayCampaign::current(),
        ]);
    }

    public function update(Request $request)
    {
        $campaign = GiveawayCampaign::current();
        abort_if($campaign->closed_at, 409, 'Archived campaigns cannot be reopened or edited.');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'headline' => ['required', 'string', 'max:160'],
            'description' => ['required', 'string', 'max:1000'],
            'prize_amount' => ['required', 'numeric', 'min:1', 'max:1000000'],
            'download_url' => ['nullable', 'url:http,https', 'max:2048'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'minimum_age' => ['required', 'integer', 'min:18', 'max:99'],
            'eligible_region' => ['required', 'string', 'max:120'],
            'winner_message' => ['nullable', 'string', 'max:500'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['starts_at'] = CarbonImmutable::parse(
            $validated['starts_at'],
            'America/New_York'
        )->utc();
        $validated['ends_at'] = CarbonImmutable::parse(
            $validated['ends_at'],
            'America/New_York'
        )->utc();
        $campaign->update($validated);

        return redirect()
            ->route('admin.giveaway.edit')
            ->with('success', 'Campaign settings updated.');
    }

    public function close()
    {
        $campaign = GiveawayCampaign::current();

        if ($campaign->closed_at) {
            return back()->with('success', 'This campaign is already archived.');
        }

        $campaign->update([
            'is_active' => false,
            'closed_at' => now(),
        ]);

        return redirect(route('admin.posts.index').'#giveaways')
            ->with('success', 'Campaign closed and archived. Its entries and proofs remain available below.');
    }

    public function startNew()
    {
        $campaign = DB::transaction(function () {
            GiveawayCampaign::where('is_active', true)->update([
                'is_active' => false,
                'closed_at' => now(),
            ]);

            $previous = GiveawayCampaign::latest('id')->first();

            return GiveawayCampaign::create([
                'name' => 'New Titan giveaway',
                'headline' => 'Download. Review. Win $100.',
                'description' => 'Try the Titan app, leave an honest review, and send us your proof for a chance to win.',
                'prize_amount' => $previous?->prize_amount ?? 100,
                'download_url' => $previous?->download_url,
                'starts_at' => now(),
                'ends_at' => now('America/New_York')->addWeek()->endOfDay()->utc(),
                'minimum_age' => $previous?->minimum_age ?? 18,
                'eligible_region' => $previous?->eligible_region ?? 'Worldwide, where legally permitted',
                'is_active' => true,
                'winner_message' => 'The winner will be contacted by email after the giveaway closes.',
            ]);
        });

        return redirect()
            ->route('admin.giveaway.edit')
            ->with('success', 'A fresh campaign has started with zero entries. Review its settings below.');
    }

    public function proof(GiveawayEntry $entry)
    {
        abort_unless(Storage::disk('local')->exists($entry->proof_path), 404);

        return Storage::disk('local')->download(
            $entry->proof_path,
            'titan-proof-'.$entry->id.'.'.pathinfo($entry->proof_path, PATHINFO_EXTENSION)
        );
    }
}
