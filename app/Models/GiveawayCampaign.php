<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GiveawayCampaign extends Model
{
    protected $fillable = [
        'name',
        'headline',
        'description',
        'prize_amount',
        'download_url',
        'starts_at',
        'ends_at',
        'minimum_age',
        'eligible_region',
        'is_active',
        'winner_message',
        'closed_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
        'prize_amount' => 'decimal:2',
        'closed_at' => 'datetime',
    ];

    public static function current(): self
    {
        return static::where('is_active', true)->latest('id')->first()
            ?? static::latest('id')->first()
            ?? static::create([
            'name' => 'Titan launch giveaway',
            'headline' => 'Download. Review. Win $100.',
            'description' => 'Try the Titan app, leave an honest review, and send us your proof for a chance to win $100.',
            'prize_amount' => 100,
            'download_url' => config('services.titan.download_url'),
            'starts_at' => now(),
            'ends_at' => CarbonImmutable::parse('2026-08-01 23:59:59', 'America/New_York')->utc(),
            'minimum_age' => 18,
            'eligible_region' => 'Worldwide, where legally permitted',
            'is_active' => true,
            'winner_message' => 'The winner will be contacted by email after the giveaway closes.',
        ]);
    }

    public function isOpen(): bool
    {
        return $this->is_active
            && !$this->closed_at
            && now()->gte($this->entryStartsAt())
            && now()->lte($this->ends_at);
    }

    public function entryStartsAt()
    {
        return $this->starts_at ?? $this->created_at;
    }

    public function entries(): HasMany
    {
        return $this->hasMany(GiveawayEntry::class, 'campaign_id');
    }
}
