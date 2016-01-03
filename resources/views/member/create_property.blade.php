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
                <form method="POST" action="/member/create-property">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อโรงแรม</label>
                        <input name="name" type="text" class="form-control" id="Name" placeholder="Name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ที่อยู่</label>
                        <textarea name="address" type="text" class="form-control" id="Address" placeholder="Name">{{ old('address') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">เบอร์ติดต่อ(มากกว่า 1 เบอร์ให้ขั้นด้วยคอมม่า)</label>
                        <input name="tel" type="text" class="form-control" id="Tel" placeholder="Name" value="{{ old('tel') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">อีเมล์</label>
                        <input name="email" type="email" class="form-control" id="Email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">คำอธิบาย</label>
                        <textarea name="description" type="text" class="form-control" id="Description" placeholder="Decription">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-default">สร้างโรงแรม</button>
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