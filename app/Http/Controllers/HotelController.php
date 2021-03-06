<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\Models\Property;

class HotelController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function getIndex(Request $request, $sub)
    {
        if (!Session::has("hotel")) {
            Session::put("hotel", $sub);
        }
        return view('hotel.login');
    }

    public function getLogin(Request $request, $sub)
    {
        if (!Session::has("hotel")) {
            Session::put("hotel", $sub);
        }
        return view('hotel.login');
    }

    public function postLogin(Request $request)
    {
        $messages = [
            'username.required' => 'กรุณาใส่รหัสผู้ใช้',
            'username.exists'   => 'ไม่มีรหัสผู้ใช้ดังกล่าวในระบบ',
            'password.required' => 'กรุณาใส่พาสเวิร์ด',
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:ch_employee,username',
            'password' => 'required',
        ], $messages);
//$request->session()->put('data', 'value');
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Session::has('hotel')) {
            $property = Property::where("code", '=', Session::get('hotel'))->first();
            if ($property) {
                $member = $property->employees()->where("username", "=", $request->username)->first();
                if (Hash::check($request->password, $member->password)) {
                    $request->session()->put('member', $member);
                    return redirect('/property');
                } else {
                    return redirect()->back()
                        ->withErrors(['พาสเวิร์ดหรือชื่อผู้ใช้ของคุณไม่สัมพันธ์กัน'])
                        ->withInput();
                }
            }
        }
        return redirect('/');
    }

    public function getLogout(Request $request, $sub)
    {
        Session::flush();
        return redirect('/');
    }
}
