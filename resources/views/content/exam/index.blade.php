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
                                <th style="border-color: #3695d5; background-color: #3695d5;">ข้อที่ถูก</th>
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
                        <td>
                            <div class="display-question"><?php echo $item->question;?></div>
                            <div class="form-edit-question" style="display: none;">
                                <textarea class="question-textarea form-control"><?php echo $item->question;?></textarea>
                                <input type="hidden" class="question_id" value="<?php echo $item->question_id;?>">
                            </div>
                        </td>
                        <td>
                            <div class="display-choice">
                                <table class="table table-bordered table-primary">
                                    <!-- Table heading -->
                                    <thead>
                                    <tr>
                                        <th style="border-color: #3695d5; background-color: #3695d5;">ถูก/ผิด</th>
                                        <th style="border-color: #3695d5; background-color: #3695d5;">คำตอบ</th>
                                    </tr>
                                    </thead>
                                    <!-- // Table heading END -->
                                    <!-- Table body -->
                                    <tbody>
                                    <?php foreach($item->choices as $key2=> $item2){?>
                                    <tr class="<?php if($item2->is_answer==1) echo "success";?>">
                                        <td><?php echo $item2->is_answer? "ถูก": "ผิด";?></td>
                                        <td><?php echo $item2->choice;?></td>
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                    <!-- // Table body END -->
                                </table>
                            </div>
                            <div class="form-edit-choice" style="display: none;">
                                <table class="table table-bordered table-primary">
                                    <!-- Table heading -->
                                    <thead>
                                    <tr>
                                        <th style="border-color: #3695d5; background-color: #3695d5;">ข้อที่ถูก</th>
                                        <th style="border-color: #3695d5; background-color: #3695d5;">คำตอบ</th>
                                    </tr>
                                    </thead>
                                    <!-- // Table heading END -->
                                    <!-- Table body -->
                                    <tbody>
                                    <?php foreach($item->choices as $key2=> $item2){?>
                                    <tr>
                                        <td>
                                            <input
                                                type="radio"
                                                name="answer[<?php echo $key;?>]"
                                                value="<?php echo $key2;?>"
                                                class="choice-radio"
                                                <?php echo $item2->is_answer? "checked": "";?>>
                                        </td>
                                        <td>
                                            <textarea class="choice-textarea form-control"><?php echo $item2->choice;?></textarea>
                                            <input type="hidden" class="choice-id-val" value="<?php echo $item2->choice_id;?>">
                                        </td>
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                    <!-- // Table body END -->
                                </table>
                                <button class="submit-edit">แก้ไข</button>
                                <button class="close-edit-btn">ปิด</button>
                            </div>
                        </td>
                        <td>
                            <a href="" class="edit-btn">edit</a>
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

            $('.edit-btn').click(function(e){
                e.preventDefault();

                var $tr = $(this).closest('tr');
                var $display = $tr.find(".display-choice, .display-question");
                var $form = $tr.find(".form-edit-choice, .form-edit-question");

                $display.hide();
                $form.show();

                return false;
            });

            $('.close-edit-btn').click(function(e){
                e.preventDefault();

                var $tr = $(this).closest('tr');
                var $display = $tr.find(".display-choice, .display-question");
                var $form = $tr.find(".form-edit-choice, .form-edit-question");

                $form.hide();
                $display.show();

                return false;
            });

            $('.submit-edit').click(function(e){
                e.preventDefault();

                var $tr = $(this).closest('tr');
                var q = {};
                q.question_id = $tr.find('.question_id').val();
                q.question = $tr.find('.question-textarea').val();
                q.choices = [];

                var ansIndex = $tr.find('.choice-radio:checked').val();

                $tr.find('.choice-textarea').each(function(index, el){
                    var $tr2 = $(el).closest('tr');
                    var c = {
                        choice_id: $tr2.find('.choice-id-val').val(),
                        choice: $(el).val(),
                        is_answer: ansIndex==index? 1: 0
                    };
                    q.choices.push(c);
                });

                $tr.find("textarea,input").prop("disabled", true);
                $.post("<?php echo URL::to("/");?>/exam/editquestion", q, function(data){
                    console.log(data);
                    //$tr.find("textarea,input").prop("disabled", false);
                    window.location.reload();
                }, 'json');
                return false;
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
