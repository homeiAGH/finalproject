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
                    <h3> Edit Ticket </h3>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('Welcome/main_page')?>"><i class="fa fa-dashboard"></i>
                                Home</a></li>
                        <li class=""><a href="<?php echo base_url('Ticket/index');?>"> Tickets</a></li>
                        <li class="active"><a href="<?php echo base_url('Ticket/edit_ticket');?>"> Edit Ticket</a></li>
                    </ol>
                </div>
                <div class="col-md-8 col-sm-4 col-xs-12  " style="margin-top: 36px">

                    <?php if($msg=$this->session->flashdata('ticket_edit_message')):?>
                    <div id="myalert"
                        class="alert pull-right <?=$this->session->flashdata('ticket_edit_message_alert_type')?> alert-dismissible fade in col-md-5 col-sm-3 col-xs-12 pull-right "
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
                        Edit Ticket
                    </div>
                    <div class="panel-body">
                        <form id="book_insert" class="form-horizontal form-label-left"
                            action="<?php echo base_url('Ticket/update_ticket');?>" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-6">
                                    <label for="name">Passenger Info <span style="color:red">*</span></label>
                                </div>
                                <div class="col-sm-6 col-xs-6" style="padding: 0px !important;">
                                    <label for="name">Ticket Info <span style="color:red">*</span></label>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group col-sm-5 ">
                                <div class="" style="margin-bottom: 25px;">
                                    <input type="hidden" id="passenger_id" autocomplete="off"
                                        value="<?php echo set_value("passenger_id",$ticket->passenger_id)?>"
                                        name="passenger_id">
                                    <input type="text" id="name" autocomplete="off"
                                        value="<?php echo set_value("name",$ticket->passenger_name)?>" name="name"
                                        class="form-control" placeholder="Passenger Name">
                                    <?php echo form_error('name','<div class="text-danger">', '</div>');?>
                                </div>
                                <div class="" style="margin-bottom: 25px;">
                                    <input type="text" id="lastname" autocomplete="off"
                                        value="<?php echo set_value("lastname",$ticket->passenger_lastname)?>"
                                        name="lastname" class="form-control" placeholder="Passenger Lastname">
                                    <?php echo form_error('lastname','<div class="text-danger">', '</div>');?>
                                </div>
                                <div class="" style="margin-bottom: 25px;">
                                    <?php $x=set_value("gender",$ticket->p_gender);?>
                                    <select class="form-control " id="gender" name="gender" style="padding-top: 0px;">
                                        <option
                                            <?php if ((!empty($x) && $x == 'Male')||$x=='')  echo 'selected = "selected"','value="Male"'; ?>>
                                            Male</option>
                                        <option
                                            <?php if (!empty($x) && $x == 'Female')  echo 'selected = "selected"'; ?>value="Female">
                                            Female</option>
                                    </select>
                                    <?php echo form_error('gender','<div class="text-danger">', '</div>');?>
                                </div>
                                <div class="" style="margin-bottom: 25px;">
                                    <input type="text" id="passportNumber" autocomplete="off"
                                        value="<?php echo set_value("passportNumber",$ticket->p_passportNumber)?>"
                                        name="passportNumber" class="form-control" placeholder="Passport Number">
                                    <?php echo form_error('passportNumber','<div class="text-danger">', '</div>');?>

                                </div>
                                <div class="" style="margin-bottom: 25px;">
                                    <input type="text" id="phone" autocomplete="off"
                                        value="<?php echo set_value("phone",$ticket->passenger_phone)?>" name="phone"
                                        class="form-control" placeholder="Phone">
                                    <?php echo form_error('phone','<div class="text-danger">', '</div>');?>
                                </div>
                                <div class="" style="margin-bottom: 25px;">
                                    <input type="text" id="address" autocomplete="off"
                                        value="<?php echo set_value("address",$ticket->passenger_address)?>"
                                        name="address" class="form-control" placeholder="Address">
                                    <?php echo form_error('address','<div class="text-danger">', '</div>');?>
                                </div>
                            </div>
                            <div class=" col-sm-1 "
                                style="border-left: 4px solid #0080001c;height: 330px; padding-right: 0px; margin-left: 50px;margin-right: -20px;">
                            </div>
                            <div class="form-group col-sm-6">
                                <div class=" " style="margin-bottom: 25px;">
                                    <input type="hidden" id="ticket_id" autocomplete="off"
                                        value="<?php echo set_value("ticket_id",$ticket->ticket_id)?>" name="ticket_id">
                                    <?php $f=set_value("from_to",$ticket->from_to);?>
                                    <select class="form-control " id="from_to" name="from_to" style="padding-top: 0px;">
                                        
                                        <option <?php if (!empty($f) && $f == 'herat_mashhad')  echo 'selected = "selected"';?>value="herat_mashhad">
                                            Herat-----Mashhad
                                        </option>
                                        <option <?php if (!empty($f) && $f == 'herat_tehran')  echo 'selected = "selected"'; ?>value="herat_tehran">
                                            Herat-----Tehran
                                        </option>
                                        <option <?php if (!empty($f) && $f == 'mashhad_herat')  echo 'selected = "selected"'; ?>value="mashhad_herat">
                                            Mashhad-----Herat
                                        </option> 
                                    </select>
                                    <?php echo form_error('from_to','<div class="text-danger">', '</div>');?>
                                </div>
                                <div class=" " style="margin-bottom: 25px;">
                                    <select class="form-control " id="driver" name="driver" style="padding-top: 0px;">
                                        <option value="">Select Driver</option>
                                        <?php if(!empty($drivers)): foreach($drivers as $driver):  ?>
                                            <option <?php if ($driver->id ==$ticket->driver_id){echo 'selected = "selected"',"value='$driver->id'"; }else{echo"value='$driver->id'";}?>>
                                            <?php echo $driver->name."  ".$driver->lastname;?></option>
                                        </option>
                                        <?php  endforeach; endif; ?>
                                    </select>
                                    <?php echo form_error('driver','<div class="text-danger">', '</div>');?>
                                </div>

                                <div class="" style="margin-bottom: 25px;">
                                    <select class="form-control " id="car" name="car" style="padding-top: 0px;">
                                        <option value="">Select Car</option>
                                        <?php if(!empty($cars)): foreach($cars as $car):  ?>
                                            <option <?php if ($car->id ==$ticket->car_id){echo 'selected = "selected"',"value='$car->id'"; }else{echo"value='$car->id'";}?>>
                                            <?php echo $car->palete."  ".$car->type_name;?></option>
                                        </option>
                                        <?php  endforeach; endif; ?>
                                        
                                    </select>
                                    <?php echo form_error('car','<div class="text-danger">', '</div>');?>
                                </div>
                                <div class=" " style="margin-bottom: 25px;">
                                    <div class="input-group date form_datetime " data-date="2019-09-16T05:25:07Z"
                                        data-date-format="yyyy-mm-dd hh:ii:00" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="travel_date" value="<?php echo set_value("travel_date",$ticket->ticket_travel_date)?>"
                                            readonly placeholder="Travel Date">
                                        <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-th"></span></span>
                                    </div>
                                    <?php echo form_error('travel_date','<div class="text-danger">', '</div>');?>

                                </div>

                            </div>

                            <div class="form-group col-sm-12">
                                <div class="pull-right">
                                    <button type="button " class="btn btn-primary">Save</button>
                                </div>
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