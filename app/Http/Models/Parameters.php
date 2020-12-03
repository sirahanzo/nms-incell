<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model {


    protected $table = 'parameters';

    protected $fillable = [
        'device_id',
        'name',
        'alias',
        'group',
        'unit',
        'severity_id',
        'notification_id',
        'minimum',
        'maximum',
        'scale',
        'state',
        'trigger',
    ];


    public function device()
    {
        return $this->belongsTo(DeviceList::class, 'device_id', 'id');
    }


    public function severity()
    {
        return $this->belongsTo(Severity::class, 'severity_id', 'id');
    }


    public function polling_data()
    {
        return $this->hasMany(PollingDataDevices::class, 'parameter_id', 'id');
    }


    public function polling_alarm()
    {
        return $this->hasMany(PollingAlarmDevices::class, 'parameter_id', 'id');
    }
}
