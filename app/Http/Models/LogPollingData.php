<?php

namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LogPollingData extends Model {


    protected $table = 'log_polling_data';

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

    public function setUpdatedAtAttribute($date)
    {
        $this->attributes['updated_at'] = Carbon::parse($date)->format('Y-m-d');
    }
}
