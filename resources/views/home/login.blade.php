@extends('layouts.app')

@section('content')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>ลงชื่อเข้าใช้</h1>
            </div>
        </div>
        <div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="row tab-pane active text-center" id="login">
                <div class="col-xs-6">
                    <a href="#owner" aria-controls="owner" role="tab" data-toggle="tab">เจ้าของกิจการ</a>
                </div>
                <div class="col-xs-6">
                    <a href="#employee" aria-controls="employee" role="tab" data-toggle="tab">พนักงาน</a>
                </div>
            </div>
            <div role="tabpanel" class="row tab-pane" id="owner">
                <div class="col-xs-8 col-xs-offset-2">
                    <a href="#login" aria-controls="login" role="tab" data-toggle="tab">กลับ</a>
                    <form method="POST" action="/login">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control" id="Email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="Password" placeholder="Password" value="{{ old('password') }}">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div role="tabpanel" class="row tab-pane" id="employee">
                <div class="col-xs-8 col-xs-offset-2">
                    <a href="#login" aria-controls="login" role="tab" data-toggle="tab">กลับ</a>
                    <form method="POST" action="/login">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input name="username" type="text" class="form-control" id="Username" placeholder="Username" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="Password" placeholder="Password" value="{{ old('password') }}">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
@endsection

@section('script')
@endsection