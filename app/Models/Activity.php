<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Menambahkan 'name' ke dalam fillable
        'activity_date',
    ];

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function roas()
    {
        return $this->hasMany(ROA::class);
    }

    public function coas()
    {
        return $this->hasMany(Coa::class);
    }

    public function ashanls()
    {
        return $this->hasMany(Ashanls::class);
    }

    
}
