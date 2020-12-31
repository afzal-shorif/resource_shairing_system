@include('layout/user_header')
        <div class="row row_header">
            <div class="col">
                <div class="dropdown">
                    <button class="btn dropdown-toggle class_btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Class <?php echo last(request()->segments()); ?> &nbsp; &nbsp; &nbsp; &nbsp;
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                        foreach($class as $row){
                        ?>
                        <a class="dropdown-item" href="{{url('my_resource/'.$row->class_id)}}"><?= $row->name;?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <p class="text-right"><a href="{{url('create_resource')}}" style="text-decoration: none;">Add Resource</a></p>
            </div>
        </div>

        <div class="row row_style">
            <div class="col">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Access</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $page = 1;
                    if(isset($_GET['page'])) $page = $_GET['page'];
                    $num = ($page-1)*8;
                    foreach($resources as $row){
                    $num++;
                    ?>
                    <tr>
                        <th scope="row"><?= $num; ?></th>
                        <td><a href="{{url('update_resource?resource_id='.$row->resource_id)}}"><?= $row->title; ?></a></td>
                        <td> <?= $row->visibility; ?></td>
                        <td><?= $row->price.' Tk';?></td>
                        <td>
                            <!--
                            <a href="create_product.php?id=4"><i class="fa fa-edit" style="margin-right: 10px;"></i></a>
                            -->
                            <a href="{{url('delete_resource?resource_id=').$row->resource_id}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col d-flex justify-content-center">
                {{ $resources->links()}}
            </div>
        </div>
    <!-- container class div close -->
    </div>
@include('layout/footer')
