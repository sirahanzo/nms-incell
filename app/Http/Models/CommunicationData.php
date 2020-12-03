<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CommunicationData extends Model {


    protected $table = "communication_data";

    protected $fillable = [
        'device_node_id',
        'monitoring_status',
        'alarm_status',
    ];



}
