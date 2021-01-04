<!DOCTYPE html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{$title}}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <script src="{{asset('sss/javascripts/jquery.min.js')}}"></script>
    <script src="{{asset('sss/javascripts/popper.min.js')}}"></script>
    <script src="{{asset('sss/javascripts/bootstrap.min.js')}}"></script>
</head>
<body>
  <style type="text/css">
      *{
    margin: 0px;
        padding: 0px;
      }
      .row{
    display:flex;
    justify-content: space-between;
            align-items: center;
            padding: 40px 0px;

      }
      .carousel-item{
    height: 450px;
}
.carousel-item img{
    height: 470px;
}
.login_btn{
    margin-right: 10px;
}
.slider{
    margin-left: 60px;

  }
  .ca_slider{
    border-radius: 10px;
  }


  </style>

    <div style="text-align: center; font-family: times new roman;"class="container">
         <h1 style="margin-top: 20px">
    Study Resource.
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login">
                    <div class="login_btn">
                        <a class="btn btn-primary btn-block" href="{{url('/login/student')}}">Student</a>
                        <a class="btn btn-primary btn-block" href="{{url('/login/teacher')}}">Teachers</a>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <div class="slider">
                        <div id="demo" class="carousel slide ca_slider" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('/images/slide/1.jpeg')}}" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{asset('/images/slide/2.jpeg')}}" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{asset('/images/slide/3.jpeg')}}" alt="">
    </div>
    <div class="carousel-item ">
      <img src="{{asset('/images/slide/4.jpeg')}}" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{asset('/images/slide/5.jpeg')}}" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{asset('/images/slide/6.jpeg')}}" alt="">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
                    </div>
            </div>

        </div>

    </div>
</body>

</html>

