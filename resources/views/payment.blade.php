@include('layout/user_header')
<div class="container">
    <div class="row animated fadeInUp pt-5 mb-5 pb-5">
        <div class="col-sm-12">
            <h4 class="section-subtitle mb-5"><b><h1>Payment Method Widget</h1></b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class=" table-bordered data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <div class="payment" style="display: flex;justify-content: space-between;padding: 30px;border-radius: 8px;">
                                @if(count(Session::get('cart'))>0)
                                <a href="{{url('/cart_confirm')}}"><img src="{{asset('images/payment/bkash.jpg')}}" alt="bkash" style="box-shadow: 0px 6px 15px 1px;border-radius: 8px;"></a>
                                <a href="{{url('/cart_confirm')}}"><img src="{{asset('images/payment/roket.jpg')}}" alt="roket" style="box-shadow: 0px 6px 15px 1px;border-radius: 8px;"></a>
                                <a href="{{url('/cart_confirm')}}"><img src="{{asset('images/payment/mycash.jpg')}}" alt="mycash" style="box-shadow: 0px 6px 15px 1px;border-radius: 8px;"></a>
                                <a href="{{url('/cart_confirm')}}"><img src="{{asset('images/payment/dbbl.jpg')}}" alt="" style="box-shadow: 0px 6px 15px 1px;border-radius: 8px;"></a>
                                @endif
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout/footer')

