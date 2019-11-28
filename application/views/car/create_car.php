<?php $this->load->view('include/header');?>
<script>
var loadFile = function(event) {
    var output = document.getElementById('imgprvw');
    output.src = URL.createObjectURL(event.target.files[0]);
};
</script>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <h3> Add Car </h3>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('Welcome/main_page')?>"><i class="fa fa-dashboard"></i>
                                Home</a></li>
                        <li class=""><a href="<?php echo base_url('Car/index');?>"> Cars</a></li>
                        <li class="active"><a href="<?php echo base_url('Car/create_car');?>"> Add Car</a></li>
                    </ol>
                </div>
                <div class="col-md-8 col-sm-4 col-xs-12  " style="margin-top: 36px">
                    <?php if($msg=$this->session->flashdata('car_create_message')):?>
                    <div id="myalert"
                        class="alert pull-right <?=$this->session->flashdata('car_create_message_alert_type')?> alert-dismissible fade in col-md-5 col-sm-3 col-xs-12 pull-right "
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <strong><?php echo $msg;?></strong>
                    </div>
                    
                    <?php endif;?>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        New Car
                    </div>
                    <div class="panel-body">
                        <form id="book_insert" class="form-horizontal form-label-left"
                            action="<?php echo base_url('Car/new_car');?>" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-12">
                                    <label for="name">Palete <span style="color:red">*</span></label>
                                    <input type="text" id="name" autocomplete="off"
                                        value="<?php echo set_value("palete")?>" name="palete" class="form-control"
                                        placeholder="">
                                    <?php echo form_error('palete','<div class="text-danger">', '</div>');?>

                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label for="lastname">Car Type<span style="color:red">*</span></label>
                                    <select class="form-control " id="car_type" name="car_type" style="padding-top: 0px;">
                                        <option value="" >Select Car Type</option>
                                        <?php if(!empty($types)): foreach($types as $type):  ?>
                                            <option <?php echo "value='$type->id'";?>><?php echo $type->type_name?></option>
                                        <?php  endforeach; endif; ?>
                               
                                    </select>
                                    <?php echo form_error('car_type','<div class="text-danger">', '</div>');?>

                                </div>
                            </div>
                            
                            <div class="pull-right">
                                <button type="button " class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />

    </div>
</div>
<script>
var xSeconds = 10000; // 10 second

setTimeout(function() {
    $('#myalert').fadeOut('fast');
    $('#myalert').hide();
}, xSeconds);

//user delete confirmation
function dlt_confirm(admin_id) {
    //get the user id that want to delete
    $('#delete_rowId').val(admin_id);
    //showing modal
    $('#delete-modal').modal('show');

}
</script>
<!-- /. PAGE WRAPPER  -->
<?php $this->load->view('include/footer');?>