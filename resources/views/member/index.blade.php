@extends('layouts.app')

@section('content')

<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="col-sm-2">
            @include('member.menu')
        </div>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>ภาพรวมกิจการของคุณ</h1>
                </div>
            </div>
            <div class="row">
                @if(Session::has('hasProperty'))
                @if(Session::get('hasProperty'))
                <div class="col-xs-12 text-center">
                    <h4>ยอดขายปี 2015</h4>
                    <canvas id="overviewChart" width="500" height="400"></canvas>
                </div>
                @else
                <div class="col-xs-12 text-center">
                    <h4>คุณยังไม่มีโรงแรมในระบบของเรา</h4>
                    <a href="/member/create-property"><button class="btn btn-lg btn-success">สร้างโรงแรมของคุณ</button></a>
                </div>
                @endif
                @endif
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
    var ctx = $("#overviewChart").get(0).getContext("2d");
// This will get the first returned node in the jQuery collection.
var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
    {
        label: "My First dataset",
        fillColor: "rgba(220,220,220,0.5)",
        strokeColor: "rgba(220,220,220,0.8)",
        highlightFill: "rgba(220,220,220,0.75)",
        highlightStroke: "rgba(220,220,220,1)",
        data: [65, 59, 80, 81, 56, 55, 40]
    },
    ]
};
var overviewChart = new Chart(ctx).Bar(data);
</script>
@endsection
