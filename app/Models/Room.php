<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Member
 *
 * @author W.J
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ch_property_room';
    public $timestamps = false;

    public function property() {
        return $this->belongsTo('App\Models\Property', 'property_id');
    }

    public function bookings() {
        return $this->hasMany('App\Models\Booking', 'room_id');
    }

}
