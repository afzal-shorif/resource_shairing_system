@include('admin.header')
@include('admin.nav')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User Details</h1>
    <div class="row mb-5 mt-5">
       <div class="col-6 col-sm-6 col-md-2">
           <h4>Name : </h4>
           <h6>Email : </h6>
           <h6>Phone : </h6>

           <h6>Type : </h6>

           <h6>Sign Up:  </h6>
           <h6>Resource : </h6>
       </div>

        <div class="col-6 col-sm-6 col-md-4">
            <h4>{{$user[0]->first_name.' '.$user[0]->last_name}}</h4>
            <h6>{{$user[0]->email}}</h6>
            <h6>{{$user[0]->phone}}</h6>
            @if($user[0]->user_type == 1)
                <h6>Teacher</h6>
            @else
                <h6>Student</h6>
            @endif
            <h6>{{\Carbon\Carbon::parse($user[0]->created_at)->format('d M Y')}}</h6>
            <h6>{{$user[0]->total_resource}}</h6>
        </div>

        <style>
            #profile_pic_container{
                background-image: url('{{asset('storage/profile/'.$user[0]->picture)}}');
                background-repeat: no-repeat;
                width:140px;
                height: 160px;
                position: relative;
                text-align: center;
            }
        </style>


        <div class="col-md-6 justify-content-end text-right">
            <div class="justify-content-center text-center" style="display: inline-block; border: 1px solid #ccc; padding: 5px; border-radius: 3px;">
                <div class="border" id="profile_pic_container">
                    <div id="profile_pic_btn" style="display: none;  position: absolute; bottom: 0; width: 100%; background-color: #88848469;">

                    </div>
                </div>
                <h5 style="margin: 0px;">{{$user[0]->username}}</h5>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Resource</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Class</th>
                        <th>Price</th>
                        <th>Create At</th>
                        <th>Download</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Class</th>
                        <th>Price</th>
                        <th>Create At</th>
                        <th>Download</th>
                        <th>Edit</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($resource as $row)
                        <tr>
                            <td>{{$row->title}}</td>
                            <td>Class {{$row->class_id}}</td>
                            <td>Class {{$row->price}}</td>
                            <td>{{\Carbon\Carbon::parse($row->created_at)->format('d M Y')}}</td>
                            @if($row->download_count > 0)
                            <td>{{$row->download_count}}</td>
                            @else
                                <td>0</td>
                            @endif
                            <td>
                                @if($row->type == 3)
                                    <a href="{{url($row->source)}}" target="_blank"><i class="fa fa-link"></i></a>
                                @else
                                    <a href="{{url('/download/'.$row->source.'/'.$row->resource_id)}}"><i class="fa fa-download"></i></a>
                                    @endif


                                <a href="{{url('delete_resource?resource_id='.$row->resource_id)}}"><i class="fa fa-trash" style="margin-left: 10px;"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@include('admin.footer')
