<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <!--
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('stylesheets/css/index_style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <style>
        .why-we-us-area {
            padding: 120px 0;
            background: #030d28;
            background-image: url({{asset('images/bg-1.png')}});
            background-position: right;
            background-repeat: no-repeat;
            background-size: contain;
        }
        .row_header{
            border: 1px solid #ddd;
            padding-top: 8px;
            padding-bottom: 5px;
            margin-bottom: 5px;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
        }
        .row_style{
            box-shadow: 3px 3px 10px #ccc;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .class_btn{
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fff;
            color: #000;
        }



    </style>
</head>
<body>

<header class="header-area">
    <div class="container">
        <div class="header">
            <nav class="navbar navbar-expand-lg">

                <a class="navbar-brand" href="{{url('home/1')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{url('/home/1')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Resource
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($class as $row)
                                <li><a class="dropdown-item" href="{{url('home/'.$row->class_id)}}">{{$row->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <form class="d-flex me-auto search-area" method="get" action="{{url('search')}}">
                        {{csrf_field()}}
                        <input class="form-control me-2 search" name="search" type="search" placeholder="Search" aria-label="Search">
                    </form>

                    <a href="{{url('/cart')}}" style="margin-right: auto;">
                        <i class="fa fa-cart-plus" style="margin-right: 5px;"></i>{{count(Session::get('cart'))}}
                    </a>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item m-auto" style="padding-right: 10px;">{{Session::get('user_name')}}</li>
                        <li class="nav-item dropdown">
                            <a class="nav-link userprofile" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('images/user.png')}}" alt="" width="20" class="img-rounded">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Session::get('user_type')==0)
                                <li><a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{url('/profile')}}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{url('/my_resource/1')}}">My Resources</a></li>
                                <li><a href="{{url('/cart')}}" class="dropdown-item">Cart {{count(Session::get('cart'))}}</a></li>
                                <li><a class="dropdown-item" href="{{url('/logout')}}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
