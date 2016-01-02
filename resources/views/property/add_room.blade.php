@extends('layouts.app')

@section('content')
@include('property.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3>เพิ่มที่พัก</h3>
            </div>
            <div class="col-xs-12 text-left">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสห้อง</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ราคาต่อคืน</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">คำอธิบาย</label>
                        <textarea class="form-control" placeholder=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>ห้องพักทั้งหมด</h4>
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
@endsection

@section('script')
<script src="/assets/js/member/chart.js" type="text/javascript"></script>
<script>
</script>
@endsection