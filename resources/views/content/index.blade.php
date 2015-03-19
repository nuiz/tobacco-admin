@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">เนื้อหา</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">
                    <a href="<?php echo URL::to("content/addvideo");?>">เพิ่ม video</a> |
                    <a href="<?php echo URL::to("content/addbook");?>">เพิ่ม e-book</a>
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
                        <th>ชื่อเนื้อหา</th>
                        <th>ประเภท</th>
                        <th>หมวดหมู่</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <td class="center"><?php echo $item->content_id;?></td>
                        <td><?php echo $item->content_name;?></td>
                        <td><?php echo $item->content_type;?></td>
                        <td><?php echo $item->category_name;?></td>
                        <td>
                            <?php if($item->content_type=="video"){?>
                            <a href="<?php echo URL::to("content/video?content_id={$item->content_id}");?>">รายการ video</a>
                            <?php }else{?>
                                <a class="prettyP" href="<?php echo $item->content_type=="video"? $item->videos[0]->video_url: $item->book_url;?>?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]" title="<?php echo $item->content_description;?>">แสดงผล</a>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($item->content_type=="video"){?>
                            <a href="<?php echo URL::to("content/editvideo?id={$item->content_id}");?>">แก้ไข</a> /
                            <?php }else{?>
                            <a href="<?php echo URL::to("content/editbook?id={$item->content_id}");?>">แก้ไข</a> /
                            <?php }?>
                            <a href="<?php echo URL::to("content/delete?id={$item->content_id}");?>">ลบ</a>
                        </td>
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
