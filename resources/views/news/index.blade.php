@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">ข่าว</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">
                    <a href="<?php echo URL::to("news/add");?>">เพิ่มข่าว</a>
                </h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th class="center">วันที่สร้าง</th>
                        <th>ภาพหน้าปก</th>
                        <th>ชื่อข่าว</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <td class="center"><?php echo date('d/m/Y', strtotime($item->created_at));?></td>
                        <td><img class="cover-thumb" src="<?php echo $item->news_cover_url;?>"></td>
                        <td><?php echo $item->news_name;?></td>
                        <td>
                            <a class="edit-btn" href="<?php echo URL::to("news/edit?id={$item->news_id}");?>">แก้ไข</a> /
                            <a class="delete-btn" href="<?php echo URL::to("news/delete?id={$item->news_id}");?>">ลบ</a>
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

    <style>
        .cover-thumb {
            width: 75px;
            height: 50px;
            object-fit: cover;
        }
    </style>
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
