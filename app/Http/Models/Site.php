<?php

namespace App\Http\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Site extends Model {


    protected $table = 'sites';

    protected $fillable = [
        'owner_id',
        'region_oid',
        'city_oid',
        'oid',
        'name',
        'site_id_label',
        'address',
        'longitude',
        'latitude',
        'total_pack',
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


    public function city()
    {
        return $this->belongsTo(City::class, 'city_oid', 'oid');
    }


    public function node()
    {
        return $this->hasMany(DeviceNode::class, 'site_oid', 'oid');
    }


    public function sn_pack()
    {
        return $this->hasOne(SerialNumberPack::class,'site_oid','oid');
    }

    public function pollingDataDevices()
    {
        return $this->hasMany(PollingDataDevices::class, 'site_oid', 'oid');
    }
    //
    //public function temporaryAlarm()
    //{
    //    return $this->hasMany(TemporaryAlarm::class,'site_oid','oid');
    //}

}
