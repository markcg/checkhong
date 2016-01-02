@extends('layouts.app')

@section('content')
@include('property.menu')
<div class="row home_main_section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>จัดการห้อง</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center property_wrapper">
                <div class="col-xs-12"><h3>มกราคม</h3></div>
                <table class="booking_calendar">
                    <thead>
                        <tr class="booking_calendar-date">
                            <th>Room</th>
                            <th>1<br><?php echo date("D", mktime(0, 0, 0, 1, 1, 2016)); ?></th>
                            <th>2<br><?php echo date("D", mktime(0, 0, 0, 1, 2, 2016)); ?></th>
                            <th>3<br><?php echo date("D", mktime(0, 0, 0, 1, 3, 2016)); ?></th>
                            <th>4<br><?php echo date("D", mktime(0, 0, 0, 1, 4, 2016)); ?></th>
                            <th>5<br><?php echo date("D", mktime(0, 0, 0, 1, 5, 2016)); ?></th>
                            <th>6<br><?php echo date("D", mktime(0, 0, 0, 1, 6, 2016)); ?></th>
                            <th>7<br><?php echo date("D", mktime(0, 0, 0, 1, 7, 2016)); ?></th>
                            <th>8<br><?php echo date("D", mktime(0, 0, 0, 1, 8, 2016)); ?></th>
                            <th>9<br><?php echo date("D", mktime(0, 0, 0, 1, 9, 2016)); ?></th>
                            <th>10<br><?php echo date("D", mktime(0, 0, 0, 1, 10, 2016)); ?></th>
                            <th>11<br><?php echo date("D", mktime(0, 0, 0, 1, 11, 2016)); ?></th>
                            <th>12<br><?php echo date("D", mktime(0, 0, 0, 1, 12, 2016)); ?></th>
                            <th>13<br><?php echo date("D", mktime(0, 0, 0, 1, 13, 2016)); ?></th>
                            <th>14<br><?php echo date("D", mktime(0, 0, 0, 1, 14, 2016)); ?></th>
                            <th>15<br><?php echo date("D", mktime(0, 0, 0, 1, 15, 2016)); ?></th>
                            <th>16<br><?php echo date("D", mktime(0, 0, 0, 1, 16, 2016)); ?></th>
                            <th>17<br><?php echo date("D", mktime(0, 0, 0, 1, 17, 2016)); ?></th>
                            <th>18<br><?php echo date("D", mktime(0, 0, 0, 1, 18, 2016)); ?></th>
                            <th>19<br><?php echo date("D", mktime(0, 0, 0, 1, 19, 2016)); ?></th>
                            <th>20<br><?php echo date("D", mktime(0, 0, 0, 1, 20, 2016)); ?></th>
                            <th>21<br><?php echo date("D", mktime(0, 0, 0, 1, 21, 2016)); ?></th>
                            <th>22<br><?php echo date("D", mktime(0, 0, 0, 1, 22, 2016)); ?></th>
                            <th>23<br><?php echo date("D", mktime(0, 0, 0, 1, 23, 2016)); ?></th>
                            <th>24<br><?php echo date("D", mktime(0, 0, 0, 1, 24, 2016)); ?></th>
                            <th>25<br><?php echo date("D", mktime(0, 0, 0, 1, 25, 2016)); ?></th>
                            <th>26<br><?php echo date("D", mktime(0, 0, 0, 1, 26, 2016)); ?></th>
                            <th>27<br><?php echo date("D", mktime(0, 0, 0, 1, 27, 2016)); ?></th>
                            <th>28<br><?php echo date("D", mktime(0, 0, 0, 1, 28, 2016)); ?></th>
                            <th>29<br><?php echo date("D", mktime(0, 0, 0, 1, 29, 2016)); ?></th>
                            <th>30<br><?php echo date("D", mktime(0, 0, 0, 1, 30, 2016)); ?></th>
                            <th>31<br><?php echo date("D", mktime(0, 0, 0, 1, 31, 2016)); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="booking_calendar-room" id="A1">
                            <td>A1</td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td>
                        </tr>
                        <tr class="booking_calendar-room" id="A2">
                            <td>A2</td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td>
                        </tr>
                        <tr class="booking_calendar-room" id="A3">
                            <td>A3</td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td>
                        </tr>
                        <tr class="booking_calendar-room" id="A4">
                            <td>A4</td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td>
                        </tr>
                        <tr class="booking_calendar-room" id="A5">
                            <td>A5</td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td>
                        </tr>
                        <tr class="booking_calendar-room" id="B1">
                            <td>B1</td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
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
    #A1 td:nth-child(18){
        background-color: red;
    }
</style>
@endsection

@section('script')
@endsection