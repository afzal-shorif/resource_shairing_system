@include('layout/user_header')

<section class="populer-item-area">
    <div class="container">
        <div class="populer">

            <div class="row">

                <?php
                $page = 1;
                if(isset($_GET['page'])) $page = $_GET['page'];

                foreach ($files as $file){
                $type = 'Free';
                $button = 'Download <i class="fa fa-download"></i>';
                $link = '/download/'.$file->source.'/'.$file->resource_id;

                if((int)$file->price != 0){
                    $type = $file->price.' Tk';

                    if(!in_array((int)$file->resource_id, $purchase)){
                        $button = 'Add to Cart <i class="fa fa-cart-plus"></i>';
                        $link = 'add_to_cart/'.$page.'/'.$file->resource_id;
                    }
                }
                ?>


                <div class="col-md-6">
                    <div class="single-populer clearfix">
                        <img src="{{asset('storage/thumbnail/'.$file->thumbnail)}}" alt="">
                        <div class="populer-contents">
                            <h3><?= $file->title; ?></h3>
                            <h5>by {{$file->first_name.' '.$file->last_name}} / {{\Carbon\Carbon::parse($file->updated_at)->format('d M Y')}}</h5>
                            <p><?= substr($file->description, 0, 80).'...';?></p>
                            <?php
                            if((int)$file->type == 3){
                                echo '<a href="'.$file->source.'" target="_blank">Link</a>';
                            }else{
                            ?>
                            <a href="{{url($link)}}" style="font-size: 18px;">
                                <?= $button; ?>
                            </a>
                            <?php } ?>
                            <div class="populer-price">
                                <p><?= $type; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <!-- END -->
            </div>
        </div>

        <div class="resource-pagination">
            <div class="col-12 d-flex justify-content-center">
                {{ $files->links()}}
            </div>
        </div>
    </div>
</section>
@include('layout/footer')
