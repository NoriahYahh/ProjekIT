<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomesticCompany extends Model
{
    use HasFactory;

    protected $table = 'domestic_companies';

    protected $fillable = ['name'];

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'company_id');
    }

    public function internationalCompanies()
    {
        return $this->hasMany(InternationalCompany::class, 'foreign_key', 'local_key');
    }

    public static function findById($id)
    {
        return self::where('id', $id)->first();
    }
}
