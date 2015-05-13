@extends('tp')

@section('content')
    <div class="innerLR spacing-x2">
        <h3 class="">เพิ่ม Writer</h3>

        <!-- Widget ---- -->

        <div class="widget">
            <div class="widget-body innerAll inner-2x">
                <form class="form-horizontal" id="addvideo-form" role="form" method="post" enctype="multipart/form-data">
                    <div>
                        <progress id="upload-progress" class="hidden" style="width: 100%" value="0" max="100"></progress>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">บัญชีผู้ใช้</label>
                        <div class="col-sm-10">
                            <select id="account_id" name="account_id" class="select2" required="" placeholder="Find account..."></select>
                        </div>
                        <script>
                            $(function(){
                                var users = <?php echo json_encode($users);?>;
                                $('.select2').selectize({
                                    valueField: 'account_id',
                                    searchField: ['username', 'firstname', 'lastname'],
                                    options: users,
                                    create: false,
                                    render: {
                                        item: function(item, escape){
                                            return '<div>'+escape(item.firstname) +' '+ item.lastname+ '<div>';
                                        },
                                        option: function(item, escape) {
                                            return '<div>' +
                                                    '<span class="title">' +
                                                    '<span class="name">['+ escape(item.username) +'] '+ escape(item.firstname) +' '+ item.lastname +'</span>' +
                                                    '</span>' +
                                                    '</div>';
                                        }
                                    }
                                });
                            });
                        </script>
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
    <link rel="stylesheet" href="<?php echo URL::to("assets/selectize.js/dist/css/selectize.bootstrap3.css");?>">

    <script>
        $(function(){

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
                            setTimeout(function(){ window.location.replace('<?php echo URL::to("userwriter");?>'); }, 1000);
                        }
                        else {
                            var message;
                            if(data.error.code == 1){
                                message = "username ซ้ำ";
                            }
                            else {
                                message = "No success";
                            }
                            notyfy({
                                text: message,
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
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo URL::to("");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
@endsection
