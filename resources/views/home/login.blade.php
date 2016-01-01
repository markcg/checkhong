@extends('layouts.app')

@section('content')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>ลงชื่อเข้าใช้</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <form method="GET" action="/member">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
@endsection

@section('script')
@endsection