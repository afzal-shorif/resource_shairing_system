
@include('layout/header')

<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h1 class="text-center">Admin Login</h1>
            @if(Session::get('error'))

            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
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
                    <form method="post" action="{{url('/check')}}">
                        {{csrf_field()}}
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="remember-me" value="option1" checked name="remember_me">
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <input type="submit" value="Sign In" class="btn btn-primary btn-block" name="login" />

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<script src="{{asset('vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/nano-scroller/nano-scroller.js')}}"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="{{asset('javascripts/template-script.min.js')}}"></script>
<script src="{{asset('javascripts/template-init.min.js')}}"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>

</html>
