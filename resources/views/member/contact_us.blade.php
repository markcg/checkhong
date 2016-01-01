@extends('layouts.app')

@section('content')
@include('member.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>ติดต่อเจ้าหน้าที่</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">เรื่อง</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">รายละเอียด</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-default">ส่ง</button>
                    </div>
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