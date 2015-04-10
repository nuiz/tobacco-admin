@extends('tp')

@section('content')
    <?php $level = ["user", "super admin", "admin", "cluster", "writer"];?>
    <div class="innerLR spacing-x2">
        <h3 class="">Cluster</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading"><a href="<?php echo URL::to('usercluster/add');?>">เพิ่ม cluster</a></h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th class="center">วันที่เพิ่ม</th>
                        <th>บัญชีผู้ใช้</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <th class="center"><?php $dtString = date("d/m/Y", strtotime($item->created_at)); echo $dtString;?></th>
                        <th><?php echo $item->username;?></th>
                        <th>
                            <a href="<?php echo URL::to("usercluster/edit?id=".$item->account_id);?>">แก้ไข</a> /
                            <a class="delete-btn" href="<?php echo URL::to("usercluster/delete?id=".$item->account_id);?>">ลบ</a>
                        </th>
                    </tr>
                    <?php }?>
                    </tbody>
                    <!-- // Table body END -->
                </table>
                <!-- // Table END -->
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('.delete-btn').click(function(e){
                if(!window.confirm('Are you shure?')){
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
