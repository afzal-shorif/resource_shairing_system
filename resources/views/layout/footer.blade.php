<!-- container class div close  -->
</div>

<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="{{ asset('vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('vendor/nano-scroller/nano-scroller.js')}}"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<!--
<script src="{{ asset('javascripts/template-script.min.js')}}"></script>
<script src="{{ asset('javascripts/template-init.min.js')}}"></script>
-->
<!-- SECTION script and examples-->
<!-- ========================================================= -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
