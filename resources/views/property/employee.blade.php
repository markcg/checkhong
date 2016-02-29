@extends('layouts.app')

@section('content')
@include('property.menu')
<div class="row home_main_section-wrapper">
    <div class="">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3>เพิ่มพนักงาน</h3>
            </div>
            <div class="col-xs-12 text-left">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อผู้ใช้</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">พาสเวิร์ด</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ชื่อ</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">นามสกุล</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ตำแหน่ง</label>
                        <select class="form-control">
                            <option>ผู้ดูแล</option>
                            <option>พนักงานหน้าฟร้อนท์</option>
                            <option>พนักงานทั่วไป</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">เพศ</label>
                        <select class="form-control">
                            <option>ชาย</option>
                            <option>หญิง</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>พนักงานทั้งหมด</h4>
                <table class="table">
                    <tr><th>ชื่อ</th><th>ตำแหน่ง</th><th colspan="3">จัดการ</th></tr>
                    <tr><td>นาย เอ นามสมมุติ</td><td>ผู้ดูแล</td><td>แก้ไข</td><td>ลบ</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
@endsection

@section('script')
<script src="/assets/js/member/chart.js" type="text/javascript"></script>
<script>
</script>
@endsection