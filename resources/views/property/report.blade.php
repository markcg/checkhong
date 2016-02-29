@extends('layouts.app')

@section('content')
@include('property.menu')
<div class="row home_main_section-wrapper">
    <div class="">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>รายงานสรุปกิจการของคุณ</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <div>ยอดขายประจำปี <button class="btn btn-info">เปิดดู</button></div>
                <div>ยอดขายประจำเดือน <button class="btn btn-info">เปิดดู</button></div>
                <div>ยอดขายประจำสัปดาห์ <button class="btn btn-info">เปิดดู</button></div>
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