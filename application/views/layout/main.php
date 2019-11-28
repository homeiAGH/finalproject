<?php $this->load->view('include/header');?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Kazemi Travel Agency</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-red set-icon">
                        <i class="fa fa-user"></i>
                    </span>
                    <div class="text-box">
                    <a href="<?php echo base_url('User');?>"><p class="main-text"><?php echo $users;?> Users</p></a>
                    <a href="<?php echo base_url('User/new_user');?>"><p class="text-muted">New User</p></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                        <i class="fa fa-ticket"></i>
                    </span>
                    <div class="text-box">
                    <a href="<?php echo base_url('Ticket');?>"><p class="main-text"><?php echo $tickets;?> Tickets</p></a>
                    <a href="<?php echo base_url('Ticket/new_ticket');?>"><p class="text-muted">New Ticket</p></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                        <i class="fa fa-user"></i>
                    </span>
                    <div class="text-box">
                    <a href="<?php echo base_url('Driver');?>"><p class="main-text"><?php echo $drivers;?> Drivers</p></a>
                    <a href="<?php echo base_url('Driver/new_driver');?>"><p class="text-muted">New Driver</p></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                    </span>
                    <div class="text-box">
                    <a href="<?php echo base_url('Car');?>"><p class="main-text"><?php echo $cars;?> Cars</p></a>
                    <a href="<?php echo base_url('Car/new_car');?>"><p class="text-muted">New Car</p></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
       
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
<?php $this->load->view('include/footer');?>