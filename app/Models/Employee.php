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

class Employee extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ch_employee';

    public function property() {
        return $this->belongsTo('App\Models\Property', 'property_id');
    }

    public function type() {
        return $this->belongsTo('App\Models\EmployeeType', 'type');
    }

}
