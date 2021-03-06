@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">แก้ไขเนื้อหา(Video)</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <!-- Widget heading -->
            {{--<div class="widget-head">--}}
                {{--<h4 class="heading"><a href="">add video</a></h4>--}}
            {{--</div>--}}
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <form class="form-horizontal" id="addvideo-form" role="form" method="post" enctype="multipart/form-data">
                    <div>
                        <progress id="upload-progress" class="hidden" style="width: 100%" value="0" max="100"></progress>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ชื่อเนื้อหา</label>
                        <div class="col-sm-10">
                            <input type="text" name="content_name" class="form-control" placeholder="ชื่อเนื้อหา" required="" value="<?php echo $content->content_name;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">คำอธิบายเนื้อหา</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="content_description" class="form-control" placeholder="คำอธิบายเนื้อหา" required=""><?php echo $content->content_description;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="category_id" id="category_id">
                        <label class="col-sm-2 control-label">หมวดหมู่</label>
                        <div class="col-sm-10" id="category-wrapper">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">ตกลง</button> <a class="btn btn-warning" href="<?php echo URL::to("");?>/content">กลับไปยังรายการ</a>
                        </div>
                    </div>
                </form>
                <!-- // Table END -->
            </div>
        </div>

        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">
                    เพิ่ม video
                </h4>
            </div>
            <form class="form-horizontal" id="upload-video-form" role="form" method="post" enctype="multipart/form-data">
                <div>
                    <progress id="upload-progress2" class="hidden" style="width: 100%" value="0" max="100"></progress>
                </div>
                <input type="hidden" name="content_id" value="<?php echo $content->content_id;?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">ไฟล์ Video(mp4)</label>

                    <div class="col-sm-10">
                        <input type="file" id="video-input" class="form-control" multiple accept="video/mp4">
                        <p class="help-block">อนุญาติให้เพิ่มได้เฉพาะไฟล์ mp4</p>
                        <div>
                            <table class="table table-bordered table-primary table-videos" style="display: none;">
                                <thead>
                                <tr>
                                    <th class="col-md-2">ชื่อ video</th>
                                    <th class="col-md-8">เลือกภาพหน้าปก video</th>
                                    <th class="col-md-1"></th>
                                </tr>
                                </thead>
                                <tbody id="video-thumb-wrapper">

                                </tbody>
                            </table>
                        </div>
                        <div id="video-list-wrapper" class="hidden"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="widget">
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">
                    รายการ video
                </h4>
            </div>
            <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                <!-- Table -->
                <table class="table table-bordered table-primary">
                    <!-- Table heading -->
                    <thead>
                    <tr>
                        <th class="center"></th>
                        <th>name</th>
                        <th>thumb</th>
                        <th>video</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody id="sortable-items">
                    <?php foreach($content->videos as $key=> $item){?>
                    <tr item-id="<?php echo $item->id;?>">
                        <td class="center"><div class="glyphicons move drag-handle"><i></i></div><?php //echo $item->id;?></td>
                        <td><input type="text" class="form-control video-name-input" style="color: gray;" value="<?php echo $item->video_name;?>" /></td>
                        <td><img src="<?php echo $item->video_thumb_url;?>" width="64"></td>
                        <td><a class="prettyP" href="<?php echo $item->video_url;?>?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]" title="<?php echo $content->content_description;?>">แสดงผล</a></td>
                        <td><a class="delete-btn" href="<?php echo URL::to("content/video/delete?id={$item->id}&content_id={$content->content_id}");?>">ลบ</a></td>
                    </tr>
                    <?php }?>
                    </tbody>
                    <!-- // Table body END -->
                </table>
                <!-- // Table END -->
                <div class="text-center">
                    <button class="btn btn-primary" id="apply-video-name-btn">บันทึกการแก้ไขชื่อ video</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .thumb-list-wrap img {
            height: 90px;
            cursor: pointer;
            margin: 5px;
        }

        .thumb-list-wrap img.selected {
            box-shadow: 0 0 0px 3px rgba(255, 126, 0, 0.5);
        }

        .drag-handle {
            cursor: pointer;
        }
        .drag-handle.glyphicons i:before {
            color: #3695d5;
        }
    </style>

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

    <script>
        $(function(){
            function capture(video, scaleFactor) {
                if(scaleFactor == null){
                    scaleFactor = 1;
                }
                var w = video.videoWidth * scaleFactor;
                var h = video.videoHeight * scaleFactor;
                var canvas = document.createElement('canvas');
                canvas.width  = w;
                canvas.height = h;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, w, h);
                return canvas;
            }

            function dataURItoBlob(dataURI) {
                // convert base64/URLEncoded data component to raw binary data held in a string
                var byteString;
                if (dataURI.split(',')[0].indexOf('base64') >= 0)
                    byteString = atob(dataURI.split(',')[1]);
                else
                    byteString = unescape(dataURI.split(',')[1]);

                // separate out the mime component
                var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                // write the bytes of the string to a typed array
                var ia = new Uint8Array(byteString.length);
                for (var i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }

                return new Blob([ia], {type:mimeString});
            }

            var $input = $('#video-input');
            var $videoThumbWrapper = $('#video-thumb-wrapper');
            var $videoListWrapper = $('#video-list-wrapper');

            var URL = window.URL || window.webkitURL;

            var videos = [];

            function addVideo(file){
                var $wrapThumb = $('<div class="thumb-list-wrap"></div>');
                var $wrap = $('<tr>' +
                //'<td class="text-center"><div class="glyphicons move drag-handle"><i></i></div></td>' +
                '<td class=""><input name="videos_name[]" class="form-control video-name"></td>' +
                '<td class="thumbnail-list"></td>' +
                '<td class=""><a class="delete-btn" href="#">ลบ</a></td>' +
                '</tr>');
                $wrap.find('.thumbnail-list').append($wrapThumb);
                $videoThumbWrapper.append($wrap);

                var $inputVideoName = $wrap.find('.video-name');

                var videoObj = {};
                $wrap.data('video', videoObj);

                videoObj.file = file;
                videoObj.name = file.name;
                $inputVideoName.val(videoObj.name);

                var fileURL = URL.createObjectURL(file);
                var $video = $('<video></video>');

                $inputVideoName.keyup(function(e){
                    videoObj.name = $inputVideoName.val();
                });

                $videoListWrapper.append($video);

                // config max thumbnail
                var iThumb = 0;
                var max = 4;

                function setThumb(iThumb, duration){
                    var time = Math.floor((iThumb/max) * duration) + 1;
                    $video.get(0).currentTime = time;
                }

                $video.bind('loadedmetadata', function(e){
                    setThumb(iThumb, this.duration);
                });

                $video.bind('seeked', function(e){
                    var canvas = capture(this, 1);
                    var data = canvas.toDataURL("image/jpeg");
                    var $img = $('<img src="'+data+'" style="height: 90px;">');
                    $img.attr('src', data);
                    $wrapThumb.append($img);

                    if(iThumb==0){
                        $('img', $wrapThumb).removeClass('selected');
                        $img.addClass('selected');
                        videoObj.blobThumb = dataURItoBlob(data);
                    }

                    $img.click(function(){
                        $('img', $wrapThumb).removeClass('selected');
                        $img.addClass('selected');
                        videoObj.blobThumb = dataURItoBlob(data);
                    });

                    iThumb++;
                    if(iThumb >= max)
                        return;

                    setThumb(iThumb, this.duration);
                });
                $video.attr('src', fileURL);

                // delete btn
                var $deleteBtn = $wrap.find('.delete-btn');
                $deleteBtn.click(function(e){
                    e.preventDefault();

                    $wrap.remove();
                    $video.remove();

                    var index = videos.indexOf(videoObj);
                    if (index > -1) {
                        videos.splice(index, 1);
                    }
                });

                videos.push(videoObj);
            }

            $input.change(function(e){
                var files = $input.get(0).files;
                $(files).each(function(index, file){
                    $('.table-videos').show();
                    addVideo(file);
                    $input.val("");
                });
            });

            // form upload submit
            $('#upload-video-form').submit(function(e){
                e.preventDefault();

                if(videos.length==0){
                    return false;
                }

                var fd = new FormData(this);
                $(videos).each(function(index, videoObj){
                    fd.append("videos["+index+"]", videoObj.file, index +".mp4");
                    fd.append("videos_thumb["+index+"]", videoObj.blobThumb, index +".jpeg");
                });

                var inputs = $(":input", this);
                inputs.prop("disabled", true);

                var $progress = $('#upload-progress2');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo URL::to("");?>/content/video?content_id=' + <?php echo $content->content_id;?>,
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
                            //setTimeout(function(){ window.location.replace('<?php echo URL::to("content");?>'); }, 1000);
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
                            //setTimeout(function(){ window.location.replace('<?php echo URL::to("content");?>'); }, 1000);\
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
        });
    </script>
    <script>
        $(function(){
            var tree = <?php echo json_encode($category_tree);?>;
            var cat_id = <?php echo $content->category_id;?>;
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

            var j,k;
            loop1:
            for(i=0;i<tree.data.length;i++){
                if(cat_id == tree.data[i].category_id){
                    $rootSelect.val(cat_id);
                    $rootSelect.change();
                }
                for(j=0;j<tree.data[i].children.length;j++){
                    if(cat_id == tree.data[i].children[j].category_id){
                        $rootSelect.val(tree.data[i].category_id);
                        $rootSelect.change();

                        $subSelect1.val(cat_id);
                        $subSelect1.change();
                        break loop1;
                    }
                    for(k=0;k<tree.data[i].children[j].children.length;k++){
                        if(cat_id == tree.data[i].children[j].children[k].category_id){
                            $rootSelect.val(tree.data[i].category_id);
                            $rootSelect.change();

                            $subSelect1.val(tree.data[i].children[j].category_id);
                            $subSelect1.change();

                            $subSelect2.val(cat_id);
                            $subSelect2.change();
                            break loop1;
                        }
                    }
                }
            }
        });
    </script>

    <link rel="stylesheet" href="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/css/prettyPhoto.css");?>">
    <script src="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/js/jquery.prettyPhoto.js");?>"></script>

    <script src="<?php echo URL::to("/assets/Sortable/Sortable.min.js");?>"></script>

    <script>
        $("a[rel^='prettyPhoto']").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            social_tools: false
        });

        $(function(){
            $('.delete-btn').click(function(e){
                e.preventDefault();
                if(window.confirm("Are you shure?")){

                    var $el = $(this);
                    var href = $el.attr("href");
                    var $tr = $el.closest("tr");

                    $.get(href, function(data){
                        if(typeof data.error == "undefined"){
                            $tr.remove();
                        }
                        else {
                            notyfy({
                                text: 'No success',
                                type: 'error',
                                dismissQueue: true,
                                timeout: 3000
                            });
                        }
                    }, 'json');
                }
                return false;
            });

            var el = document.getElementById('sortable-items');
            var sortable = Sortable.create(el, {
                handle: ".drag-handle",
                animation: 200,
                onUpdate: function (/**Event*/ evt) {
                    console.log(evt);
                    var rows = $('#sortable-items tr');
                    var id = [];
                    rows.each(function(index, el){
                        id.push($(el).attr("item-id"));
                    });
                    var send = {list_id: id, content_id: <?php echo $content->content_id;?>};
                    $.post("<?php echo URL::to("/content/video/sort");?>", send, function(data){

                        // bla bla bla

                    }, "json");
                }
            });

            $('#apply-video-name-btn').click(function(e){
                e.preventDefault();
                var $inputs = $(".video-name-input");

                var items = [];
                $inputs.each(function(index, el){
                    var $el = $(el);
                    var id = $el.closest('tr').attr('item-id');

                    items.push({
                        id: id,
                        name: $el.val()
                    });
                });

                $.post("<?php echo URL::to("/content/video/applyname");?>", {"videos": items}, function(data){
                    if(typeof data.error == "undefined"){
                        notyfy({
                            text: 'บันทึกชื่อ video เรียบร้อย',
                            type: 'success',
                            dismissQueue: true,
                            timeout: 3000
                        });
                    }
                    else {
                        notyfy({
                            text: 'No success',
                            type: 'error',
                            dismissQueue: true,
                            timeout: 3000
                        });
                    }
                }, 'json');

                return false;
            });
        });
    </script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
@endsection
