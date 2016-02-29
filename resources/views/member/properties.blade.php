<?php

use App\Models\Room;
use App\Models\Employee;
use App\Models\Booking;
?>
@extends('layouts.app')

@section('content')
@include('member.menu')
<div class="row home_main_section-wrapper">
    <div class="">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>จัดการโรงแรม</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 text-center property_tools">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation"><a href="/member/create-property">เพิ่มกิจการ</a></li>
                    <li role="presentation"><a href="#">ลบกิจการ</a></li>
                </ul>
            </div>
            <div class="col-sm-9 text-center property_wrapper">
                <?php
                if (isset($properties)):
                    $today = date('Y-m-d');
                    $tomorrow = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
                    foreach ($properties as $property):
                        $room = count($property->rooms()->get());
                        $manager = $property->employees()->where('type', '=', 2)->first();
                        $booking = count($property->bookings()->whereBetween('check_in', [$today, $tomorrow])->get());
                        ?>
                        <div class="col-md-4 property_frame">
                            <div class="col-md-12 property_image-wrapper"><img class="property_image" /></div>
                            <div class="col-md-12 property_description-wrapper">
                                <h3>{{$property->name}}</h3>
                                <div class="row">
                                    <div class="col-xs-4 text-left">รหัสกิจการ:</div>
                                    <div class="col-xs-8 text-right">{{ $property->code }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 text-left">จำนวนห้อง:</div>
                                    <div class="col-xs-8 text-right">{{ $room }} ห้อง</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 text-left">ผู้จัดการ:</div>
                                    <div class="col-xs-8 text-right"><?php echo $manager ? $manager->name : "ยังไม่มีผู้จัดการ"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 text-left">ยอดพักวันนี้:</div>
                                    <div class="col-xs-8 text-right"><?php echo $booking ? $booking . ' ห้อง' : "ไม่มียอดจองวันนี้"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-right"><a href="/property?c={{$property->code}}"><button class="btn btn-info">ดูข้อมูล</button></a></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
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
        height: 200px;
    }
    .property_image{
        height: 0;
    }
    .property_frame .col-md-12,
    .property_description-wrapper .col-xs-4,
    .property_description-wrapper .col-xs-8,
    .property_description-wrapper .col-xs-12{
        padding: 0;
        margin: 0;
    }
</style>
@endsection

@section('script')
@endsection