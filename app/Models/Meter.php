<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{

    protected $fillable = [

        'machine_id',
        'started_by',
        'ended_by',
        'start_time',
        'end_time',
        'duration_seconds'

    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

}