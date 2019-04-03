<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceLocation extends Model
{
    protected $fillable = [
        'id',
        'id_place',
        'id_user',
        'initial',
        'finale',
        'value',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function place() {
        return $this->belongsTo('App\Place', 'id_place');
    }

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
