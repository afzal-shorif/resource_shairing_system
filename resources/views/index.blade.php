@include('layout/header')
<style>
    .why-we-us-area {
        padding: 120px 0;
        background: #030d28;
        background-image: url({{asset('images/bg-1.png')}});
        background-position: right;
        background-repeat: no-repeat;
        background-size: contain;
    }
</style>
<header class="header-area">
    <div class="container">
        <div class="header">
            <nav class="navbar navbar-expand-lg">

                <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/index_page/logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Resource</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <form class="d-flex me-auto search-area">
                        <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/user_select')}}">Log In</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- END HEADER -->

<section class="banner-area">
    <img src="{{asset('images/index_page/slider-image-1.jpg')}}" alt="" class="img-fluid">
    <div class="container">
        <div class="banner">
            <div class="item-contents text-center">
                <h1>Best <br> Education Resource</h1>
                <a href="#" class="btn btn-danger btn-circle">about us</a>
            </div>
        </div>
    </div>
</section>
<!-- END BANNER -->

<section class="quick-about-area">
    <div class="container">
        <div class="quick-about">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-8 col-lg-5 offset-lg-1">
                            <h2 class="card-title">Welcome to <br>Our Online Resource Center.</h2>
                            <p>Founded in 2012 with the goal of making knowledge sharing easy, ResourceShare has since grown into a top destination for professional content.</p>
                            <p>With ver 18 million uploads in 40 content categories, it is today one of the top 100 most-visited websites in the world.</p>
                        </div>
                        <div class="col-sm-4 quick-items offset-lg-2">
                            <ul class="list-group list-group-flush justify-content-center">
                                <li class="list-group-item">
                                    <img src="{{asset('images/index_page/icon-1.png')}}" alt="">
                                    <h4>PPT Slides</h4>
                                    <p>100 courses</p>
                                </li>
                                <li class="list-group-item">
                                    <img src="{{asset('images/index_page/icon-2.png')}}" alt="">
                                    <h4>Books</h4>
                                    <p>10000 courses</p>
                                </li>
                                <li class="list-group-item">
                                    <img src="{{asset('images/index_page/icon-3.png')}}" alt="">
                                    <h4>Job Solutions</h4>
                                    <p>2000 courses</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<section class="our-resources-area">
    <div class="container">
        <div class="our-resources">
            <div class="sc-header text-center">
                <h3>Our Resources</h3>
            </div>

            <div class="row">
                <div class="col">
                    <div class="single-resources">
                        <img src="{{asset('images/index_page/img-1.png')}}" alt="" class="circle">
                        <div class="card">
                            <div class="card-body">
                                <h3>School</h3>
                                <p>60000 Files</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <div class="col">
                    <div class="single-resources">
                        <img src="{{asset('images/index_page/img-2.png')}}" alt="" class="circle">
                        <div class="card">
                            <div class="card-body">
                                <h3>Collage</h3>
                                <p>150000 Files</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <div class="col">
                    <div class="single-resources">
                        <img src="{{asset('images/index_page/img-3.png')}}" alt="" class="circle">
                        <div class="card">
                            <div class="card-body">
                                <h3>BSC/BA</h3>
                                <p>500000 Files</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <div class="col">
                    <div class="single-resources">
                        <img src="{{asset('images/index_page/img-4.png')}}" alt="" class="circle">
                        <div class="card">
                            <div class="card-body">
                                <h3>MSC/MA</h3>
                                <p>450000 Files</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->
            </div>
        </div>
    </div>
</section>

<section class="why-we-us-area">
    <div class="container">
        <div class="why-we-us">
            <div class="row">
                <div class="col-sm-5">
                    <div class="wwu">
                        <h3>Why study with us?</h3>
                        <div class="divider"></div>
                        <p>Build your knowledge quickly from concise, well-presented content from top experts.</p>
                        <p>Instead of scrolling through pages of text, you can flip hrough a Resource Share deck and absorb the same information in a fraction of the time.</p>
                        <a href="#" class="btn btn-danger btn-circle">Buy now</a>
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
                <h3>Popular items</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="single-populer clearfix">
                        <img src="{{asset('images/index_page/populer-1.jpg')}}" alt="">
                        <div class="populer-contents">
                            <h3>Artificial InteLligent</h3>
                            <h5>By hamid / 15 Jun 2020</h5>
                            <p>Artificial intelligence (AI) refers to the simulation of human intelligence in machines </p>
                            <a href="#">learn now</a>
                            <div class="populer-price">
                                <p>$600</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-populer clearfix">
                        <img src="{{asset('images/index_page/populer-2.jpg')}}" alt="">
                        <div class="populer-contents">
                            <h3>Spoken english</h3>
                            <h5>By Munzereen shahid / 12 may 2020</h5>
                            <p>Spoken English courses are designed to increase your active vocabulary</p>
                            <a href="#">learn now</a>
                            <div class="populer-price">
                                <p>$200</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-populer clearfix">
                        <img src="{{asset('images/index_page/populer-3.jpg')}}" alt="">
                        <div class="populer-contents">
                            <h3>HSC physics</h3>
                            <h5>By Niloy / 06 Jun 2020</h5>
                            <p>HSC Physics 1st & 2nd Paper Notes. HSC Physics Note. Physics is “knowledge, the science of nature”</p>
                            <a href="#">learn now</a>
                            <div class="populer-price">
                                <p>$60</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-populer clearfix">
                        <img src="{{asset('images/index_page/populer-4.jpg')}}" alt="">
                        <div class="populer-contents">
                            <h3>Job solution</h3>
                            <h5>By Rahim / 15 July 2020</h5>
                            <p>Professors Job Solution is a popular job solution guide to job seekers in Bangladesh</p>
                            <a href="#">learn now</a>
                            <div class="populer-price">
                                <p>$60</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="payment text-center">
    <img src="{{asset('images/index_page/ssl.png')}}" alt="" class="img-fluid">
</section>


<footer class="footer-area">
    <div class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-4">
                        <div class="footer-single">
                            <h2>Logo</h2>
                            <p>Founded in 2012 with the goal of making knowledge sharing easy, Slideshare has since grown into a top destination for professional content.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="footer-single">
                            <h3>USEFUL LINKS</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">Teachers</a></li>
                                <li><a href="#">Latest Courses</a></li>
                                <li><a href="#">Who we are</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="footer-single">
                            <h3>contact us</h3>
                            <ul class="list-unstyled">
                                <li>Phone: +88 01937766305</li>
                                <li>Email: resourceshare@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->
        <div class="footer-bottom text-center">
            <p>Copyright © 2020 All Rights Reserved</p>
        </div>
    </div>
</footer>


@include('layout/footer')
