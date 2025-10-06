<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms'; 
    protected $primaryKey = 'id';
     
    protected $fillable = 
    [ 
        'roomnumber', 
        'roomname', 
        'type',
        'capacity', 
        'price', 
        'status', 
        'image_path', 
        'amenities', 
        'description', 
    ]; 
     protected $casts = 
     [ 
        'price' => 'decimal:2', 
        'capacity' => 'integer', ]; 
         
     public function scopeAvailable($query) 
         { 
            return $query->where('status', 'available'); 
        } 
        
     public function getFormattedPriceAttribute() 
     
     { 
        return '₱' . number_format($this->price, 2); 
    }
}
