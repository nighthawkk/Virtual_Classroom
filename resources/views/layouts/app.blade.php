<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iKhan Rocks!</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootaide.css') }}">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flipclock.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <header class="bg-white navbar-fixed-top box-shadow">
        <div class="container">
            <div class="navbar-header">
                <button class="btn btn-link visible-xs pull-right m-r m-t-sm" type="button" data-toggle="collapse" data-target=".navbar-demo-4">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="{{ url('/') }}" class="navbar-brand m-r-sm"><img src="img/logo.png" class="m-r-sm hide"><span class="h4 font-bold"><img src="{{ asset('images/VirtualClassroom.png') }}" alt="" width="100" height="100"></span></a>
            </div>
            <div class="collapse navbar-collapse navbar-demo-4">
                
                <!-- search form -->
                <form class="navbar-form navbar-left m-v-sm" action="{{ url('search') }}" role="search" style="width: 40%;" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm bg-light" placeholder="What course will your life take?" name="search" required="">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm bg-light">
                                    <i class="fa fa-search"></i>
                                </button> 
                            </span>
                        </div>
                    </div>
                </form>
                <!-- / search form -->
                <ul class="nav navbar-nav navbar-right">
                    
                    <li><a href="{{ url('courses') }}">All Courses</a></li>

                     <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else 
                        <li class="dropdown">
                            <a href class="dropdown-toggle clear" data-toggle="dropdown"> 
                                <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"> 
                                    @if(!empty(Auth::user()->profile_photo))
                                        <img src="{{ url(Auth::user()->profile_photo) }}">
                                    @else
                                        <img src="{{ url('user/no_photo/no_photo.png') }}">
                                    @endif
                                    <i class="on md b-white bottom"></i> 
                                    @include('messenger.unread-count')
                                </span> <span class="hidden-sm hidden-md">{{ Auth::user()->name }}</span>
                            </a>
                            <!--dropdown -->
                            <ul class="dropdown-menu w">
                                <li><a href="{{URL::to('messages')}}">Inbox @include('messenger.unread-count')</a></li>
                                 @if(Auth::user()->role_id == 2)
                                    <li><a href="{{ url('/register/course') }}">Register a Course</a></li>
                                    <li><a href="{{ url('/teacher/courses') }}">My Courses</a></li>
                                @endif
                                @if(Auth::user()->role_id == 1)
                                    <li><a href="{{ url('/student/courses') }}">My Courses</a></li>
                                @endif 

                                <li>
                                    <a href="{{ url('user/profile') }}">Profile</a>
                                </li>
                                
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('logout') }}">Logout</a>
                                </li>
                          
                            </ul>
                        <!--/ dropdown -->
                        </li>
                    @endif
                        <li class="dropdown">
                            <a href class="dropdown-toggle clear" data-toggle="dropdown">
                                  
                                <span class="hidden-sm hidden-md">Others</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu w">
                                <li><a href="{{ url('forum') }}">Forum</a></li>
                                <li><a href="{{ url('vc/library') }}">Library</a></li>
                            </ul>
                        </li>

                </ul>
            </div>
        </div>
    </header>

    @yield('content')

    </div>


    <!-- Footer -->
    <footer class="bg-dark">
        <div class="container">
            <div class="row p-v m-t-md text-center">
                
                <p class="m-b-none">
                    Build <!-- with <i class="fa fa-heart-o m-h-2x"></i> --> by <a href="https://www.facebook.com/narmivoshu" target="_blank"> Shuvo&Fahima</a>
                </p>
                <p>
                    2016 &copy; <a href="http:://www.vc.ikhan.rocks">vc.ikhan.rocks</a>
                </p>
            </div>
        </div>
</footer>

    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootaide.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="https://cdn.pubnub.com/pubnub-3.7.14.min.js"></script>
    <script src="https://cdn.pubnub.com/webrtc/webrtc.js"></script>
    <script src="https://cdn.pubnub.com/webrtc/rtc-controller.js"></script>
    <script src="{{ asset('js/flipclock.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script> 
    <script>
        
        @yield('script_clock')
        @yield('script_form')
    </script>
</body>
</html>
