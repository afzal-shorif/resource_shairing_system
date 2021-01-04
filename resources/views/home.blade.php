@include('layout/user_header')
        <!--
        <div class="row" style="box-shadow: 3px 3px 10px #ccc; border: 1px solid #ddd; border-radius: 3px;">
            <div class="col" style="">
                <ul class="list-unstyled">

                </ul>
            </div>
        </div>
    </div>
-->
<section class="why-we-us-area">
    <div class="container">
        <div class="why-we-us">
            <div class="row">
                <div class="col-sm-5">
                    <div class="wwu">
                        <h3>Class-<?php echo last(request()->segments()); ?></h3>
                        <div class="divider"></div>
                        <p>Build your knowledge quickly from concise, well-presented content from top experts.</p>
                        <p>Instead of scrolling through pages of text, you can flip hrough a Resource Share deck and absorb the same information in a fraction of the time.</p>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<section class="populer-item-area">
    <div class="container">
        <div class="populer">
            <div class="sc-header">
                <h3>For Class <?php echo strtoupper($num_to_word[last(request()->segments())]); ?></h3>
            </div>
            <div class="row">

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
