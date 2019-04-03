<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'id',
        'id_place_type',
        'id_user',
        'name',
        'description',
        'city',
        'uf',
        'latitude',
        'longitude',
        'size',
        'capacity'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function type() {
        return $this->belongsTo('App\PlaceType', 'id_place_type');
    }

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
