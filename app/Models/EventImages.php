<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImages extends Model
{
    use HasFactory;
    protected $table = 'event_images';
    protected $primaryKey = 'image_id';
}
