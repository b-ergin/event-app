<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'quantity',
        'total_price',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
