@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">ข่าว</h3>

        <!-- Widget ---- -->
        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">
                    <a href="<?php echo URL::to("faq/add");?>">เพิ่ม faq</a>
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
                        <th>ชื่อข่าว</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <th class="center"><?php echo $item->faq_id;?></th>
                        <th><?php echo $item->faq_name;?></th>
                        <th><a class="delete-btn" href="<?php echo URL::to("faq/delete?id={$item->faq_id}");?>">ลบ</a></th>
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
        $('.delete-btn').click(function(e){
            if(!window.confirm("Are you shure?")){
                e.preventDefault();
                return false;
            }
        });
    </script>

@endsection
