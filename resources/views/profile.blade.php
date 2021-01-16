@include('layout/user_header')

<!-- update First Name model -->
<div class="modal fade" id="update_firstname" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">First Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{url('/update_firstname')}}">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="text" class="form-control" name="first_name" value="{{$user_data[0]->first_name}}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- update Last Name model -->
<div class="modal fade" id="update_lastname" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Last Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{url('/update_lastname')}}">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="text" class="form-control" name="last_name" value="{{$user_data[0]->last_name}}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- update Email model -->
<div class="modal fade" id="update_email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{url('/update_email')}}">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="email" class="form-control" name="email" value="{{$user_data[0]->email}}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- update phone model -->
<div class="modal fade" id="update_phone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Phone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{url('/update_phone')}}">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="text" class="form-control" name="phone" pattern="01[5|6|7|8|9][0-9]{8}" value="{{$user_data[0]->phone}}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- update password model -->
<div class="modal fade" id="update_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{url('/update_password')}}">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="password" class="form-control mb-2" name="password" placeholder="New Password">
                <input type="password" class="form-control mb-2" name="password_confirmation" placeholder="Confirm New Password">
                <input type="password" class="form-control mb-2" name="old_password" placeholder="Current password">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- update profile picture model -->
<div class="modal fade" id="update_profile_pic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{url('/update_profile_picture')}}" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="file" class="form-control mb-2" name="picture" placeholder="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-right">Balance {{$balance}} BDT</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if(Session::get('success'))

                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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
    </div>
    <div class="row align-content-center pt-5">
        <div class="col pt-5">
            <div class="row pb-5 mb-5">
                <div class="col-6">
                    <style>
                        .title{
                            color: #a3a3a3;
                        }
                        .con{
                            display: flex; flex-direction: row; justify-content: flex-start;
                            border: 1px solid #ccc;
                            background: #dddddd;
                        }
                        .edit-icon{
                            border-left :1px solid #ccc; padding: 5px 10px;
                            cursor: pointer;
                        }
                        .content{
                            padding: 5px 10px;
                        }
                        .content input{
                            border: 0px;
                            background: transparent;
                        }
                        .icon{
                            border-right: 1px solid #ccc;
                            padding: 5px 10px;
                            background: #CCCCCC;
                        }
                        .supress_icon{
                            display: none;
                            cursor: pointer;
                        }
                    </style>

                    <div class="col mb-3">
                        <h6 class="title">First Name</h6>
                        <div class="con" style="">
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <div class="content" style="">
                                <input type="text" name="first_name" value="{{$user_data[0]->first_name}}" disabled>
                            </div>
                            <div class="edit-icon" style="margin-left: auto;"><i class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#update_firstname"></i></div>
                        </div>
                    </div>

                    <div class="col mb-3">
                        <h6 class="title">Last Name</h6>
                        <div class="con" style="">
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <div class="content" style="">
                                <input type="text" name="last_name" value="{{$user_data[0]->last_name}}" disabled>
                            </div>
                            <div class="edit-icon" style="margin-left: auto;"><i class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#update_lastname"></i></div>
                        </div>
                    </div>

                    <div class="col mb-3">
                        <h6 class="title">Email</h6>
                        <div class="con" style="">
                            <div class="icon"><i class="fa fa-envelope"></i></div>
                            <div class="content" style="">
                                <input type="text" name="email" value="{{$user_data[0]->email}}" disabled>
                            </div>
                            <div class="edit-icon" style="margin-left: auto;"><i class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#update_email"></i></div>
                        </div>
                    </div>

                    <div class="col mb-3">
                        <h6 class="title">Phone</h6>
                        <div class="con" style="">
                            <div class="icon"><i class="fa fa-phone"></i></div>
                            <div class="content" style="">
                                <input type="text" name="phone" value="{{$user_data[0]->phone}}" disabled>
                            </div>
                            <div class="edit-icon" style="margin-left: auto;">
                                <i class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#update_phone"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <h6 class="title">Password</h6>
                        <div class="con" style="">
                            <div class="icon"><i class="fa fa-key"></i></div>
                            <div class="content" style="">
                                <input type="password" name="password" value="password" disabled>
                            </div>
                            <div class="edit-icon" style="margin-left: auto;">
                                <i class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#update_password"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <h6 class="title">Type</h6>
                        <div class="con" style="">
                            <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                            <div class="content" style="">
                                @if(Session::get('user_type') == 1)
                                    <input type="text" name="name" value="Teacher" disabled>
                                @elseif(Session::get('user_type') == 2) <input type="text" name="name" value="Student" disabled>
                                @else <input type="text" name="name" value="Admin" disabled>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <style>
                    #profile_pic_container{
                        background-image: url('{{asset('storage/profile/'.$user_data[0]->picture)}}');
                        background-repeat: no-repeat;
                        width:140px;
                        height: 160px;
                        position: relative;
                        text-align: center;
                    }
                </style>
                <div class="col-6 justify-content-end text-right">
                    <div class="justify-content-center text-center" style="display: inline-block; border: 1px solid #ccc; padding: 5px; border-radius: 3px;">
                        <div class="border" onmouseover="show_update_button()" onmouseleave="hide_update_button()" id="profile_pic_container">
                            <div id="profile_pic_btn" style="display: none;  position: absolute; bottom: 0; width: 100%; background-color: #88848469;">
                                <p  class="text-center" style="margin: 5px;">Upload  <i class="fa fa-cloud-upload" data-bs-toggle="modal" data-bs-target="#update_profile_pic"></i></p>
                            </div>
                        </div>
                        <h5 style="margin: 0px;">{{$user_data[0]->username}}</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var profile_btn = document.getElementById('profile_pic_btn');
    function show_update_button() {
        profile_btn.style.display = "block";
    }
    function hide_update_button() {
        profile_btn.style.display = "none";
    }

</script>
@include('layout/footer')
