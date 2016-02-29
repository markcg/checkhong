<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Property;
use DateTime;
use Hash;
use Illuminate\Http\Request;
use Session;
use Validator;

class PropertyController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isMember');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
        //return $sub;
        Session::put('month', $this->monthName());
        if (isset($request->c)) {
            if (Session::has('member')) {
                $member   = Member::find(Session::get('member')->id);
                $property = $member->properties()->where('code', '=', $request->c)->first();
                Session::put('property', $property);
                return view('property.index');
            }
        } else if (Session::has('hotel')) {
            if (Session::has('member')) {
                $property = Property::where("code", '=', Session::get('hotel'))->first();
                Session::put('property', $property);
                return view('property.index');
            }
        } else if (Session::has('property')) {
            return view('property.index');
        } else {
            return redirect('/member/property');
        }
    }

    public function getAddRoom()
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 1) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        if (Session::has('property')) {
            $rooms = Property::find(Session::get('property')->id)->rooms()->orderBy('code', 'asc')->get();
            return view('property.add_room')->with('rooms', $rooms);
        }
        if (Session::has('hotel')) {
            return redirect('/');
        }
        return redirect('/member/property');
    }

    public function getCheckIn()
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 2) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        if (Session::has('property')) {
            $bookings = Property::find(Session::get('property')->id)->bookings()->where('check_out', '>=', date('Y-m-d'))->orderBy('room_id', 'asc')->get();
            return view('property.check_in')->with('bookings', $bookings);
        }
        if (Session::has('hotel')) {
            return redirect('/');
        }
        return redirect('/property');
    }

    public function getReport()
    {
        return view('property.report');
    }

    public function getEmployee()
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 2) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        $employees = Property::find(Session::get('property')->id)->employees;
        return view('property.employee')->with(["employees" => $employees]);
    }

    public function getDeleteRoom(Request $request)
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 1) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        if (Session::has('property')) {
            if ($room = Property::find(Session::get('property')->id)->rooms()->find($request->c)) {
                $room->delete();
            }
            return redirect('/property/add-room');
        }
    }

    public function getDeleteBooking(Request $request)
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 2) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        if (Session::has('property')) {
            if ($booking = Property::find(Session::get('property')->id)->bookings()->find($request->c)) {
                $booking->delete();
            }
            return redirect('/property/check-in');
        }
    }

    public function postAddRoom(Request $request)
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 1) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        $messages = [
            'code.required'        => 'กรุณาใส่รหัสห้อง',
            'name.required'        => 'กรุณาใส่ชื่อห้อง',
            'price.required'       => 'กรุณาใส่ราคาห้อง',
            'description.required' => 'กรุณาอธิบายห้องของคุณ',
        ];
        $validator = Validator::make($request->all(), [
            'code'        => 'required',
            'name'        => 'required',
            'price'       => 'required',
            'description' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $property          = \App\Models\Property::find(Session::get('property')->id);
        $room              = new \App\Models\Room();
        $room->code        = $request->code;
        $room->name        = $request->name;
        $room->price       = $request->price;
        $room->description = $request->description;
        $property->rooms()->save($room);

        return redirect('/property/add-room');
    }

    public function postEditRoom(Request $request)
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 1) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        $messages = [
            'code.required'        => 'กรุณาใส่รหัสห้อง',
            'name.required'        => 'กรุณาใส่ชื่อห้อง',
            'price.required'       => 'กรุณาใส่ราคาห้อง',
            'description.required' => 'กรุณาอธิบายห้องของคุณ',
        ];
        $validator = Validator::make($request->all(), [
            'code'        => 'required',
            'name'        => 'required',
            'price'       => 'required',
            'description' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $room              = \App\Models\Room::find($request->c);
        $room->code        = $request->code;
        $room->name        = $request->name;
        $room->price       = $request->price;
        $room->description = $request->description;
        $room->save();

        return redirect('/property/add-room');
    }

    public function postReserve(Request $request)
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 2) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        $messages = [
            'room_code.required'     => 'กรุณาใส่รหัสห้อง',
            'customer_name.required' => 'กรุณาใส่ชื่อผู้พัก',
            'check_in.required'      => 'กรุณาระบุวันเข้าพัก',
            'check_out.required'     => 'กรุณาระบุวันออกจากที่พัก',
            'customer_tel.required'  => 'กรุณาระบุเบอร์ติดต่อผู้พัก',
            'status.required'        => 'กรุณาระบุสถานะการจอง',
        ];
        $validator = Validator::make($request->all(), [
            'room_code'     => 'required',
            'check_in'      => 'required',
            'check_out'     => 'required',
            'customer_name' => 'required',
            'customer_tel'  => 'required',
            'status'        => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $room = Session::get('property')->rooms()->where('code', '=', $request->room_code)->first();
        if ($room) {
            $existBooking = Session::get('property')
                ->bookings()
                ->where('room_id', '=', $room->id)
                ->whereBetween('check_out', [$request->check_in, $request->check_out])
                ->first();
            if ($existBooking) {
                return redirect()->back()
                    ->withErrors(['ห้องพักดังกล่าวมีการจองหรือพักแล้ว จนถึง ' . date("d M Y H:i", strtotime($existBooking->check_out))])
                    ->withInput();
            } else {
                $checkIn   = new DateTime($request->check_in);
                $checkOut  = new DateTime($request->check_out);
                $dateCount = $checkIn->diff($checkOut);

                $booking                = new \App\Models\Booking();
                $booking->property_id   = $room->property()->first()->id;
                $booking->check_in      = $request->check_in;
                $booking->check_out     = $request->check_out;
                $booking->customer_name = $request->customer_name;
                $booking->customer_tel  = $request->customer_tel;
                $booking->remark        = $request->remark;
                $booking->status        = $request->status;
                $booking->total         = $dateCount->format('%a') * $room->price;
                $room->bookings()->save($booking);
            }
        } else {
            return redirect()->back()
                ->withErrors(['ไม่มีห้องพักดังกล่าวในโรงแรมของคุณ'])
                ->withInput();
        }
        return redirect('/property/check-in');
    }

    public function postEditBooking(Request $request)
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 2) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        $messages = [
            'room_code.required'     => 'กรุณาใส่รหัสห้อง',
            'customer_name.required' => 'กรุณาใส่ชื่อผู้พัก',
            'check_in.required'      => 'กรุณาระบุวันเข้าพัก',
            'check_out.required'     => 'กรุณาระบุวันออกจากที่พัก',
            'customer_tel.required'  => 'กรุณาระบุเบอร์ติดต่อผู้พัก',
            'status.required'        => 'กรุณาระบุสถานะการจอง',
        ];
        $validator = Validator::make($request->all(), [
            'room_code'     => 'required',
            'check_in'      => 'required',
            'check_out'     => 'required',
            'customer_name' => 'required',
            'customer_tel'  => 'required',
            'status'        => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $room = Session::get('property')->rooms()->where('code', '=', $request->room_code)->first();
        if ($room) {
            $existBooking = Session::get('property')
                ->bookings()
                ->where('room_id', '=', $room->id)
                ->whereBetween('check_out', [$request->check_in, $request->check_out])
                ->first();
            if ($existBooking && $existBooking->id != $request->c) {
                return redirect()->back()
                    ->withErrors(['ห้องพักดังกล่าวมีการจองหรือพักแล้ว จนถึง ' . date("d M Y H:i", strtotime($existBooking->check_out))])
                    ->withInput();
            } else {
                $checkIn   = new DateTime($request->check_in);
                $checkOut  = new DateTime($request->check_out);
                $dateCount = $checkIn->diff($checkOut);

                $booking                = \App\Models\Booking::find($request->c);
                $booking->property_id   = $room->property()->first()->id;
                $booking->check_in      = $request->check_in;
                $booking->check_out     = $request->check_out;
                $booking->customer_name = $request->customer_name;
                $booking->customer_tel  = $request->customer_tel;
                $booking->remark        = $request->remark;
                $booking->status        = $request->status;
                $booking->total         = $dateCount->format('%a') * $room->price;
                $room->bookings()->save($booking);
            }
        } else {
            return redirect()->back()
                ->withErrors(['ไม่มีห้องพักดังกล่าวในโรงแรมของคุณ'])
                ->withInput();
        }
        return redirect('/property/check-in');
    }
    public function postEmployee(Request $request)
    {
        if (Session::get('member')->property_id != null) {
            if (Session::get('member')->type > 1) {
                return redirect()->back()
                    ->withErrors(['คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้'])
                    ->withInput();
            }
        }
        $messages = [
            'username.required' => 'กรุณาใส่ชื่อผู้ใช้',
            'password.required' => 'กรุณาใส่รหัสผ่าน',
            'name.required'     => 'กรุณาใส่ชื่อจริงของพนักงาน',
            'lastname.required' => 'กรุณาใส่นามสกุลของพนักงาน',
            'email.required'    => 'กรุณาใส่อีเมล์',
            'tel.required'      => 'กรุณาใส่เบอร์ติดต่อ',
            'role.required'     => 'กรุณาระบุบทบาทของพนักงาน',
            'gender.required'   => 'กรุณาระบุเพศของพนักงาน',
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'name'     => 'required',
            'lastname' => 'required',
            'email'    => 'required',
            'tel'      => 'required',
            'role'     => 'required',
            'gender'   => 'required',
        ], $messages);
        if (Session::has('property')) {
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $exist = Session::get('property')->employees()->where('username', '=', $request->username)->first();
            if ($exist) {
                return redirect()->back()
                    ->withErrors(['มีชื่อผู้ใช้ดังกล่าวในระบบพนักงานแล้ว'])
                    ->withInput();
            }
            $employee              = new Employee();
            $employee->property_id = Session::get('property')->id;
            $employee->username    = $request->username;
            $employee->password    = Hash::make($request->password);
            $employee->type        = $request->role;
            $employee->name        = $request->name;
            $employee->lastname    = $request->lastname;
            $employee->gender      = $request->gender;
            $employee->tel         = $request->tel;
            $employee->email       = $request->email;
            $employee->save();
            return redirect('/property/employee');
        } else {
            return redirect()->back();
        }
    }
    protected function monthName()
    {
        $month = null;
        if (date('n') == 1) {
            $month = "มกราคม";
        } else if (date('n') == 2) {
            $month = "กุมภาพันธ์";
        } else if (date('n') == 3) {
            $month = "มีนาคม";
        } else if (date('n') == 4) {
            $month = "เมษายน";
        } else if (date('n') == 5) {
            $month = "พฤษภาคม";
        } else if (date('n') == 6) {
            $month = "มิถุนายน";
        } else if (date('n') == 7) {
            $month = "กรกฎาคม";
        } else if (date('n') == 8) {
            $month = "สิงหาคม";
        } else if (date('n') == 9) {
            $month = "กันยายน";
        } else if (date('n') == 10) {
            $month = "ตุลาคม";
        } else if (date('n') == 11) {
            $month = "พฤศจิกายน";
        } else if (date('n') == 12) {
            $month = "ธันวาคม";
        }
        return $month;
    }

}
