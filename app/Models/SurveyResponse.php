<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience',
        'has_traded',
        'frequency',
        'risk_tolerance',
        'motivation',
        'email',
    ];
}
