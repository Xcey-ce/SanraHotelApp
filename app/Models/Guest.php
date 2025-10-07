<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table = 'guests'; 
    protected $primaryKey = 'id';

    protected $fillable = 
    [ 
        'name', 
        'email', 
        'phone',
        'id_type', 
        'id_number', 
        'address', 
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
     
}
