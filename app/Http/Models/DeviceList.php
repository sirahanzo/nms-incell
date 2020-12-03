<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceList extends Model {


    protected $table = 'devices';

    protected $fillable = [
        'manufacturer_id',
        'device_type_id',
        'name',
        'api_key',
        'api_label',
        //'protocol',
        //'snmp_version',
        //'snmp_timeout',
        //'snmp_retries',
        //'snmp_read',
        //'snmp_write',
        //'snmp_port',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'api_key',
        //'api_label',
    ];


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }


    public function manufacture()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }


    public function device_type()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id', 'id');
    }


    public function parameter()
    {
        return $this->hasMany(Parameters::class, 'device_id', 'id');
    }


    //public function trap_object()
    //{
    //    return $this->hasMany(DeviceSNMPTrap::class, 'device_id', 'id');
    //}
}
