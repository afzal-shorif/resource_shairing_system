@include('layout/user_header')
<div class="container">
    <div class="row row_header" >
        <div class="col"><h5>Add Resource :</h5></div>
    </div>
    <div class="row justify-content-center row_style">
        <div class="col p-4">

            @if(Session::get('success'))

                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::get('error'))

                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif

            <div class="form-row">
                <div class="form-group col-sm-3 col-md-2">
                    <label for="inputState">Type</label>
                    <select name="category" id="selected_resource" class="form-control" onchange="resource_type()">
                        <option selected="" value="1">Book</option>
                        <option value="2">Slide</option>
                        <option value="3">Link</option>
                    </select>
                </div>
            </div>

            <form action="{{url('upload_book')}}" method="post" id="form" enctype="multipart/form-data">
                {{csrf_field()}}
                <div id="book_field">
                    <div class="form-row">
                        <div class="form-group col-sm-9 col-md-9 col-lg-6">
                            <label for="inputAddress2">Title</label>
                            <input type="text" name="book_title" class="form-control" id="inputAddress2" placeholder="Title" value="{{old('book_title')}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-9 col-md-9 col-lg-6">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea name="book_description" class="form-control" id="exampleFormControlTextarea1" rows="2">{{old('book_description')}}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">Class</label>
                            <select name="book_class" id="inputState" class="form-control">
                                <?php
                                foreach($class as $row){
                                    echo '<option value="'.$row->class_id.'">'.$row->name.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">Price</label>
                            <input type="number" name="book_price" class="form-control" id="inputAddress2" placeholder="Price" value="{{old('price')}}">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">Cover Image</label>
                            <div class="custom-file">

                                <input type="file" name="book_cover_photo" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>

                            </div>
                        </div>

                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">File</label>
                            <div class="custom-file">

                                <input type="file" name="book_file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>

                            </div>
                        </div>
                    </div>

                </div>


                <div id="slide_field" style="display: none;">
                    <div class="form-row">
                        <div class="form-group col-sm-8 col-md-8 col-lg-6">
                            <label for="inputAddress2">Title</label>
                            <input type="text" name="slide_title" class="form-control" id="inputAddress2" placeholder="Title" value="{{old('slide_title')}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-8 col-md-8 col-lg-6">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea name="slide_description" class="form-control" id="exampleFormControlTextarea1" rows="2">{{old('slide_description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">Class</label>
                            <select name="slide_class" id="inputState" class="form-control">
                                <?php
                                foreach($class as $row){
                                    echo '<option value="'.$row->class_id.'">'.$row->name.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">Price</label>
                            <input type="number" name="slide_price" class="form-control" id="inputAddress2" placeholder="Price" value="{{old('price')}}">
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">Cover Image</label>
                            <div class="custom-file">
                                <input type="file" name="slide_cover_photo" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>

                            </div>
                        </div>

                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">File</label>
                            <div class="custom-file">
                                <input type="file" name="slide_file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="link_field" style="display: none;">
                    <div class="form-row">
                        <div class="form-group col-sm-8 col-md-8 col-lg-6">
                            <label for="inputAddress2">Title</label>
                            <input type="text" name="link_title" class="form-control" id="inputAddress2" placeholder="Title" value="{{old('link_title')}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-9 col-md-9 col-lg-6">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea name="link_description" class="form-control" id="exampleFormControlTextarea1" rows="2">{{old('link_description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputState">Class</label>
                            <select name="link_class" id="inputState" class="form-control">
                                <?php
                                foreach($class as $row){
                                    echo '<option value="'.$row->class_id.'">'.$row->name.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-4 col-md-4 col-lg-3">
                            <label for="inputAddress2">Link</label>
                            <input type="text" name="link" class="form-control" id="inputAddress2" placeholder="Link" value="{{old('link')}}">
                        </div>
                    </div>
                </div>
                <div class="col p-0">
                    <button type="submit" name="submit" class="" style="border: 1px solid #ccc; border-radius: 3px; padding: 5px 10px;">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layout/footer')
