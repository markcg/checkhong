@extends('layouts.app')

@section('content')
@include('property.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3>จัดการที่พัก</h3>
            </div>
            <div class="col-xs-12">
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
            <div>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addRoom" aria-expanded="false" aria-controls="addRoom">
                    เพิ่มที่พัก
                </button>
            </div>
            <div class="collapse col-xs-12 text-left" style="margin-top: 10px;" id="addRoom">

                <form action="/property/add-room" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสห้อง</label>
                        <input name="code" type="text" class="form-control" id="code" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ชื่อห้อง</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ราคาต่อคืน</label>
                        <input name="price" type="text" class="form-control" id="price" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">คำอธิบาย</label>
                        <textarea name="description" class="form-control" placeholder=""></textarea>
                    </div>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>ห้องพักทั้งหมด</h4>
                <table class="table">
                    <tr class="room_list-head"><th>รหัสห้อง</th><th>ชื่อห้อง</th><th>ราคาต่อคืน</th><th colspan="3">คำอธิบาย</th></tr>
                    <?php foreach ($rooms as $room): ?>
                        <tr class="room_list-row">
                        <form method="POST" action="/property/edit-room?c={{$room->id}}">
                            <td><input class="editable" name="code" type="text" value="{{$room->code}}" /></td>
                            <td><input class="editable" name="name" type="text" value="{{$room->name}}" /></td>
                            <td><input class="editable" name="price" type="text" value="{{$room->price}}" /></td>
                            <td><input class="editable" name="description" type="text" value="{{$room->description}}" /></td>
                            <td><input class="editable submit"  type="submit" value="แก้ไข" /></td>
                            {{csrf_field()}}
                        </form>
                        <td><a href="/property/delete-room?c={{$room->id}}">ลบ</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .room_list-row{
        text-align: left;
    }
    .room_list-row td{
        text-align: left;
    }
    .editable{
        background-color: transparent;
        border: none;
    }
    .submit{color: #00cc00;}
</style>
@endsection

@section('script')
<script src="/assets/js/member/chart.js" type="text/javascript"></script>
<script>
</script>
@endsection