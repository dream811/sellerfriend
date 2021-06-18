<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" sizes="32x32" type="image/png">      


    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('js/summernote/summernote-bs4.min.css')}}">
    <!-- image preview -->
    <link rel="stylesheet" href="{{asset('js/image-preview/style.min.css')}}">

    <!-- DataTables  & Plugins -->
    <script src="{{asset('js/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <!-- <script src="{{asset('js/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/pdfmake/vfs_fonts.js')}}"></script> -->
    <script src="{{asset('js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('js/summernote/summernote-bs4.min.js')}}"></script>
    <!-- image preview -->
    <script src="{{asset('js/image-preview/imagepreview.js')}}"></script>
    
    @yield('third_party_stylesheets')

    @stack('page_css')
</head>
<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 9999999;
        background: rgba(255,255,255,0.8) url('{{asset('assets/images/system/loading.gif')}}') center no-repeat;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed dark-mode text-sm">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('scratch.ProductGetManage') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('scratch*')) ? 'color:yellow;' : '' }}">상품수집관리</span></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('product.SellTargetManage') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('product*')) ? 'color:yellow;' : '' }}">상품관리</span></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('order.Waiting') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('order*')) || (request()->routeIs('tpl*')) ? 'color:yellow;' : '' }}">주문관리</span></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('inventory.Manage') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('inventory*')) ? 'color:yellow;' : '' }}">재고관리</span></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('calculate.MonthlySalesManage') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('calculate*')) ? 'color:yellow;' : '' }}">정산관리</span></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('statistics.DailySaleStatus') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('statistics*')) ? 'color:yellow;' : '' }}">통계관리</span></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('operation.OpenMarketManage') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('operation*')) ? 'color:yellow;' : '' }}">운영관리</span></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('contact.Notice') }}" class="nav-link"><span style="font-size:12px; {{ (request()->routeIs('contact*')) ? 'color:yellow;' : '' }}">고객관리</span></a>
            </li>
        </ul>
        <!-- SEARCH FORM -->
        <!-- 
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
        </form> 
        -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img 
                        @if (Auth::user()->image != "")
                            src="{{asset('storage/'.Auth::user()->image)}}"
                        @else
                            src="{{asset('assets/images/logo.png')}}"
                        @endif
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img 
                            @if (Auth::user()->image != "")
                                src="{{asset('storage/'.Auth::user()->image)}}"
                            @else
                                src="{{asset('assets/images/logo.png')}}"
                            @endif
                            
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>가입날짜: {{ Auth::user()->created_at->format('Y-m-d') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">내설정</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            로그아웃
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.leftsidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">        
        <section class="content">
            @yield('content')
        </section>
    </div>

    {{-- <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Control Sidebar --> --}}
    
    
    @include('layouts.rightsidebar')
    <!-- /.control-sidebar -->
</div>
{{-- loading image --}}
<div class="overlay dark">
    <img style="display:none;" src="{{asset('assets/images/system/loading.gif')}}" alt="">
</div>
<script>
    // $.widget.bridge('uibutton', $.ui.button);
    // $(document).ajaxError(function(event, jqxhr, settings, exception) {
    // if (jqxhr.status == 401) {
    //     // unauthorized
    //     window.location.href = '/logon';
    // }
    // });

    //401오류 인경우 로그인 페이지로 리디렉션
    $.ajaxSetup({
        statusCode: {
            401: function(){
                // Redirec the to the login page.
                location.href = "/login";
            },
            419: function(){
                // Redirec the to the login page.
                location.href = "/login";
            }
        }
    });
</script>




@yield('third_party_scripts')
@yield('script')
@stack('page_scripts')
</body>
</html>
