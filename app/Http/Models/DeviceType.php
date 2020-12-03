<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model {


    protected $table = 'device_types';

    protected $fillable = [
       'name',
    ];


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }


    public function device()
    {
        return $this->hasMany(DeviceList::class, 'device_type_id', 'id');
    }

}
