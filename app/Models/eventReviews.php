<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventReviews extends Model
{
    use HasFactory;
    protected $table = 'event_reviews';
    protected $primaryKey = 'review_id';
}
