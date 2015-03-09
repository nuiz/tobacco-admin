@extends('tp')

@section('content')
    <?php $level = ["user", "super admin", "admin", "cluster", "writer"];?>
    <div class="innerLR spacing-x2">
        <h3 class="">Writer</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading"><a href="<?php echo URL::to('userwriter/add');?>">เพิ่ม writer</a></h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Username</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <th class="center"><?php echo $item->account_id;?></th>
                        <th><?php echo $item->username;?></th>
                        <th>
                            <a class="delete-btn" href="<?php echo URL::to("userwriter/delete?id=".$item->account_id);?>">ลบ</a>
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
