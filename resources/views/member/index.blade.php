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
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,0.8)",
                highlightFill: "rgba(151,187,205,0.75)",
                highlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };
    var overviewChart = new Chart(ctx).Bar(data);
</script>
@endsection