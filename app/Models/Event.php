<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Event extends Model
{
    protected $fillable = [
        'organizer_id',
        'title',
        'category_id',
        'status',
        'description',
        'venue',
        'event_date',
        'ticket_price',
        'total_tickets',
        'image',
    ];
    
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}


