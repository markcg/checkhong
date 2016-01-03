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

class Booking extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ch_property_booking';
    public $timestamps = false;

    public function room() {
        return $this->belongsTo('App\Models\Room', 'room_id');
    }

    public function property() {
        return $this->belongsTo('App\Models\Property', 'property_id');
    }

}
