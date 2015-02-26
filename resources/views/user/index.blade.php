@extends('tp')

@section('content')
    <?php $level = ["user", "super admin", "admin", "cluster", "writer"];?>
    <div class="innerLR spacing-x2">
        <h3 class="">Cluster</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading"><a href="<?php echo URL::to('user/addcluster');?>">add cluster</a></h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th class="center"></th>
                        <th>Username</th>
                        <th>Level</th>
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
                        <th><?php echo $level[$item->level_id];?></th>
                        <th></th>
                    </tr>
                    <?php }?>
                    </tbody>
                    <!-- // Table body END -->
                </table>
                <!-- // Table END -->
            </div>
        </div>

        <h3 class="">Writer</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading"><a href="<?php echo URL::to('user/addwriter');?>">add writer</a></h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th class="center"></th>
                        <th>Username</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach([] as $key=> $item){?>
                    <tr>
                        <th class="center"><?php echo $item->account_id;?></th>
                        <th><?php echo $item->username;?></th>
                        <th><?php echo $level[$item->level_id];?></th>
                        <th></th>
                    </tr>
                    <?php }?>
                    </tbody>
                    <!-- // Table body END -->
                </table>
                <!-- // Table END -->
            </div>
        </div>
    </div>
@endsection
