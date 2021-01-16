@include('admin.header')
@include('admin.nav')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{$page_name}}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$table_type}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Start date</th>
                        <th>Total Resource</th>
                        <th>Edit</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Start date</th>
                        <th>Total Resource</th>
                        <th>Edit</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($user as $row)
                    <tr>
                        <td>
                            <a href="{{url('/user_details?id='.$row->id)}}">
                            {{$row->first_name.' '.$row->last_name}}
                            </a>
                        </td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{\Carbon\Carbon::parse($row->created_at)->format('d M Y')}}</td>
                        <td>{{$row->total_resource}}</td>
                        <td>
                            <a href="{{url($action_url.$row->id)}}">
                                {{$action_text}}
                            </a>
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
