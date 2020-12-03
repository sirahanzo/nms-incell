<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DailyPowerCalculate extends Model
{
    protected $table = 'daily_power_calculate';

    protected $fillable = [
        'site_oid',
        'pack_id',
        'vbus',
        'ibus',
        'power',
    ];

}
