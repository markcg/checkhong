@extends('layouts.app')

@section('content')
@include('property.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3>จองที่พัก</h3>
            </div>
            <div class="col-xs-12 text-left">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสห้อง</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">โดยคุณ</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">เข้าพัก</label>
                        <input type="datetime" id="check-in" class="form-control date" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ออก</label>
                        <input type="datetime" id="check-out" class="form-control date" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">เบอร์ติดต่อกลับ</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>รายการจอง - พัก ปัจจุบัน</h4>
                <table class="table">
                    <tr><th>รหัสห้อง</th><th>ราคาต่อคืน</th><th colspan="3">คำอธิบาย</th></tr>
                    <tr><td>A1</td><td>500</td><td>ห้องติดทางเดิน</td><td>แก้ไข</td><td>ลบ</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link href="/assets/modules/datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
<script src="/assets/modules/datetime/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('#check-in').datetimepicker({
            format: 'd-m-Y H:i'
        });
        $('#check-out').datetimepicker({
            format: 'd-m-Y H:i'
        });
    });
</script>
@endsection