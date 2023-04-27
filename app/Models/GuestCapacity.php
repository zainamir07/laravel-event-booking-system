<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCapacity extends Model
{
    use HasFactory;
    protected $table = 'guest_capacities';
    protected $primaryKey = 'guest_capacity_id';
}
