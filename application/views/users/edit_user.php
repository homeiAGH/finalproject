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
                    <h3> Edit User </h3>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('Welcome/main_page')?>"><i class="fa fa-dashboard"></i>
                                Home</a></li>
                        <li class=""><a href="<?php echo base_url('User/index');?>"> Users</a></li>
                        <li class="active"><a href="<?php echo base_url('User/edit_user');?>"> Edit User</a></li>
                    </ol>
                </div>
                <div class="col-md-8 col-sm-4 col-xs-12  " style="margin-top: 36px">
                    
                    <?php if($msg=$this->session->flashdata('user_edit_message')):?>
                    <div id="myalert"
                        class="alert pull-right <?=$this->session->flashdata('user_edit_message_alert_type')?> alert-dismissible fade in col-md-5 col-sm-3 col-xs-12 pull-right "
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
                        Edit User
                    </div>
                    <div class="panel-body">
                        <form id="book_insert" class="form-horizontal form-label-left"
                            action="<?php echo base_url('User/update_user');?>" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-12">
                                    <label for="name">Name <span style="color:red">*</span></label>
                                    <input type="hidden" id="rowId" autocomplete="off"
                                    value="<?php echo set_value("rowId",$user->id)?>" name="rowId">
                                    <input type="text" id="name" autocomplete="off"
                                        value="<?php echo set_value("name",$user->name)?>" name="name" class="form-control"
                                        placeholder="">
                                    <?php echo form_error('name','<div class="text-danger">', '</div>');?>

                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label for="lastname">Last Name<span style="color:red">*</span></label>
                                    <input type="text" id="lastname" autocomplete="off"
                                        value="<?php echo set_value("lastname",$user->lastname)?>" name="lastname" class="form-control"
                                        placeholder="">
                                    <?php echo form_error('lastname','<div class="text-danger">', '</div>');?>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-12">
                                    <label for="name">Username <span style="color:red">*</span></label>
                                    <input type="text" id="username" autocomplete="off"
                                        value="<?php echo set_value("username",$user->username)?>" name="username" class="form-control"
                                        placeholder="">
                                    <?php echo form_error('username','<div class="text-danger">', '</div>');?>

                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label for="lastname">Password<span style="color:red">*</span></label>
                                    <input type="text" id="password" autocomplete="off"
                                        value="<?php echo set_value("password",$user->password)?>" name="password" class="form-control"
                                        placeholder="">
                                    <?php echo form_error('password','<div class="text-danger">', '</div>');?>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-12">
                                    <label for="name">Photo</label>
                                    <input type="file" name="photo" value="<?php echo set_value("photo")?>" id="photo"
                                        onchange="loadFile(event)" class="form-control" />
                                    <input type="hidden" id="oldPhoto" autocomplete="off"
                                        value="<?php echo set_value("oldPhoto",$user->photo_name)?>" name="oldPhoto">
                                    <img id="imgprvw" width="150" height="120"
                                        src="http://localhost/ci/uploads/userImage/<?php echo $user->photo_name?>"
                                        draggable="false" style="border: none;" />

                                    <!-- <input type="file" class="form-control" name="photo" id="photo"> -->
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label for="name">Role <span style="color:red">*</span></label>
                                    <?php $x=set_value("role",$user->role);?>
                                    <select class="form-control " id="role" name="role" style="padding-top: 0px;">
                                        <option
                                            <?php if ((!empty($x) && $x == 'admin')||$x=='')  echo 'selected = "selected"','value="admin"'; ?>>
                                            Admin</option>
                                        <option
                                            <?php if (!empty($x) && $x == 'member')  echo 'selected = "selected"'; ?>value="member">
                                            Member</option>
                                    </select>
                                    <?php echo form_error('role','<div class="text-danger">', '</div>');?>
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
</script>
<!-- /. PAGE WRAPPER  -->
<?php $this->load->view('include/footer');?>