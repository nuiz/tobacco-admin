@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">Content video</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">
                    Upload new video
                </h4>
            </div>
            <form class="form-horizontal" id="addvideo-form" role="form" method="post" enctype="multipart/form-data">
                <div>
                    <progress id="upload-progress" class="hidden" style="width: 100%" value="0" max="100"></progress>
                </div>
                <input type="hidden" name="content_id" value="<?php echo $content->content_id;?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">ไฟล์ Video(mp4)</label>

                    <div class="col-sm-10">
                        <input type="file" id="video-input" class="form-control" multiple required="" accept="video/mp4">
                        <div id="video-thumb-wrapper"></div>
                        <div id="video-list-wrapper" class="hidden"></div>
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
                        <td class="center"><div class="glyphicons sorting drag-handle"><i></i></div><?php //echo $item->id;?></td>
                        <td><?php echo $item->video_name;?></td>
                        <td><img src="<?php echo $item->video_thumb_url;?>" width="64"></td>
                        <td><a class="prettyP" href="<?php echo $item->video_url;?>?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]" title="<?php echo $content->content_description;?>">แสดงผล</a></td>
                        <td><a class="delete-btn" href="<?php echo URL::to("content/video/delete?id={$item->id}&content_id={$content->content_id}");?>">ลบ</a></td>
                    </tr>
                    <?php }?>
                    </tbody>
                    <!-- // Table body END -->
                </table>
                <!-- // Table END -->
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/css/prettyPhoto.css");?>">
    <script src="<?php echo URL::to("/assets/components/common/gallery/prettyphoto/assets/lib/js/jquery.prettyPhoto.js");?>"></script>

    <script src="<?php echo URL::to("/assets/Sortable/Sortable.min.js");?>"></script>

    <script>
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
                var send = {list_id: id, content_id: <?php echo $_GET['content_id'];?>};
                $.post("<?php echo URL::to("/content/video/sort");?>", send, function(data){

                    // bla bla bla

                }, "json");
            }
        });
    </script>

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

            var blobVideos = [];
            var blobThumbs = [];

            $input.change(function(e){
                var files = $input.get(0).files;
                $videoThumbWrapper.empty();
                $videoListWrapper.empty();
                $(files).each(function(index, file){
                    var $wrapThumb = $('<div class="thumb-list-wrap"></div>');
                    var $wrap = $('<div><strong>video name</strong><br /> <input name="videos_name[]" value="'+file.name+'"></div>');
                    $wrap.append($wrapThumb);
                    $videoThumbWrapper.append($wrap);

                    var fileURL = URL.createObjectURL(file);
                    blobVideos[index] = file;
                    var $video = $('<video></video>');
                    $video.data("seq", index);

//                    $img.data("seq", index);

                    $videoListWrapper.append($video);
//                    $wrapThumb.append($img);


                    // config max thumbnail
                    var iThumb = 0;
                    var max = 8;


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
                            blobThumbs[index] = dataURItoBlob(data);
                        }

                        $img.click(function(){
                            $('img', $wrapThumb).removeClass('selected');
                            $img.addClass('selected');
                            blobThumbs[index] = dataURItoBlob(data);
                        });

                        iThumb++;
                        if(iThumb >= max)
                            return;

                        setThumb(iThumb, this.duration);
                    });
                    $video.attr('src', fileURL);
                });
            });

            // form submit
            $('#addvideo-form').submit(function(e){
                e.preventDefault();
                var fd = new FormData(this);

                $(blobVideos).each(function(index, blob){
                    fd.append("videos["+index+"]", blob, index +".mp4");
                });
                $(blobThumbs).each(function(index, blob){
                    fd.append("videos_thumb["+index+"]", blob, index +".jpeg");
                });

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
                            setTimeout(function(){ /*window.location.replace('<?php //echo URL::to("content");?>');*/ window.location.reload(); }, 1000);
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

            window.document.getElementById
        });
    </script>

    <style>
        .thumb-list-wrap img {
            height: 90px;
            cursor: pointer;
            margin: 5px;
        }

        .thumb-list-wrap img.selected {
            box-shadow: 0 0 0px 3px rgba(255, 126, 0, 0.5);
        }
    </style>
    <style>
        div.pp_details .pp_nav {
            width: 0;
            height: 0;
            overflow: hidden;
        }
    </style>

    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>

@endsection
