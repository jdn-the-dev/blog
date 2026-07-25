<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiveawayEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'campaign_id',
        'email',
        'review_name',
        'review_url',
        'proof_path',
        'rules_accepted_at',
    ];

    protected $casts = [
        'rules_accepted_at' => 'datetime',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(GiveawayCampaign::class, 'campaign_id');
    }
}
