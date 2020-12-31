@include('layout/header');
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h1 class="text-center">{{$header}}</h1>

            @if(Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            @endif

            @if (count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif

        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form method="post" action="{{url($register_type)}}">
                        {{csrf_field()}}
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Firt Name" name="first_name" value="{{ old('first_name') }}">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control"  placeholder="Email" name="email" value="{{ old('email') }}">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Username" name="username" value="{{ old('useranme') }}">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control"  placeholder="Password" name="password"value="">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>

                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control"  placeholder="Confirm Password" name="password_confirmation"value="">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="01*********" name="phone" pattern="01[5|6|7|8|9][0-9]{8}"value="{{ old('phone') }}">
                                <i class="fa fa-phone"></i>
                            </span>
                        </div>
                        <input type="hidden" name ="type" value="{{$type}}">
                        <div class="form-group">
                            <input class="btn btn-primary btn-block"type="submit" value="Register" name="register" />
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="{{$login_url}}">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
@include('layout/footer');
