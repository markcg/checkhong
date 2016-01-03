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

class Member extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ch_member';

    public function info() {
        return $this->hasOne('App\Models\MemberInfo', 'member_id');
    }

    public function properties() {
        return $this->hasMany('App\Models\Property', 'owner_id');
    }

    public function type() {
        return $this->belongsTo('App\Models\MemberType', 'type');
    }

}
