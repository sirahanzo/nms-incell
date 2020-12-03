<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Severity extends Model {


    protected $table = 'severities';

    protected $fillable = ['name'];


    public function parameter()
    {
        return $this->hasMany(Parameters::class, 'severity_id', 'id');
    }
}
