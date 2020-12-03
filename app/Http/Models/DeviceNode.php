<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceNode extends Model
{
    protected $table = 'device_nodes';

    protected $fillable = [
        'site_oid',
        'device_id',
        'name',
        'poller_ipaddress',
        'serial_number',
        'ipaddress',
        'protocol_monitoring',
        'status',

    ];


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }


    public function site()
    {
        return $this->belongsTo(Site::class, 'site_oid', 'oid');
    }


    public function device()
    {
        return $this->belongsTo(DeviceList::class, 'device_id', 'id');
    }


    //public function polling()
    //{
    //    return $this->hasMany(PollingDataDevice::class, 'device_node_id', 'id');
    //}
    //
    //
    //public function snmp_object()
    //{
    //    return $this->hasMany(DeviceSNMPObject::class, 'device_id', 'device_id');
    //}
    //
    //
    //public function communication()
    //{
    //    return $this->hasOne(Communication::class, 'device_node_id', 'id');
    //}
    //
    //
    //public function log_alarm()
    //{
    //    return $this->hasMany(AlarmLog::class, 'device_node_id', 'id');
    //}
    //
    //
    //public function log_tsm()
    //{
    //    return $this->hasMany(LogPollingDataTSM::class, 'device_node_id', 'id');
    //}
    //
    //
    //public function log_gkf()
    //{
    //    return $this->hasMany(LogPollingDataGKF::class, 'device_node_id', 'id');
    //}
    //
    //
    //public function log_rct()
    //{
    //    return $this->hasMany(LogPollingDataRCT::class, 'device_node_id', 'id');
    //}
    //
    //
    //public function log_bms()
    //{
    //    return $this->hasMany(LogPollingDataBMS::class, 'device_node_id', 'id');
    //}
    //
    //
    //public function temporaryAlarm()
    //{
    //    return $this->hasMany(TemporaryAlarm::class,'device_node_id','id');
    //}
}
