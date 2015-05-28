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
                <div>
                    <form method="get" class="form-filter" style="line-height: 37px;">
                        <div class="row">
                            <div class="col-md-6">
                                <label>ชื่อเนื้อหา</label>
                                <input type="text" class="form-control" name="keyword" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword'];?>">
                            </div>
                            <div class="col-md-6">
                                <label>วันที่</label>
                                <div class="row">
                                    <div class="col-md-5"><input type="text" class="form-control" id="datepicker1" name="date_start" value="<?php if(isset($_GET['date_start'])) echo $_GET['date_start'];?>"></div>
                                    <div class="col-md-1 text-center">ถึง</div>
                                    <div class="col-md-5"><input type="text" class="form-control" id="datepicker2" name="date_end" value="<?php if(isset($_GET['date_end'])) echo $_GET['date_end'];?>"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>ประเภทเนื้อหา</label>
                                <select name="content_type" class="form-control">
                                    <option value="">All</option>
                                    <option value="video" <?php if(isset($_GET['category_id']) && $_GET['category_id']=='video') echo "selected";?>>Video</option>
                                    <option value="book" <?php if(isset($_GET['category_id']) && $_GET['category_id']=='book') echo "selected";?>>E-Book</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Category</label>
                                <select name="category_id" class="select2" placeholder="Category">
                                    <option value="0">All</option>
                                    <?php
                                    $catId = isset($_GET['category_id'])? $_GET['category_id']: false;
                                    function printCatName($cat, $category){
                                        if($cat->parent_id > 0){
                                            foreach($category as $value){
                                                if($value->category_id === $cat->parent_id){
                                                    return printCatName($value, $category)." > ".$cat->category_name;
                                                }
                                            }
                                            return $cat->category_name;
                                        }
                                        return $cat->category_name;
                                    }

                                    foreach($category as $cat){?>
                                    <option value="<?php echo $cat->category_id;?>"
                                    <?php echo $cat->category_id==$catId? "selected": "";?>><?php echo printCatName($cat, $category);//$cat->category_name;?></option>
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
                        <th class="center">วันที่สร้าง</th>
                        <th>ชื่อเนื้อหา</th>
                        <th>ประเภท</th>
                        <th>หมวดหมู่</th>
                        <th>แบบทดสอบ</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <td class="center"><?php $dtString = date('d/m/Y H:i', $item->created_at); echo $dtString;?></td>
                        <td><?php echo $item->content_name;?></td>
                        <td><?php echo $item->content_type;?></td>
                        <td><?php echo $item->category_name;?></td>
                        <td>
                            <a href="<?php echo URL::to("content/exam?id={$item->content_id}");?>">จัดการแบบทดสอบ</a>
                        </td>
                        <td>
                            <?php if($item->content_type=="video"){?>

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
                            <a class="delete-btn" href="<?php echo URL::to("content/delete?id={$item->content_id}");?>">ลบ</a>
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

    <script src="<?php echo URL::to("assets/selectize.js/dist/js/standalone/selectize.min.js");?>"></script>
    <link rel="stylesheet" href="<?php echo URL::to("assets/selectize.js/dist/css/selectize.css");?>">
    <link rel="stylesheet" href="<?php echo URL::to("assets/selectize.js/dist/css/selectize.bootstrap3.css");?>">

    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/locales/bootstrap-datepicker.th.js");?>"></script>

    <link rel="stylesheet" href="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/css/prettyPhoto.css");?>">
    <script src="<?php echo URL::to("assets/components/common/gallery/prettyphoto/assets/lib/js/jquery.prettyPhoto.js");?>"></script>

    <script>
        if (typeof $.fn.bdatepicker == 'undefined')
            $.fn.bdatepicker = $.fn.datepicker.noConflict();

        $(function(){
            $("#datepicker1").bdatepicker({
                format: 'yyyy-mm-dd',
                language: 'th'
            });
            $("#datepicker2").bdatepicker({
                format: 'yyyy-mm-dd',
                language: 'th'
            });
        });

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
    <style>
        div.pp_details .pp_nav {
            width: 0;
            height: 0;
            overflow: hidden;
        }
    </style>

@endsection
