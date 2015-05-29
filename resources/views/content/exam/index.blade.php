@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class=""><?php echo $content->content_name;?> (แบบทดสอบ)</h3>

        <!-- Widget ---- -->
        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">
                    เพิ่มแบบสอบถาม
                </h4>
            </div>
            <form class="form-horizontal" id="addvideo-form" role="form" method="post" enctype="multipart/form-data">
                <div>
                    <progress id="upload-progress" class="hidden" style="width: 100%" value="0" max="100"></progress>
                </div>
                <input type="hidden" name="content_id" value="<?php echo $content->content_id;?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">คำถาม</label>
                    <div class="col-sm-8">
                        <textarea name="questions[0][question]" class="form-control" required=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">คำตอบ</label>
                    <div class="col-sm-8">
                        <table class="table table-bordered table-primary">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th style="border-color: #3695d5; background-color: #3695d5;">ข้อถูก</th>
                                <th style="border-color: #3695d5; background-color: #3695d5;">คำตอบ</th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <tr>
                                <td><input type="radio" name="answer" value="0" required=""></td>
                                <td><textarea class="form-control" name="questions[0][choices][0][choice]" required=""></textarea></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="answer" value="1" required=""></td>
                                <td><textarea class="form-control" name="questions[0][choices][1][choice]" required=""></textarea></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="answer" value="2" required=""></td>
                                <td><textarea class="form-control" name="questions[0][choices][2][choice]" required=""></textarea></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="answer" value="3" required=""></td>
                                <td><textarea class="form-control" name="questions[0][choices][3][choice]" required=""></textarea></td>
                            </tr>
                            </tbody>
                            <!-- // Table body END -->
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">
                    List video
                </h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th>คำถาม</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody>
                    <?php foreach($items as $key=> $item){?>
                    <tr>
                        <td><?php echo $item->question;?></td>
                        <td>
                            <table class="table table-bordered table-primary">
                                <!-- Table heading -->
                                <thead>
                                <tr>
                                    <th style="border-color: #3695d5; background-color: #3695d5;">คำตอบ</th>
                                    <th style="border-color: #3695d5; background-color: #3695d5;">ถูก/ผิด</th>
                                </tr>
                                </thead>
                                <!-- // Table heading END -->
                                <!-- Table body -->
                                <tbody>
                                <?php foreach($item->choices as $key2=> $item2){?>
                                <tr class="<?php if($item2->is_answer==1) echo "success";?>">
                                    <td><?php echo $item2->choice;?></td>
                                    <td><?php echo $item2->is_answer? "ถูก": "ผิด";?></td>
                                </tr>
                                <?php }?>
                                </tbody>
                                <!-- // Table body END -->
                            </table>
                        </td>
                        <td>
                            <a href="<?php echo URL::to("exam/remove?question_id={$item->question_id}&content_id={$item->content_id}");?>" class="delete-btn">ลบ</a>
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
        .table-primary tbody tr.success td {
            background: #dff0d8 !important;
        }
    </style>

    <link rel="stylesheet" href="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/css/prettyPhoto.css");?>">
    <script src="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/js/jquery.prettyPhoto.js");?>"></script>

    <script src="<?php echo URL::to("/assets/Sortable/Sortable.min.js");?>"></script>

    <script>
        $(function(){
            $('.delete-btn').click(function(e){
                if(!window.confirm("Are you shure?")){
                    e.preventDefault();
                    return false;
                }
            });

            // form submit
            $('#addvideo-form').submit(function(e){
                e.preventDefault();
                var fd = new FormData(this);

                var inputs = $(":input", this);
                inputs.prop("disabled", true);

                var $progress = $('#upload-progress');

                $.ajax({
                    type: 'POST',
                    url: '',
                    data: fd,
                    contentType: false,
                    xhr: function()
                    {
                        $progress.removeClass("hidden");

                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = percentComplete * 100;
                                $progress.val(percentComplete);
                                //Do something with upload progress
                            }
                        }, false);
                        //Download progress
                        xhr.addEventListener("progress", function(evt){
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = percentComplete * 100;
                                $progress.attr('valut', percentComplete);
                                //Do something with download progress
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(data){
                        if(data.error == undefined){
                            notyfy({
                                text: 'Success',
                                type: 'success',
                                dismissQueue: true
                            });
                            setTimeout(function(){ window.location.reload(); }, 1000);
                        }
                        else {
                            notyfy({
                                text: 'No success',
                                type: 'error',
                                dismissQueue: true,
                                timeout: 3000
                            });
                            inputs.prop("disabled", false);
                            $progress.addClass("hidden");
                        }
                    },
                    error: function(){
                        notyfy({
                            text: 'No success',
                            type: 'error',
                            dismissQueue: true,
                            timeout: 3000
                        });
                        inputs.prop("disabled", false);
                        $progress.addClass("hidden");
                    },
                    dataType: 'json',
                    processData: false
                });

                return false;
            });

            //window.document.getElementById
        });
    </script>

    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>

@endsection
