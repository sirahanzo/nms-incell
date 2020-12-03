<?php

namespace App\Http\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class City extends Model {


    protected $table = 'cities';

    protected $fillable = [
        'owner_id',
        'region_oid',
        'oid',
        'name',
        'icon',
    ];


    public function setOidAttribute($value)
    {
        try {
            $this->attributes['oid'] = Uuid::uuid4()->toString();
        } catch (Exception $e) {
        }

    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }


    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }


    public function region()
    {
        return $this->belongsTo(Region::class, 'region_oid', 'oid');
    }


    public function site()
    {
        return $this->hasMany(Site::class, 'city_oid', 'oid');
    }
}
