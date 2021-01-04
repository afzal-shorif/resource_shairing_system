<section class="payment text-center">
    <img src="{{asset('images/ssl.png')}}" alt="" class="img-fluid">
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
                                <li>Phone: +88 01729-449083</li>
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

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    function resource_type(){
        var num = document.getElementById('selected_resource').value;

        if(num == 1){
            document.getElementById('book_field').style.display = "block";
            document.getElementById('slide_field').style.display = "none";
            document.getElementById('link_field').style.display = "none";
            document.getElementById('form').setAttribute('action', "{{url('upload_book')}}");

        }else if(num == 2) {
            document.getElementById('book_field').style.display = "none";
            document.getElementById('slide_field').style.display = "block";
            document.getElementById('link_field').style.display = "none";
            document.getElementById('form').setAttribute('action', "{{url('upload_slide')}}");
        }else {
            document.getElementById('book_field').style.display = "none";
            document.getElementById('slide_field').style.display = "none";
            document.getElementById('link_field').style.display = "block";
            document.getElementById('form').setAttribute('action', "{{url('upload_link')}}");
        }
    }

</script>

</body>
</html>
