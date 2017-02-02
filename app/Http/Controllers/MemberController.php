<?php

namespace App\Http\Controllers;

use Session;
use Log;
use Illuminate\Http\Request;
use Validator;

class MemberController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('isMember');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function getIndex() {
        $properties = \App\Models\Member::find(Session::get('member')->id)->properties();
        if (count($properties->get())) {
            Session::flash('hasProperty', true);
        } else {
            Session::flash('hasProperty', false);
        }
        return view('member.index');
    }

    public function getProfile() {
        return view('member.profile');
    }

    public function getProperty() {
        $properties = \App\Models\Member::find(Session::get('member')->id)->properties();
        if (count($properties->get())) {
            return view('member.properties')->with('properties', $properties->get());
        } else {
            return redirect('/member');
        }
    }

    public function getContactService() {
        return view('member.contact_us');
    }

    public function getCreateProperty() {
        return view('member.create_property');
    }

    public function postCreateProperty(Request $request) {
        $messages = [
            'name.required' => 'กรุณาใส่ชื่อกิจการของท่าน',
            'name.unique' => 'ชื่อนี้มีผู้ใช้แล้ว',
            'address.required' => 'กรุณากรอกที่อยู่กิจการของท่าน',
            'description.required' => 'กรุณาอธิบายกิจการของคุณ',
            'tel.required' => 'กรุณาใส่เบอร์ติดต่อ',
            'tel.numeric' => 'เบอร์ติดต่อของท่านมีตัวอักษร',
            'email.required' => 'กรุณาใส่อีเมล์',
            'email.email' => 'กรุณาใส่อีเมล์ให้ถูกต้อง',
            'email.unique' => 'กรุณาใส่อีเมล์ให้ถูกต้อง',
        ];
        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:ch_property,name',
                    'address' => 'required',
                    'description' => 'required',
                    'tel' => 'required|numeric',
                    'email' => 'required|email|unique:ch_property,email',
                        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $member = Session::get('member');
        $propertyCount = sizeof($member->property());
        if ($member->type <= 1 && $propertyCount > 1) {
            return redirect()->back()
                            ->withErrors(['บัญชีผู้ใช้ของคุณเป็นเวอร์ชั่นทดลอง ไม่สามารถสร้างกิจการได้มากกว่า 1 กิจการ'])
                            ->withInput();
        }
        $member = \App\Models\Member::find(Session::get('member')->id);
        $property = new \App\Models\Property();
        $property->name = $request->name;
        $property->address = $request->address;
        $property->tel = $request->tel;
        $property->email = $request->email;
        $member->properties()->save($property);

        $code = 'A' . str_pad(Session::get('member')->id, 4, "0", STR_PAD_LEFT) . str_pad($property->id, 2, "0", STR_PAD_LEFT);
        $property->code = $code;
        $property->save();
        return redirect('/member/property');
    }

}
