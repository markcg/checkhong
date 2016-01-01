@extends('layouts.app')

@section('content')
@include('member.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>ภาพรวมกิจการของคุณ</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>ยอดขายปี 2015</h4>
                <canvas id="overviewChart" width="500" height="400"></canvas>
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