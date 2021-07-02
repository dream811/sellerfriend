<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Registration Page</title>

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
<body class="bgimg-1 hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">회원 가입</p>
            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text"
                           name="name"
                           class="rounded-0 form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="이름">
                    <div class="input-group-append">
                        <div class="rounded-0 input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="rounded-0 form-control @error('email') is-invalid @enderror"
                           placeholder="이메일">
                    <div class="input-group-append">
                        <div class="rounded-0 input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           class="rounded-0 form-control @error('password') is-invalid @enderror"
                           placeholder="비밀번호">
                    <div class="input-group-append">
                        <div class="rounded-0 input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password_confirmation"
                           class="rounded-0 form-control"
                           placeholder="비밀번호 재확인">
                    <div class="input-group-append">
                        <div class="rounded-0 input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label style="font-size:12px;" for="agreeTerms">
                                <a href="#">이용약관</a>에 동의합니다
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" style="font-size:12px;" class="btn btn-primary btn-block rounded-0">회원가입</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a href="{{ route('login') }}" style="font-size:12px;" class="text-center">로그인페이지로 가기</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
