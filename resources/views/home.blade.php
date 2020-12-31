@include('layout/user_header')
    <!--
        <a href="{{url('/cart')}}" style="float: right;">cart {{count(Session::get('cart'))}}</a>
        <a href="{{url('/logout')}}" style="float: right; margin-left: 10px; margin-right: 10px;">Logout</a>
        <h3 style="width: 1007px; margin: 0 auto; margin-bottom: 10px;">Available Resources:</h3>

       -->
        <style>

            .list_item{
                padding-top: 20px;
                padding-bottom: 10px;
            }
        </style>
        <div class="row" style="border: 1px solid #ddd; padding-top: 8px; padding-bottom: 5px; margin-bottom: 5px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
            <div class="col">
                <div class="dropdown">
                    <button class="btn class_btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        class <?php echo last(request()->segments()); ?> &nbsp; &nbsp; &nbsp; &nbsp;
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                        foreach($class as $row){
                        ?>
                        <a class="dropdown-item" href="{{url('home/'.$row->class_id)}}"><?= $row->name;?></a>
                            <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col">
                <p class="text-right" style="overflow: hidden;">
                    <a href="{{url('/cart')}}" style="float: right;">
                        <i class="fa fa-cart-plus" style="margin-right: 5px;"></i>{{count(Session::get('cart'))}}
                    </a>
                </p>
            </div>

        </div>
        <div class="row" style="box-shadow: 3px 3px 10px #ccc; border: 1px solid #ddd; border-radius: 3px;">
            <div class="col" style="">
                <ul class="list-unstyled">
                    <?php
                        $page = 1;
                        if(isset($_GET['page'])) $page = $_GET['page'];

                        foreach ($files as $file){
                            $type = 'Free';
                            $button = 'Download <i class="fa fa-download"></i>';
                            $link = '/download/'.$file->source;

                            if((int)$file->price != 0){
                                $type = $file->price.' Tk';

                                if(!in_array((int)$file->resource_id, $purchase)){
                                    $button = 'Add to Cart <i class="fa fa-cart-plus"></i>';
                                    $link = 'add_to_cart/'.$page.'/'.$file->resource_id;
                                }
                            }

                    ?>
                    <li class="media list_item" style="margin-bottom: 15px;">
                        <img class="mr-3" src="{{asset('storage/thumbnail/'.$file->thumbnail)}}" alt="Image">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1"><?= $file->title; ?> <span style="float: right;"><?= $type; ?></span></h5>
                            <p><?= $file->description; ?></p>
                            <?php
                                if((int)$file->type == 3){
                                    echo '<a href="'.$file->source.'" target="_blank">Link</a>';
                                }else{
                            ?>
                            <a href="{{url($link)}}" style="font-size: 18px;">
                                <?= $button; ?>
                            </a>
                            <?php } ?>
                        </div>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                {{ $files->links()}}
            </div>
        </div>
    </div>
@include('layout/footer')
