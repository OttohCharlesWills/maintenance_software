<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{

    protected $fillable = [
        'name',
        'image',
        'status',
        'location_id',
        'created_by',
        'serial_number'
    ];

    public function meters()
    {
        return $this->hasMany(Meter::class);
    }

    public function location()
{
    return $this->belongsTo(Location::class);
}



}