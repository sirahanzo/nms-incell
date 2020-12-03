<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model {


    protected $table = 'manufacturers';

    protected $fillable = [
        'name',
    ];


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }


    public function device()
    {
        return $this->hasMany(DeviceList::class, 'manufacturer_id', 'id');
    }

}
