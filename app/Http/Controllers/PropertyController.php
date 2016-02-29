<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use DateTime;
use Illuminate\Http\Request;

class PropertyController extends Controller {

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
    public function getIndex(Request $request) {
        //return $sub;
        Session::put('month',$this->monthName());
        if (isset($request->c)) {
            if (Session::has('member')) {
                $property = Session::get('member')->properties()->where('code', '=', $request->c)->first();
                Session::put('property', $property);
                return view('property.index');
            }
        }else if(Session::has('sub')){
             if (Session::has('member')) {
                $property = Session::get('member')->property()->first();
                Session::put('property', $property);
                return view('property.index');
            }
        } else {
            return view('property.index');
        }
    }

    public function getAddRoom() {
        if (Session::has('property')) {
            $rooms = Session::get('property')->rooms()->orderBy('code', 'asc')->get();
            return view('property.add_room')->with('rooms', $rooms);
        }
        return redirect('/member/property');
    }

    public function getCheckIn() {
        if (Session::has('property')) {
            $bookings = Session::get('property')->bookings()->where('check_out', '>=', date('Y-m-d'))->orderBy('room_id', 'asc')->get();
            return view('property.check_in')->with('bookings', $bookings);
        }
        return redirect('/property');
    }

    public function getReport() {
        return view('property.report');
    }

    public function getEmployee() {
        return view('property.employee');
    }

    public function getDeleteRoom(Request $request) {
        if (Session::has('property')) {
            if ($room = Session::get('property')->rooms()->find($request->c)) {
                $room->delete();
            }
            return redirect('/property/add-room');
        }
    }

    public function getDeleteBooking(Request $request) {
        if (Session::has('property')) {
            if ($booking = Session::get('property')->bookings()->find($request->c)) {
                $booking->delete();
            }
            return redirect('/property/check-in');
        }
    }

    public function postAddRoom(Request $request) {
        $messages = [
            'code.required' => 'กรุณาใส่รหัสห้อง',
            'name.required' => 'กรุณาใส่ชื่อห้อง',
            'price.required' => 'กรุณาใส่ราคาห้อง',
            'description.required' => 'กรุณาอธิบายห้องของคุณ',
        ];
        $validator = Validator::make($request->all(), [
                    'code' => 'required',
                    'name' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $property = \App\Models\Property::find(Session::get('property')->id);
        $room = new \App\Models\Room();
        $room->code = $request->code;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->description = $request->description;
        $property->rooms()->save($room);

        return redirect('/property/add-room');
    }

    public function postEditRoom(Request $request) {
        $messages = [
            'code.required' => 'กรุณาใส่รหัสห้อง',
            'name.required' => 'กรุณาใส่ชื่อห้อง',
            'price.required' => 'กรุณาใส่ราคาห้อง',
            'description.required' => 'กรุณาอธิบายห้องของคุณ',
        ];
        $validator = Validator::make($request->all(), [
                    'code' => 'required',
                    'name' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $room = \App\Models\Room::find($request->c);
        $room->code = $request->code;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->save();

        return redirect('/property/add-room');
    }

    public function postReserve(Request $request) {
        $messages = [
            'room_code.required' => 'กรุณาใส่รหัสห้อง',
            'customer_name.required' => 'กรุณาใส่ชื่อผู้พัก',
            'check_in.required' => 'กรุณาระบุวันเข้าพัก',
            'check_out.required' => 'กรุณาระบุวันออกจากที่พัก',
            'customer_tel.required' => 'กรุณาระบุเบอร์ติดต่อผู้พัก',
            'status.required' => 'กรุณาระบุสถานะการจอง',
        ];
        $validator = Validator::make($request->all(), [
                    'room_code' => 'required',
                    'check_in' => 'required',
                    'check_out' => 'required',
                    'customer_name' => 'required',
                    'customer_tel' => 'required',
                    'status' => 'required',
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
                    ->whereBetween('check_out', [ $request->check_in, $request->check_out])
                    ->first();
            if ($existBooking) {
                return redirect()->back()
                                ->withErrors(['ห้องพักดังกล่าวมีการจองหรือพักแล้ว จนถึง ' . date("d M Y H:i", strtotime($existBooking->check_out))])
                                ->withInput();
            } else {
                $checkIn = new DateTime($request->check_in);
                $checkOut = new DateTime($request->check_out);
                $dateCount = $checkIn->diff($checkOut);

                $booking = new \App\Models\Booking();
                $booking->property_id = $room->property()->first()->id;
                $booking->check_in = $request->check_in;
                $booking->check_out = $request->check_out;
                $booking->customer_name = $request->customer_name;
                $booking->customer_tel = $request->customer_tel;
                $booking->remark = $request->remark;
                $booking->status = $request->status;
                $booking->total = $dateCount->format('%a') * $room->price;
                $room->bookings()->save($booking);
            }
        } else {
            return redirect()->back()
                            ->withErrors(['ไม่มีห้องพักดังกล่าวในโรงแรมของคุณ'])
                            ->withInput();
        }
        return redirect('/property/check-in');
    }

    public function postEditBooking(Request $request) {
        $messages = [
            'room_code.required' => 'กรุณาใส่รหัสห้อง',
            'customer_name.required' => 'กรุณาใส่ชื่อผู้พัก',
            'check_in.required' => 'กรุณาระบุวันเข้าพัก',
            'check_out.required' => 'กรุณาระบุวันออกจากที่พัก',
            'customer_tel.required' => 'กรุณาระบุเบอร์ติดต่อผู้พัก',
            'status.required' => 'กรุณาระบุสถานะการจอง',
        ];
        $validator = Validator::make($request->all(), [
                    'room_code' => 'required',
                    'check_in' => 'required',
                    'check_out' => 'required',
                    'customer_name' => 'required',
                    'customer_tel' => 'required',
                    'status' => 'required',
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
                    ->whereBetween('check_out', [ $request->check_in, $request->check_out])
                    ->first();
            if ($existBooking && $existBooking->id != $request->c) {
                return redirect()->back()
                                ->withErrors(['ห้องพักดังกล่าวมีการจองหรือพักแล้ว จนถึง ' . date("d M Y H:i", strtotime($existBooking->check_out))])
                                ->withInput();
            } else {
                $checkIn = new DateTime($request->check_in);
                $checkOut = new DateTime($request->check_out);
                $dateCount = $checkIn->diff($checkOut);

                $booking = \App\Models\Booking::find($request->c);
                $booking->property_id = $room->property()->first()->id;
                $booking->check_in = $request->check_in;
                $booking->check_out = $request->check_out;
                $booking->customer_name = $request->customer_name;
                $booking->customer_tel = $request->customer_tel;
                $booking->remark = $request->remark;
                $booking->status = $request->status;
                $booking->total = $dateCount->format('%a') * $room->price;
                $room->bookings()->save($booking);
            }
        } else {
            return redirect()->back()
                            ->withErrors(['ไม่มีห้องพักดังกล่าวในโรงแรมของคุณ'])
                            ->withInput();
        }
        return redirect('/property/check-in');
    }

    protected function monthName() {
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
