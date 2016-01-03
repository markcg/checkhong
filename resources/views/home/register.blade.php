@extends('layouts.app')

@section('content')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>สมัครสมาชิค</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="/register">
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
    </div>
</div>
@endsection

@section('style')
@endsection

@section('script')
@endsection