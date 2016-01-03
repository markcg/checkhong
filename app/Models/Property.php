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

class Property extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ch_property';

    public function owner() {
        return $this->belongsTo('App\Models\Member', 'owner_id');
    }

    public function employees() {
        return $this->hasMany('App\Models\Employee', 'property_id');
    }

    public function rooms() {
        return $this->hasMany('App\Models\Room', 'property_id');
    }

    public function bookings() {
        return $this->hasMany('App\Models\Booking', 'property_id');
    }

}
