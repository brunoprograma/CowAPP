<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceHour extends Model
{
    protected $fillable = [
        'id',
        'id_place',
        'initial',
        'finale',
        'day_week',
        'value_hour'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function place() {
        return $this->belongsTo('App\Place', 'id_place');
    }
}
