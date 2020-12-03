<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SerialNumberPack extends Model {


    protected $table = 'serial_number_pack';
    protected $fillable = [
        'site_oid',
        'device_node_id',
        'sn1',
        'sn2',
        'sn3',
        'sn4',
        'sn5',
        'sn6',
        'sn7',
        'sn8',
        'sn9',
        'sn10',
        'sn11',
        'sn12',
        'sn13',
        'sn14',
        'sn15',
    ];


    public function site()
    {
        return $this->belongsTo(Site::class,'site_oid','oid');
    }


}
