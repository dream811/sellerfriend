<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .bgimg-1 {
            background-image: url('{{asset('assets/images/home.jpeg')}}');
            background-size: cover;
        }
    </style>
</head>

<body class="bgimg-1 hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"></p>

            <form method="post" action="{{ url('/login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="이메일"
                           class="form-control rounded-0 @error('email') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text rounded-0"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="비밀번호"
                           class="form-control rounded-0 @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text rounded-0">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember" style="font-size:12px;">아이디 저장</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <a style="font-size:12px;" href="{{ route('password.request') }}" class="float-right">비밀번호 찾기</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="submit" style="font-size:12px;" class="btn btn-primary rounded-0 btn-block float-left">로그인</button>
                    </div>
                    <div class="col-6">
                        <a style="font-size:12px;" href="{{ route('register') }}" class="btn btn-primary btn-block rounded-0 text-center float-right">회원가입</a>
                    </div>
                </div>
            </form>

            <p class="mt-1">
                
            
                
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
