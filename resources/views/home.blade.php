@extends('layouts.app')

@section('content')
<div class="row home_main_section-wrapper">
    <div class="container text-center home_main_section landing-quote">
        <div><h3>เริ่มต้นบริหารจัดการห้องพักของคุณ</h3></div>
        <div><h3>ด้วยระบบการจัดการจากเรา</h3></div>
        <div><h1>Check Hong</h1></div>
        <div><button class="btn btn-success">ทดลองใช้งาน</button></div>
    </div>
</div>
@endsection

@section('style')
<link href="/assets/modules/vegas/vegas.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/homepage/home.css" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
<script src="/assets/modules/vegas/vegas.min.js" type="text/javascript"></script>
<script src="/assets/js/homepage/home.js" type="text/javascript"></script>
@endsection