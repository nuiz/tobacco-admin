@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">แก้ไขข่าว</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            {{--<div class="widget-head">--}}
            {{--<h4 class="heading"><a href="">add video</a></h4>--}}
            {{--</div>--}}
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <form enctype="multipart/form-data" class="form-horizontal" id="addnews-form" role="form" method="post">
                    <div>
                        <progress id="upload-progress" class="hidden" style="width: 100%" value="0" max="100"></progress>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ชื่อข่าว</label>
                        <div class="col-sm-10">
                            <input type="text" id="news_name" name="news_name" class="form-control" placeholder="ชื่อข่าว" required="" value="<?php echo $news->news_name;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">คำอธิบายข่าว</label>
                        <div class="col-sm-10">
                            <textarea type="text" id="news_description" name="news_description" class="form-control" placeholder="คำอธิบายข่าว" required=""><?php echo $news->news_description;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">หน้าปกข่าว</label>
                        <div class="col-sm-10">
                            <input type="file" name="news_cover" class="margin-none" id="news_cover-input" accept="image/jpeg, image/png" /> <a id="clear-news_cover-input" href="">ลบ</a>
                            <div>
                                <img class="old-thumb" src="<?php echo $news->news_cover_url;?>" width="120" width="90" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="hidden" id="image-buffer-wrapper"></div>
                            <button type="submit" class="btn btn-primary">ตกลง</button> <a class="btn btn-info" href="">กลับหน้าข่าว</a> <a id="display-example-btn" class="btn btn-warning" href="">แสดงตัวอย่าง</a>
                        </div>
                    </div>
                </form>
                <!-- // Table END -->
            </div>
        </div>


        <h3 class="">ภาพข่าวเพิ่มเติม</h3>
        <div class="widget">
            <div class="widget-body innerAll inner-2x">
                <form enctype="multipart/form-data" class="form-horizontal" id="add-images-form" role="form" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">รูปเดิม</label>
                        <div class="col-sm-10">
                            <div id="old-image-wrap"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">เพิ่ม</label>

                        <div class="col-sm-10">
                            <input type="file" class="margin-none" id="news_images-input" multiple accept="image/jpeg, image/png" />
                            <div class="help-block">อนุญาติเฉพาะนามสกุล jpeg,jpg,png</div>
                            <div id="images-wrap"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="hidden" id="image-buffer-wrapper"></div>
                            <button type="submit" class="btn btn-primary">ตกลง</button>
                        </div>
                    </div>
                </form>
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

    <style>
        .img-thumb {
            display: inline-block;
            position: relative;
            border: 1px solid rgb(187, 186, 255);
            margin: 0 5px 5px 0;
        }

        .img-thumb .img-thumb-img {
            width: 75px;
            height: 75px;
            object-fit: cover;
        }

        .img-thumb .delete-btn {
            cursor: pointer;
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
        }

        .img-thumb .glyphicons i:before {
            font-size: 20px;
            color: rgb(255, 91, 91);
        }

        #news_cover-input {
            display: inline-block;
        }

        #clear-news_cover-input {
            display: none;
        }
    </style>

    <script>
        $(function(){
            var oldNews = <?php echo json_encode($news);?>;
            var URL = window.URL || window.webkitURL;

            function truncText (text, maxLength, ellipseText){
                ellipseText = ellipseText || '...';

                if (text.length < maxLength)
                    return text;

                //Find the last piece of string that contain a series of not A-Za-z0-9_ followed by A-Za-z0-9_ starting from maxLength
                var m = text.substr(0, maxLength).match(/([^A-Za-z0-9_]*)[A-Za-z0-9_]*$/);
                if(!m) return ellipseText;

                //Position of last output character
                var lastCharPosition = maxLength-m[0].length;

                //If it is a space or "[" or "(" or "{" then stop one before.
                if(/[\s\(\[\{]/.test(text[lastCharPosition])) lastCharPosition--;

                //Make sure we do not just return a letter..
                return (lastCharPosition ? text.substr(0, lastCharPosition+1) : '') + ellipseText;
            }

            var $newsCoverInput = $('#news_cover-input');
            var $imageBufferWrapper = $('#image-buffer-wrapper');
            var $exampleNewsBlock = $('#example-news-block');
            var $exampleNewsCover = $('#example-news-cover');

            var $clearCoverBtn = $('#clear-news_cover-input');

            $exampleNewsBlock.click(function(e){
                e.preventDefault();
                if($(e.target).hasClass('lightbox-wrap')){
                    $exampleNewsBlock.hide();
                }
            });

            $newsCoverInput.change(function(e){
                if(this.files.length == 0){
                    $exampleNewsCover.css('background-image', 'url("'+oldNews.news_cover_url+'")');
                    $clearCoverBtn.hide();
                    return;
                }

                var file = this.files[0];
                var fileURL = URL.createObjectURL(file);

                $exampleNewsCover.css('background-image', 'url("'+fileURL+'")');
                $clearCoverBtn.show();
                $imageBufferWrapper.empty();
            });

            $clearCoverBtn.click(function(e){
                e.preventDefault();
                $newsCoverInput.val('');
                $newsCoverInput.change();
                return false;
            });

            var news_images = [];
            (function(news_images){
                var $imagesInput = $('#news_images-input');
                var $imagesWrap = $('#images-wrap');

                var $oldImageWrap = $('#old-image-wrap');

                var template = '<div class="img-thumb">'+
                        '<div class="glyphicons circle_remove delete-btn"><i></i></div>'+
                        '<img class="img-thumb-img" src="">'+
                        '</div>';

                $.each(oldNews.news_images, function(index, value){
                    var $el = $(template);
                    $('.img-thumb-img', $el).attr('src', value.image_url);

                    var $deleteBtn = $('.delete-btn', $el);
                    $deleteBtn.click(function(e){
                        e.preventDefault();
                        $el.remove();
                    });

                    $oldImageWrap.append($el);
                });

                $imagesInput.change(function(e){
                    if(this.files.length == 0)
                        return;

                    $.each(this.files, function(index, file){
                        var $el = $(template);
                        var fileURL = URL.createObjectURL(file);
                        $('.img-thumb-img', $el).attr('src', fileURL);
                        $imagesWrap.append($el);

                        var img = {
                            file: file
                        };

                        var $deleteBtn = $('.delete-btn', $el);
                        $deleteBtn.click(function(e){
                            e.preventDefault();

                            $el.remove();

                            var index = news_images.indexOf(img);
                            if (index > -1) {
                                news_images.splice(index, 1);
                            }
                        });

                        news_images.push(img);
                    });

                    $imagesInput.val('');
                });
            })(news_images);

            $('#display-example-btn').click(function(e){
                e.preventDefault();
                $exampleNewsBlock.show();

                $('#example-news-name').text($('#news_name').val());
                var dText = $('#news_description').val();
                dText = truncText(dText, 420);
                $('#example-news-description').text(dText);

                return false;
            });

            // form submit
            $('#addnews-form').submit(function(e){
                e.preventDefault();
                var fd = new FormData(this);

//                $.each(news_images, function(index, img){
//                    fd.append("news_images["+index+"]", img.file, img.file.name)
//                });

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
                            //setTimeout(function(){ window.location.replace('<?php echo URL::to("news");?>'); }, 1000);
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
                    processData: false,
                    newsType: false
                });

                return false;
            });
        });
    </script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
@endsection

@section('inject-bottom')
    <style>
        .lightbox-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.48);
            z-index: 10000;
            /*display: none;*/
        }
        .example-news {
            width: 400px;
            height: 500px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -240px;
            margin-top: -250px;
            border-radius: 40px;
            overflow: hidden;
        }

        .example-cover {
            height: 300px;
            background-size: cover;
        }

        .example-body {
            position: absolute;
            height: 270px;
            width: 100%;
            border-radius: 22px;
            overflow: hidden;
            bottom: 0;
            left: 0;
            padding: 20px;

            background: rgba(255,255,255,0.65);
            background: -moz-linear-gradient(top, rgba(255,255,255,0.65) 0%, rgba(255,255,255,1) 25%, rgba(255,255,255,1) 100%);
            background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,0.65)), color-stop(25%, rgba(255,255,255,1)), color-stop(100%, rgba(255,255,255,1)));
            background: -webkit-linear-gradient(top, rgba(255,255,255,0.65) 0%, rgba(255,255,255,1) 25%, rgba(255,255,255,1) 100%);
            background: -o-linear-gradient(top, rgba(255,255,255,0.65) 0%, rgba(255,255,255,1) 25%, rgba(255,255,255,1) 100%);
            background: -ms-linear-gradient(top, rgba(255,255,255,0.65) 0%, rgba(255,255,255,1) 25%, rgba(255,255,255,1) 100%);
            background: linear-gradient(to bottom, rgba(255,255,255,0.65) 0%, rgba(255,255,255,1) 25%, rgba(255,255,255,1) 100%);
        }

    </style>
    <div id="example-news-block" class="lightbox-wrap" style="display: none;">
        <div class="example-news">
            <div id="example-news-cover" class="example-cover" style="background-image: url('<?php echo $news->news_cover_url;?>');"></div>
            <div class="example-body center">
                <h2 id="example-news-name">Test</h2>
                <p id="example-news-description">test test test</p>
            </div>
        </div>
    </div>
@endsection