@extends('layouts.app')

@section('content')
<div class="row home_main_section-wrapper">
 <div class="container">
    <div class="col-sm-2">
        @include('property.menu')
    </div>
    <div class="col-sm-10">
         @if (Session::get('member')->property_id == null || (Session::get('member')->property_id != null && Session::get('member')->type == 1))
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3>เพิ่มพนักงาน</h3>
            </div>
            <div class="col-xs-12 text-left">
                <form action="employee" method="post">
                    <div class="form-group">
                        <label for="username">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="ช่อผู้ใช้" value="{{old('username')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">พาสเวิร์ด</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" >
                    </div>
                    <div class="form-group">
                        <label for="name">ชื่อ</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อจริง" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="lastname">นามสกุล</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล" value="{{old('lastname')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">อีเมล์</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="อีเมล์" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="tel">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์ติดต่อ" value="{{old('tel')}}">
                    </div>
                    <div class="form-group">
                        <label for="role">ตำแหน่ง</label>
                        <select class="form-control" name="role">
                            <option value="1" @if(old('role' == 1)) selected @endif>ผู้ดูแล</option>
                            <option value="2" @if(old('role' == 2))selected @endif>พนักงานหน้าฟร้อนท์</option>
                            <option value="3" @if(old('role' == 3)) selected @endif>พนักงานทั่วไป</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender">เพศ</label>
                        <select class="form-control" name="gender">
                            <option value="0" @if(old('gender' == 0)) selected @endif>ชาย</option>
                            <option value="1" @if(old('gender' == 1)) selected @endif>หญิง</option>
                        </select>
                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>พนักงานทั้งหมด</h4>
                <table class="table  text-left">
                    <tr><th>ชื่อ</th><th>ชื่อผู้ใช้</th><th>ตำแหน่ง</th><th colspan="3">จัดการ</th></tr>
                    @if($employees)
                    @foreach($employees as $employee)
                    <tr>
                        <td>
                            {{$employee->name}} {{$employee->lastname}}
                        </td>
                        <td>
                            {{$employee->username}}
                        </td>
                        <td>
                            @if($employee->type == 1) ผู้ดูแล @endif
                             @if($employee->type == 2) พนักงานหน้าฟร้อนท์ @endif
                              @if($employee->type == 3) พนักงานทั่วไป @endif
                        </td>
                        <td>แก้ไข</td>
                        <td><a href="/property/delete-employee?c={{$employee->id}}">ลบ</a></td>
                    </tr>
                    @endforeach
                    @endif

                </table>
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