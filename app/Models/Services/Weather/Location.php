<?php

namespace App\Models\Services\Weather;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model{

    use SoftDeletes;

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