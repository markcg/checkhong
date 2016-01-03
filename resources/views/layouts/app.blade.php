<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Check Hong</title>

        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'/>

        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/assets/css/app.css" rel="stylesheet" type="text/css"/>
        @yield('style')
        <style>
            .fa-btn {
                margin-right: 6px;
            }
            #checkhong-logo{
                margin-top: -10px;
                display: inline;
            }
        </style>
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img id="checkhong-logo" height="25" src="/images/public/checkhonglogo.jpg">
                        CheckHong
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (!Session::has('member'))
                        <li><a href="{{ url('/') }}">หน้าแรก</a></li>
                        @else
                        <li><a href="{{ url('/member/property') }}"><i class="fa fa-btn fa-calendar"></i>จัดกาารกิจการ</a></li>
                        <li><a href="{{ url('/property') }}"><i class="fa fa-btn fa-sign-out"></i>บริหารกิจการ</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!Session::has('member'))
                        <li><a href="{{ url('/login') }}">ลงชื่อเข้าใช้</a></li>
                        <li><a href="{{ url('/register') }}">สมัครสมาชิก</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Session::get('member')->email }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/member') }}"><i class="fa fa-btn fa-calendar"></i>จัดกาารกิจการ</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>ล้อคเอ้าท์</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- JavaScripts -->
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @yield('script')
</body>
</html>
