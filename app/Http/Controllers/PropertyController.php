<?php

namespace App\Http\Controllers;

class PropertyController extends Controller {

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
    public function getIndex($id = null) {
        return view('property.index');
    }

    public function getAddRoom() {
        return view('property.add_room');
    }

    public function getCheckIn() {
        return view('property.check_in');
    }

    public function getReport() {
        return view('property.report');
    }

    public function getEmployee() {
        return view('property.employee');
    }

}
