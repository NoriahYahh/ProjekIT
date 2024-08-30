<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalCompany extends Model
{
    use HasFactory;

    protected $table = 'international_companies';

    protected $fillable = ['name'];

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'company_id');
    }
    public function domesticCompanies()
    {
        return $this->hasMany(DomesticCompany::class);
    }
}
