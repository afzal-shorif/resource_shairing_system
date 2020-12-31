<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.css')}}">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <style>
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
<body class="pb-5">
    <div class="container">
        <div class="row pt-3 pb-3 bg-dark text-white">
            <div class="col-12 col-sm-6">
                <a href="{{url('home')}}" style="text-decoration: none"><h4 class="m-0 text-white">Study Resource</h4></a>
            </div>
            <div class="col-12 col-sm-6" style="text-align: right;">
                <style rel="stylesheet">
                    .profileBTN{
                        border-radius: 5px !important;
                        border: 2px solid #049d2a;
                    }
                </style>

                <?php
                    echo Session::get('user_name')." &nbsp;";

                ?>
                <div class="btn-group">
                    <button type="button" class="btn profileBTN bg-dark text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if(Session::get('user_type')==2) echo "S";
                        else echo "T";
                        ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!--
                        <a href="{{url('/cart')}}" class="dropdown-item" type="button">Cart {{count(Session::get('cart'))}}</a>
                        -->
                        <a href="" class="dropdown-item" type="button">Profile</a>
                        <a href="{{url('/my_resource/1')}}" class="dropdown-item" type="button">My Resource</a>
                        <a href="{{url('/logout')}}" class="dropdown-item" type="button">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
