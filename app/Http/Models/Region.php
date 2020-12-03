<?php

namespace App\Http\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Region extends Model {


    protected $table = 'regions';

    protected $fillable = [
        'owner_id',
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


    public function city()
    {
        return $this->hasMany(City::class, 'region_oid', 'oid');
    }


    public function site()
    {
        return $this->hasMany(Site::class, 'region_oid', 'oid');
    }


    //public function alarmLog()
    //{
    //    return $this->hasMany(AlarmLog::class, 'region_oid', 'oid');
    //}
}
