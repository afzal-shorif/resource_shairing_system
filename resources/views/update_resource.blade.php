@include('layout/user_header')

<div class="row row_header" >
    <div class="col"><h5>Update Resource :</h5></div>
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

        <form action="{{url('update')}}" method="post" id="form" enctype="multipart/form-data">
            {{csrf_field()}}

            <div id="" class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2">Title</label>
                        <input type="text" name="title" class="form-control" id="inputAddress2" placeholder="Title" value="{{$resource->title}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="2">{{$resource->description}}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="inputState">Class</label>
                        <select name="class" id="inputState" class="form-control">
                            <?php
                            $selected = "";
                            foreach($class as $row){
                                if($row->class_id == $resource->class_id) $selected = "selected";
                                echo '<option '.$selected.' value="'.$row->class_id.'">'.$row->name.'</option>';
                                $selected = "";
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                        if($resource->type == 3){
                            // link
                    ?>
                        <div class="form-group col-sm-6">
                            <label for="inputAddress2">Link</label>
                            <input type="text" name="link" class="form-control" id="inputAddress2" placeholder="Link" value="{{old('link')}}">
                        </div>
                    <?php
                        }else{
                    ?>
                    <div class="form-group col-sm-6">
                        <label for="inputState">Price</label>
                        <input type="number" <?= $resource->type==1? "disabled": "";?> name="price" class="form-control" id="inputAddress2" placeholder="Price" value="<?= $resource->price; ?>">
                    </div>


                    <?php
                        }
                    ?>

                </div>
                <?php
                    if($resource->type != 3){
                ?>
                <div class="form-row">

                    <div class="form-group col-sm-6">
                        <label for="inputState">Cover Image</label>
                        <div class="custom-file">

                            <input type="file" name="cover_photo" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>

                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="inputState">File</label>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>

                <?php
                    }
                ?>
                <input type="hidden" name="resource_id" value="<?= $resource->resource_id?>">
                <div class="col p-0">
                    <button type="submit" name="submit" class="" style="border: 1px solid #ccc; border-radius: 3px; padding: 5px 10px;">Update</button>
                </div>
            </div>


        </form>
    </div>
</div>

@include('layout/footer')
