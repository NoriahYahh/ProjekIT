<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROA extends Model
{
    use HasFactory;

    protected $fillable = [
        'tm',
        'im',
        'ash',
        'ash2',
        'vm',
        'fc',
        'ts',
        'Adb',
        'Arb',
        'Daf',
        'Analisis_Standar',
        'activity_id' // Tambahkan activity_id
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
