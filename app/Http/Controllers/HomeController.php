<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Log;
use Hash;
use function view;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('web');
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

    public function getLogout() {
        Session::flush();
        return redirect('/');
    }

    public function postLogin(Request $request) {
        $messages = [
            'email.required' => 'กรุณาใส่อีเมล์',
            'email.email' => 'กรุณาใส่อีเมล์ให้ถูกต้อง',
            'email.exists' => 'ไม่มีอีเมล์ดังกล่าวในระบบ',
            'password.required' => 'กรุณาใส่พาสเวิร์ด',
        ];
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|exists:ch_member,email',
                    'password' => 'required',
                        ], $messages);
//$request->session()->put('data', 'value');
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $member = \App\Models\Member::where("email", "=", $request->email)->first();
        if (Hash::check($request->password, $member->password)) {
            $request->session()->put('member', $member);
        } else {
            return redirect()->back()
                            ->withErrors(['พาสเวิร์ดหรืออีเมล์ของคุณไม่สัมพันธ์กัน'])
                            ->withInput();
        }
        return redirect('/member');
    }

    public function postRegister(Request $request) {
        $messages = [
            'email.required' => 'กรุณาใส่อีเมล์',
            'email.email' => 'กรุณาใส่อีเมล์ให้ถูกต้อง',
            'email.unique' => 'อีเมล์ดังกล่าวมีในระบบแล้ว',
            'password.required' => 'กรุณาใส่พาสเวิร์ด',
            'password.min' => 'พาสเวิร์ดต้องยาวกว่าหรือเท่ากับ 6 ตัวอักษร'
        ];
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:ch_member,email',
                    'password' => 'required|min:6',
                        ], $messages);
//$request->session()->put('data', 'value');
        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator)
                            ->withInput();
        }

        $member = new \App\Models\Member();
        $member->email = $request->email;
        $member->password = Hash::make($request->password);
        $member->type = 1;
        $member->active = 0;
        $nextMonth = date('Y-m-d H:i:s', mktime(date("H"), date("i"), date("s"), date("m") + 1, date("d"), date("Y")));
        $member->active_til = $nextMonth;
        $member->save();

        $request->session()->put('member', $member);
        return redirect('member');
    }

}
