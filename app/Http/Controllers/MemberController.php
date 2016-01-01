<?php

namespace App\Http\Controllers;

class MemberController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function getIndex() {
        return view('member.index');
    }

    public function getProfile() {
        return view('member.profile');
    }

    public function getProperty() {
        return view('member.properties');
    }

    public function getContactService() {
        return view('member.contact_us');
    }

}
