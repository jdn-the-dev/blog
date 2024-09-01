<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\PostObserver;

class Post extends Model
{
    protected $table = 'posts';

    // As a best practice, always set up the fillable property on your model!
    protected $fillable = [ 'title', 'blogHTML' ];
    protected $casts = [
        'category' => 'array',
    ];
    public $incrementing = false;
}