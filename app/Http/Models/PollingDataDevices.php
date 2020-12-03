<?php

namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PollingDataDevices extends Model {


    protected $table = 'polling_data_devices';

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
        //'published_at'
    ];


    public function getUpdatedAtAttribute($date)
    {
        return $this->attributes['updated_at'] = Carbon::parse($date)->format('Y-m-d H:i:00');

    }

    public function setUpdatedAtAttribute($date)
    {
        $this->attributes['updated_at'] = Carbon::parse($date)->format('Y-m-d');
            //$this->attributes['published_at'] = Carbon::parse($date)->format('Y-m-d H:i:00');
    }

    public function parameters()
    {
        return $this->belongsTo(Parameters::class,'parameter_id','id');
    }

    public function site(){
        return $this->belongsTo(Site::class,'site_oid','oid');
    }
}
