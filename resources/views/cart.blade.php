    @include('layout/user_header')
        <style>

            .list_item{
                padding-top: 20px;
                padding-bottom: 10px;
            }
        </style>
<div class="container">
    <div class="row" style="border: 1px solid #ddd; padding-top: 8px; padding-bottom: 5px; margin-bottom: 5px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
        <div class="col">
            <h5>Cart</h5>
        </div>
    </div>
    <div class="row" style="box-shadow: 3px 3px 10px #ccc; border: 1px solid #ddd; border-radius: 3px;">
        <div class="col pb-3">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="border-color: #ddd;">#</th>
                    <th scope="col" style="border-color: #ddd;">Title</th>
                    <th scope="col" style="border-color: #ddd;">Price</th>
                    <th scope="col" style="border-color: #ddd;">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $num = 0;
                $total = 0;
                foreach($data as $row){
                $num++;
                $total += $row->price;
                ?>

                <tr>
                    <td>{{$num}}</td>
                    <td>{{$row->title}}</td>
                    <td>{{$row->price}}</td>
                    <td><a href="{{url('/remove_to_cart/'.$row->resource_id)}}"><i class="fa fa-trash"></i></a></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        @if($total>0)
                            <p style="">{{'Total: '.$total}}</p>
                        @endif
                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>

            @if(count($data)>0)
                <a href="{{url('/payment')}}"><button class="btn" style="float: right; border: 1px solid #ddd;">Confirm</button></a>
            @endif

        </div>
    </div>
</div>
@include('layout/footer')
