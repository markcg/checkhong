@extends('layouts.app')

@section('content')
<div class="row home_main_section-wrapper">
     <div class="container">
        <div class="col-sm-2">
            @include('property.menu')
        </div>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>จัดการห้อง</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center property_wrapper">
                    <div class="col-xs-12">
                        <h3><?php echo Session::get('month'); ?></h3>
                    </div>
                    <div class="col-xs-12 reserver_table">
                        <table class="booking_calendar">
                            <thead>
                                <tr class="booking_calendar-date">
                                    <?php $days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); ?>
                                    <th>Room</th>
                                    <?php for ($i = 1; $i <= $days; $i++) { ?>
                                    <th>{{$i}}<br><?php echo date("D", mktime(0, 0, 0, date('m'), $i, date('Y'))); ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody style="height: 400px; overflow-y: scroll;">
                                <?php foreach (Session::get('property')->rooms()->get() as $room): ?>
                                    <tr class="booking_calendar-room" id="{{$room->code}}">
                                        <td>{{$room->code}}</td>
                                        <?php
                                        $old = 0;
                                        for ($i = 1; $i <= $days; $i++):
                                            ?>
                                        <td>
                                            <?php
                                            $today = date("Y-m-d H:i:s", mktime(0, 0, 0, date('m'), $i, date('Y')));
                                            $todayEnd = date("Y-m-d H:i:s", mktime(23, 59, 59, date('m'), $i, date('Y')));
                                            if ($i == $days) {
                                                $tomorrow = date("Y-m-d H:i:s", mktime(0, 0, 0, date('m') + 1, 1, date('Y')));
                                            } else {
                                                $tomorrow = date("Y-m-d H:i:s", mktime(0, 0, 0, date('m'), $i + 1, date('Y')));
                                            }
                                            $booking = $room
                                            ->bookings()
                                            ->where('check_in', '<=', $todayEnd)
                                            ->where('check_out', '>=', $tomorrow)
                                            ->orWhere(function ($query) use ($room, $today, $todayEnd) {
                                                $query->where('room_id', '=', $room->id)
                                                ->whereBetween('check_in', [$today, $todayEnd]);
                                            })
                                            ->orWhere(function ($query) use ($room, $today, $todayEnd) {
                                                $query->where('room_id', '=', $room->id)
                                                ->whereBetween('check_out', [$today, $todayEnd]);
                                            })
                                            ->first();
                                            if ($booking) {
                                                if ($old != $booking->id) {
                                                    $color = sprintf("#%06x", rand(600000, 16777215));
                                                    $old = $booking->id;
                                                }
                                                ?>
                                                <div data-booking="{{$booking->id}}" class="booking-ball" style="background-color: {{$color}}"></div>
                                                <?php } ?>
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .booking_calendar{
        width: 100%;
    }
    .booking_calendar-date th{
        text-align: center;
        border-bottom: 1px solid white;
    }
    .booking_calendar-room td{
        border-right: 1px solid white;
        border-bottom: 1px solid white;
    }
    .booking_calendar-room td:nth-child(5n+1){
        background-color: #003300;
    }
    .booking-ball{
        margin: 0 auto;
        width: 20px;
        height: 20px;
        border-radius: 10px;
    }
    .reserver_table{
        overflow: scroll;
    }
</style>
@endsection

@section('script')
@endsection