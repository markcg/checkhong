@extends('layouts.app')

@section('content')
@include('property.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3>จัดการที่พัก</h3>
            </div>
            <div class="col-xs-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#checkIn" aria-expanded="false" aria-controls="checkIn">
                    จองที่พัก
                </button>
            </div>
            <div class="collapse col-xs-12 text-left" style="margin-top: 10px;" id="checkIn">
                <form method="POST" action="/property/reserve">
                    <div class="form-group">
                        <label for="roomCode">รหัสห้อง</label>
                        <input name="room_code" class="form-control" id="roomCode" value="{{old('room_code')}}">
                    </div>
                    <div class="form-group">
                        <label for="customerName">โดยคุณ</label>
                        <input name="customer_name" class="form-control" id="customerName" value="{{old('customer_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="check-in">เข้าพัก</label>
                        <input name="check_in" type="text" id="check-in" class="form-control date" value="{{old('check_in')}}">
                    </div>
                    <div class="form-group">
                        <label for="check-out">ออก</label>
                        <input name="check_out" type="text" id="check-out" class="form-control date" value="{{old('check_out')}}">
                    </div>
                    <div class="form-group">
                        <label for="customerTel">เบอร์ติดต่อกลับ</label>
                        <input name="customer_tel" class="form-control" id="customerTel" value="{{old('customer_tel')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">สถานะ</label>
                        <select class="form-control" name="status">
                            <option></option>
                            <option value="1" <?php echo old('status') == 1 ? 'selected' : ''; ?> >จอง</option>
                            <option value="2" <?php echo old('status') == 2 ? 'selected' : ''; ?> >เข้าพักแล้ว</option>
                            <option value="3" <?php echo old('status') == 3 ? 'selected' : ''; ?> >ชำระเงินแล้ว</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">เพิ่มเติม</label>
                        <textarea name="remark" class="form-control" placeholder=""></textarea>
                    </div>
                    <!--                    <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="breakfast"> รวมอาหารเช้า
                                            </label>
                                        </div>-->
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>รายการจอง - พัก ปัจจุบัน</h4>
                <table class="table">
                    <tr>
                        <th>รหัสห้อง</th>
                        <th>โดยคุณ</th>
                        <th>จำนวนวัน</th>
                        <th>เบอร์ติดต่อลูกค้า</th>
                        <th>สถานะ</th>
                        <th colspan="2">จัดการ</th></tr>
                    <?php
                    foreach ($bookings as $booking):
                        $checkIn = new DateTime($booking->check_in);
                        $checkOut = new DateTime($booking->check_out);
                        $dateCount = $checkIn->diff($checkOut);
                        ?>
                        <form method="POST" action="/property/edit-booking?c={{$booking->id}}" >
                            <tr class="room_list-row">
                                <td>
                                    <div><input class="editable" name="room_code" type="text" value="{{$booking->room()->first()->code}}" /></div>
                                    <div>เช็คอิน: <input class="editable check-in" name="check_in" type="text" value="{{$booking->check_in}}" /></div>
                                    <div>เช็คเอ้า: <input class="editable check-out" name="check_out" type="text" value="{{$booking->check_out}}" /></div>
                                </td>
                                <td>
                                    <div><input class="editable" name="customer_name" type="text" value="{{$booking->customer_name}}" /></div>
                                </td>
                                <td>
                                    <div>{{$dateCount->format('%a')}}</div>
                                    <div>ยอดชำระ: <input class="editable" name="total" type="text" value="{{$booking->total}}" /></div>
                                </td>
                                <td><input class="editable" name="customer_tel" type="text" value="{{$booking->customer_tel}}" /></td>
                                <td>
                                    <select class="editable" name="status">
                                        <option></option>
                                        <option value="1" <?php echo $booking->status == 1 ? 'selected' : ''; ?> >จอง</option>
                                        <option value="2" <?php echo $booking->status == 2 ? 'selected' : ''; ?> >เข้าพักแล้ว</option>
                                        <option value="3" <?php echo $booking->status == 3 ? 'selected' : ''; ?> >ชำระเงินแล้ว</option>
                                    </select>
                                </td>
                                <td>
                                    {{csrf_field()}}
                                    <input class="editable submit"  type="submit" value="แก้ไข" />
                                </td>
                                <td><a href="/property/delete-booking?c={{$booking->id}}">ลบ</a></td>
                            </tr>
                        </form>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link href="/assets/modules/datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
<style>
    .room_list-row{
        text-align: left;
    }
    .room_list-row td{
        text-align: left;
    }
    .editable{
        background-color: transparent;
        border: none;
    }
    .editable option{
        color: black;
    }
    .submit{color: #00cc00;}
</style>
@endsection

@section('script')
<script src="/assets/modules/datetime/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
<script>
$(function () {
    $('#check-in, .check-in').datetimepicker({
        minDate: 0,
        format: 'Y-m-d H:i'
    });
    $('#check-out, .check-out').datetimepicker({
        minDate: '+1970/01/2',
        format: 'Y-m-d H:i'
    });
});
</script>
@endsection