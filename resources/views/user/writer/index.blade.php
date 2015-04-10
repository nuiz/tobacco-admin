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
                <div style="float: right; padding: 2px;">
                    <form class="filter-form" method="get">
                        <label>Cluster</label>
                        <select name="cluster_id">
                            <option value="">Cluster...</option>
                            <?php
                            $cluster_id = isset($_GET['cluster_id'])? $_GET['cluster_id']: null;
                            foreach($clusters as $cluster){
                                $selected = ($cluster->account_id == $cluster_id)? "selected": "";
                                echo <<<HTML
<option value="{$cluster->account_id}" {$selected}>{$cluster->firstname}</option>
HTML;
                            }?>
                        </select>
                    </form>
                    <script>
                        $(function(){
                            var form = $('.filter-form');
                            $('select', form).change(function(){
                                form.submit();
                            });
                        });
                    </script>
                </div>
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
                        <th>ชื่อ</th>
                        <th>กลุ่ม</th>
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
                        <th><?php echo $item->firstname." ".$item->lastname;?></th>
                        <th><?php echo $item->cluster->firstname;?></th>
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
