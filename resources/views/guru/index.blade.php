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

                <div>
                    <form method="get" class="form-filter" style="line-height: 37px;">
                        <div class="row">
                            <div class="col-md-3">
                                <label>ชื่อผู้เชี่ยวชาญ</label>
                                <input type="text" class="form-control" name="firstname" value="<?php if(isset($_GET['firstname'])) echo $_GET['firstname'];?>">
                            </div>
                            <div class="col-md-3">
                                <label>นามสกุลผู้เชี่ยวชาญ</label>
                                <input type="text" class="form-control" name="lastname" value="<?php if(isset($_GET['lastname'])) echo $_GET['lastname'];?>">
                            </div>
                            <div class="col-md-6">
                                <label>ประเภทผู้เชี่ยวชาญ</label>
                                <select name="guru_cat_id" class="form-control" placeholder="Category">
                                    <option value="">All</option>
                                    <?php
                                    $catId = isset($_GET['guru_cat_id'])? $_GET['guru_cat_id']: false;
                                    foreach($category as $cat){?>
                                    <option value="<?php echo $cat->guru_cat_id;?>"
                                    <?php echo $cat->guru_cat_id==$catId? "selected": "";?>><?php echo $cat->guru_cat_name;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="row text-left" style="margin-bottom: 20px;">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning">Search</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        $(function(){
                            $('.select2').selectize();
                        });
                    </script>
                </div>

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
