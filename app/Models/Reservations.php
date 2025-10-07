<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $tabel = 'reservations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'guest_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'total_amount',
        'deposit_amount',
        'status',
    ];


    // A reservation belongs to one guest
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'id');
    }

    // A reservation belongs to one room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    // Example helper: check if reservation is active
    public function isActive()
    {
        return in_array($this->status, ['Confirmed', 'Checked In']);
    }

    // Example helper: calculate total stay days
    public function getStayDurationAttribute()
    {
        return $this->check_in_date && $this->check_out_date
            ? \Carbon\Carbon::parse($this->check_in_date)->diffInDays($this->check_out_date)
            : 0;
    }
}
