<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model {


    protected $table = 'owners';

    protected $fillable = [
        'corporation_name',
        'alias',
        'address',
        'corporation_email',
        'phone',
        'fax',
        'website',
        'icon',
    ];


    public function region()
    {
        return $this->hasMany(Region::class, 'owner_id', 'id');
    }


    public function city()
    {
        return $this->hasMany(City::class, 'region_oid', 'oid');
    }


    public function site()
    {
        return $this->hasMany(Site::class, 'region_oid', 'oid');
    }
}
