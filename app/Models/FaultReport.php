<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaultReport extends Model
{

    protected $fillable = [

        'machine_id',
        'operator_id',
        'fault_reason',
        'remedy',
        'estimated_time'

    ];


    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class,'operator_id');
    }

}