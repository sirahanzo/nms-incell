<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PollingAlarmDevices extends Model {


    protected $table = 'polling_alarm_devices';

    protected $fillable = [
        'site_oid',
        'device_node_id',
        'parameter_id',
        'pack1',
        'pack2',
        'pack3',
        'pack4',
        'pack5',
        'pack6',
        'pack7',
        'pack8',
        'pack9',
        'pack10',
        'pack11',
        'pack12',
        'pack13',
        'pack14',
        'pack15',
    ];


    public function parameters()
    {
        return $this->belongsTo(Parameters::class, 'parameter_id', 'id');
    }


    public function getPack1Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack2Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack3Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack4Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack5Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack6Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack7Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack8Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack9Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack10Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack11Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack12Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack13Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack14Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }


    public function getPack15Attribute($value)
    {
        return ($value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
    }
}
