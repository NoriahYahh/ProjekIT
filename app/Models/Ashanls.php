<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ashanls extends Model
{
    use HasFactory;
    protected $fillable = [

        'activity_id',
        'cal',
        'si',
        'ai',
        'fe',
        'ca',
        'mg',
        'na',
        'k2',
        'ti',
        'so',
        'mn',
        'p2',
        'un',
        'fofa',
        'slafa',
    ];
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
  
}
