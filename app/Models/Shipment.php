<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'gar',
        'type',
        'mv',
        'bg',
        'sp',
        'fv',
        'fd',
        'bf',
        'rc',
        'ss',
        'arrival_date',
        'departure_date',
        'cargo',
        'dt',
        'company_id',
        'tg',
        'sv',
        'activity_id' // Tambahkan activity_id
    ];

    // Accessor to calculate duration
    public function getDurationAttribute()
    {
        $arrivalDate = Carbon::parse($this->arrival_date);
        $departureDate = Carbon::parse($this->departure_date);
        return $departureDate->diffInDays($arrivalDate);
    }

    // Relation with DomesticCompany or InternationalCompany based on type
    public function company()
    {
        if ($this->type === 'domestik') {
            return $this->belongsTo(DomesticCompany::class, 'company_id');
        } else {
            return $this->belongsTo(InternationalCompany::class, 'company_id');
        }
    }

    // Relationship with Activity
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function roas()
    {
        return $this->hasMany(Roa::class);
    }
}
