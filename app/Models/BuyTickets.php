<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyTickets extends Model
{
    use HasFactory;

    protected $table = 'buy_tickets';
    protected $primaryKey = 'buy_ticket_id';
}
