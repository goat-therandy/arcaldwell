<?php

namespace App\Models\Services\Weather;

use Illuminate\Database\Eloquent\Model;

class Location extends Model{

    protected $table = 'locations';

    protected $fillable = [
        'city',
        'latitude',
        'longitude',
        'boundingbox',
        'country',
        'state',
    ];



}