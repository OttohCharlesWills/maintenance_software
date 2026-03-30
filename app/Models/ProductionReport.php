<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionReport extends Model
{
    protected $fillable = [

        'machine_id',
        'operator_id',
        'bsw',
        'gross',
        'net',
        'net_previous_day',
        'month_to_date',
        'report_date'

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
