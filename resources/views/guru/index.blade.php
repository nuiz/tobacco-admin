@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">ผู้เชี่ยวชาญ</h3>

        <!-- Widget ---- -->
        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">
                    <a href="<?php echo URL::to("guru/add");?>">เพิ่มผู้เชี่ยวชาญ</a>
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
                        <th>เพิ่มผู้เชี่ยวชาญ</th>
                        <th>หมวดหมู่</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <td class="center"><?php echo $item->guru_id;?></td>
                        <td><?php echo "{$item->firstname} {$item->lastname} ({$item->username})";?></td>
                        <td><?php echo $item->guru_cat_name;?></td>
                        <td>
                            <a href="<?php echo URL::to("guru/edit?id={$item->guru_id}");?>">แก้ไข</a> /
                            <a class="delete-btn" href="<?php echo URL::to("guru/delete?id={$item->guru_id}");?>">ลบ</a>
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
        $('.delete-btn').click(function(e){
            if(!window.confirm("Are you shure?")){
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
