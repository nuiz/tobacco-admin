@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">Content</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">
                    <a href="<?php echo URL::to("content/addvideo");?>">add video</a> |
                    <a href="<?php echo URL::to("content/addbook");?>">add book</a>
                </h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th class="center"></th>
                        <th>Content Name</th>
                        <th>Type</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <th class="center"><?php echo $item->content_id;?></th>
                        <th><?php echo $item->content_name;?></th>
                        <th><?php echo $item->content_type;?></th>
                        <th><a class="prettyP" href="<?php echo $item->content_type=="video"? $item->video_url: $item->book_url;?>?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]" title="<?php echo $item->content_description;?>">display</a></th>
                        <th><a class="delete-btn" href="<?php echo URL::to("content/delete?id={$item->content_id}");?>">delete</a></th>
                    </tr>
                    <?php }?>
                    </tbody>
                    <!-- // Table body END -->
                </table>
                <!-- // Table END -->
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/css/prettyPhoto.css");?>">
    <script src="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/js/jquery.prettyPhoto.js");?>"></script>
    <script>
        $("a[rel^='prettyPhoto']").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            social_tools: false
        });

        $('.delete-btn').click(function(e){
            if(!window.confirm("Are you shure?")){
                e.preventDefault();
                return false;
            }
        });
    </script>

@endsection
