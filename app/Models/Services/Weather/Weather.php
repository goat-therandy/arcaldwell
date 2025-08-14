<?php

namespace App\Models\Services\Weather;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model for the Weather service.
 * 
 * Includes preferences for users.
 * 
 * Table is the weather_pref table.
 */

class Weather extends Model{

    protected $table = 'weather_pref';

    protected $fillable = [
        'user_id',
        'temperature_unit',
        'notifications_enabled',
        'location',
        'favorites',
    ];

    /**
     * Get the user that owns the weather preferences.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}