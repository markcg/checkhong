@extends('layouts.app')

@section('content')
@include('member.menu')
<div class="row home_main_section-wrapper">
    <div class="">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>ข้อมูลส่วนตัว</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">อีเมล์</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">พาสเวิร์ด</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .property_tools{border-right: 1px solid grey;}
    .property_description-wrapper .col-xs-6,
    .property_description-wrapper .col-xs-12{
        padding: 0 5px;
        margin: 0;
    }
</style>
@endsection

@section('script')
@endsection