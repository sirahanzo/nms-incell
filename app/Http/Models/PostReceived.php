<?php

namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PostReceived extends Model {


    protected $table = 'post_received';

    protected $fillable = [
        'site_oid',
        'site_name',
        'type_message',
        'content_message',
    ];

   /* public function setUpdatedAtAttribute($date)
    {
        $this->attributes['updated_at'] = Carbon::parse($date)->format('Y-m-d H:i:00');
    }*/

}
