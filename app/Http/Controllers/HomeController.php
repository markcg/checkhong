<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller {

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
        return view('home');
    }

    public function getLogin() {
        return view('home.login');
    }

    public function getRegister() {
        return view('home.register');
    }

}
