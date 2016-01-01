@extends('layouts.app')

@section('content')
@include('member.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>จัดการโรงแรม</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 text-center property_tools">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation"><a href="#">เพิ่มกิจการ</a></li>
                    <li role="presentation"><a href="#">ลบกิจการ</a></li>
                </ul>
            </div>
            <div class="col-sm-9 text-center property_wrapper">
                <div class="col-md-4 property_frame">
                    <div class="col-md-12 property_image-wrapper"><img class="property_image" /></div>
                    <div class="col-md-12 property_description-wrapper">
                        <h3>Chiang Mai Hotels</h3>
                        <div class="row">
                            <div class="col-xs-6 text-left">จำนวนห้อง:</div>
                            <div class="col-xs-6 text-right">50 ห้อง</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-left">ผู้จัดการ:</div>
                            <div class="col-xs-6 text-right">นาย เอ นามสมมุติ</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-left">ยอดพักวันนี้:</div>
                            <div class="col-xs-6 text-right">10 ห้อง</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-right"><a href="/property/1"><button class="btn btn-info">ดูข้อมูล</button></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 property_frame">
                    <div class="col-md-12 property_image-wrapper"><img class="property_image" /></div>
                    <div class="col-md-12 property_description-wrapper">
                        <h3>Nan Hostel</h3>
                        <div class="row">
                            <div class="col-xs-6 text-left">จำนวนห้อง:</div>
                            <div class="col-xs-6 text-right">10 ห้อง</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-left">ผู้จัดการ:</div>
                            <div class="col-xs-6 text-right">นาย บี ไม่ประสงค์ออกนาม</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-left">ยอดพักวันนี้:</div>
                            <div class="col-xs-6 text-right">2 ห้อง</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-right"><a href="/property/2"><button class="btn btn-info">ดูข้อมูล</button></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .property_wrapper{border-left: 1px solid grey;}
    .property_frame{
        color: white;
        background-color: #666666;
        height: 300px;
    }
    .property_image{
        height: 120px;
    }
    .property_description-wrapper .col-xs-6,
    .property_description-wrapper .col-xs-12{
        padding: 0 5px;
        margin: 0;
    }
</style>
@endsection

@section('script')
@endsection