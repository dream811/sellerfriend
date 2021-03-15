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

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{asset('js/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('js/summernote/summernote-bs4.min.css')}}">

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
    @yield('third_party_stylesheets')
    @yield('third_party_javascript')

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
<section class="content">
    @yield('content')
</section>
{{-- loading image --}}
<div class="overlay dark">
    <img style="display:none;" src="{{asset('assets/images/system/loading.gif')}}" alt="">
</div>
<script>
    // $.widget.bridge('uibutton', $.ui.button);
    $(document).on({
        ajaxStart: function(){
            $("body").addClass("loading"); 
        },
        ajaxStop: function(){ 
            $("body").removeClass("loading"); 
        }    
    });
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
@yield('script')
</body>
</html>

