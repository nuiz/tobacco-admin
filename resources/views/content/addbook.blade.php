@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">เพิ่มเนื้อหา(e-book)</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            {{--<div class="widget-head">--}}
                {{--<h4 class="heading"><a href="">add video</a></h4>--}}
            {{--</div>--}}
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <form class="form-horizontal" id="addebook-form" role="form" method="post" enctype="multipart/form-data">
                    <div>
                        <progress id="upload-progress" class="hidden" style="width: 100%" value="0" max="100"></progress>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ชื่อเนื้อหา</label>
                        <div class="col-sm-10">
                            <input type="text" name="content_name" class="form-control" placeholder="ชื่อเนื้อหา" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">คำอธิบาย</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="content_description" class="form-control" placeholder="คำอธิบายเนื้อหา" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ชื่อผู้แต่ง</label>
                        <div class="col-sm-10">
                            <input type="text" name="book_author" class="form-control" placeholder="ชื่อผู้แต่ง" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">วันที่เผยแพร่</label>
                        <div class="col-sm-10">
                            <input type="text" name="book_date" class="form-control" type="text" placeholder="yyyy-mm-dd" id="datepicker1" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">สำนักพิมพ์</label>
                        <div class="col-sm-10">
                            <input type="text" name="book_publishing_house" class="form-control" placeholder="สำนักพิมพ์" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">สถานที่เก็บหนังสือ</label>
                        <div class="col-sm-10">
                            <select id="book_places" name="book_places[]" class="select2" placeholder="สถานที่เก็บหนังสือ" multiple>
                                <?php foreach($book_place->data as $key=> $value){?>
                                <option value="<?php echo $value->book_place_name;?>"><?php echo $value->book_place_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <script>
                    $(function(){
                        $('.select2').selectize();
                    });
                    </script>

                    <div class="form-group">
                        <input type="hidden" name="category_id" id="category_id">
                        <label class="col-sm-2 control-label">หมวดหมู่</label>
                        <div class="col-sm-10" id="category-wrapper">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">ประเภทหนังสือ</label>
                        <div class="col-sm-10">
                            <select name="book_type_id" class="form-control">
                                <?php foreach($book_types as $key=> $book){?>
                                <option value="<?php echo $book->book_type_id;?>"><?php echo $book->book_type_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ไฟล์ e-book(pdf)</label>

                        <div class="col-sm-10">
                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                <div class="input-group">
                                    <div class="form-control col-md-3">
                                        <i class="fa fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                                <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="book" class="margin-none" id="book-input" required=""
                                                    accept="application/pdf" />
                                                </span><a href="#" class="btn fileupload-exists"
                                                          data-dismiss="fileupload">Remove</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">หน้าปกหนังสือ</label>

                        <div class="col-sm-10">
                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                <div class="input-group">
                                    <div class="form-control col-md-3">
                                        <i class="fa fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                                <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="book_cover" class="margin-none" id="book_cover-input" required="" accept="image/jpeg" />
                                                </span><a href="#" class="btn fileupload-exists"
                                                          data-dismiss="fileupload">Remove</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <!-- // Table END -->
            </div>
        </div>
    </div>


    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-switch/assets/lib/js/bootstrap-switch.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-switch/assets/custom/js/bootstrap-switch.init.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/fuelux-checkbox/fuelux-checkbox.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>

    <script src="<?php echo URL::to("assets/components/common/forms/editors/wysihtml5/assets/lib/js/wysihtml5-0.3.0_rc2.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/editors/wysihtml5/assets/lib/js/bootstrap-wysihtml5-0.0.2.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/editors/wysihtml5/assets/custom/wysihtml5.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/wizards/assets/lib/jquery.bootstrap.wizard.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/wizards/assets/custom/js/form-wizards.init.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/fuelux-radio/fuelux-radio.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/jasny-fileupload/assets/js/bootstrap-fileupload.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/button-states/button-loading/assets/js/button-loading.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/select2/assets/lib/js/select2.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/select2/assets/custom/js/select2.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/multiselect/assets/lib/js/jquery.multi-select.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/multiselect/assets/custom/js/multiselect.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/inputmask/assets/lib/jquery.inputmask.bundle.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/inputmask/assets/custom/inputmask.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/colorpicker-farbtastic/assets/js/farbtastic.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("assets/components/common/forms/elements/colorpicker-farbtastic/assets/js/colorpicker-farbtastic.init.js?v=v1.0.3-rc2");?>"></script>

    <script src="<?php echo URL::to("assets/selectize.js/dist/js/standalone/selectize.min.js");?>"></script>
    <link rel="stylesheet" href="<?php echo URL::to("assets/selectize.js/dist/css/selectize.css");?>">
    <link rel="stylesheet" href="<?php echo URL::to("assets/selectize.js/dist/css/selectize.default.css");?>">

    <script>
        $(function(){
            // form submit
            $('#addebook-form').submit(function(e){
                e.preventDefault();
                var fd = new FormData(this);

                var inputs = $(":input", this);
                inputs.prop("disabled", true);

                var $progress = $('#upload-progress');

                $.ajax({
                    type: 'POST',
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
                            setTimeout(function(){ window.location.replace('<?php echo URL::to("content");?>'); }, 1000);
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
                    processData: false,
                    contentType: false
                });

                return false;
            });
        });
    </script>
    <script>
        $(function(){
            var tree = <?php echo json_encode($category_tree);?>;
            var $inputCategoryId = $('#category_id');
            var $wrapper = $('#category-wrapper');
            var $rootSelect = $('<select class="form-control"></select>');
            var $subSelect1 = $('<select class="form-control" style="display: none;"></select>');
            var $subSelect2 = $('<select class="form-control" style="display: none;"></select>');

            var i = 0;
            for(i=0;i<tree.data.length;i++){
                $rootSelect.append('<option value="'+tree.data[i].category_id+'">'+tree.data[i].category_name+'</option>');
            }

            $rootSelect.change(function(e){
                $subSelect2.hide();
                $subSelect1.hide();
                var val = $(this).val();
                var i;
                var cat1;
                for(i=0;i<tree.data.length;i++){
                    if(tree.data[i].category_id == val){
                        cat1 = tree.data[i];
                    }
                }

                // set children object to data
                $subSelect1.data('children', cat1.children);

                $subSelect1.empty();
                if(cat1.children.length != 0){
                    $subSelect1.show();
                    $subSelect1.append('<option value="0">-- หมวดหมู่ย่อย --</option>');
                    for(i = 0;i<cat1.children.length;i++){
                        $subSelect1.append('<option value="'+cat1.children[i].category_id+'">'+cat1.children[i].category_name+'</option>');
                    }
                }
                else {
                    $subSelect1.data('children', cat1.children);
                }

                $inputCategoryId.val(val);
            });

            $subSelect1.change(function(e){
                $subSelect2.hide();
                var val = $(this).val();
                if(val == 0){
                    $inputCategoryId.val($rootSelect.val());
                    return;
                }

                $inputCategoryId.val(val);

                var i;
                var subs = $subSelect1.data('children');
                var cats;
                for(i=0;i<subs.length;i++){
                    if(subs[i].category_id == val){
                        cats = subs[i];
                    }
                }

                $subSelect2.empty();
                if(cats.children.length != 0){
                    $subSelect2.show();
                    $subSelect2.append('<option value="0">-- หมวดหมู่ย่อย --</option>');
                    for(i = 0;i<cats.children.length;i++){
                        $subSelect2.append('<option value="'+cats.children[i].category_id+'">'+cats.children[i].category_name+'</option>');
                    }

                }


            });

            $subSelect2.change(function(e){
                var val = $(this).val();
                if(val == 0){
                    $inputCategoryId.val($subSelect1.val());
                    return;
                }

                $inputCategoryId.val(val);
            });

            $wrapper.append($rootSelect);
            $wrapper.append($subSelect1);
            $wrapper.append($subSelect2);

            $rootSelect.change();
        });
    </script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
@endsection
