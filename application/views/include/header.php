<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>travel agency management system</title>
    <!-- <link href="http://localhost:8080/ci/assets/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="http://localhost/ci/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!-- BOOTSTRAP STYLES-->
    <link href="http://localhost/ci/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="http://localhost/ci/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="http://localhost/ci/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />

    <!-- CUSTOM STYLES-->
    <link href="http://localhost/ci/assets/css/custom.css" rel="stylesheet" />
    <script src="http://localhost/ci/assets/js/jquery-1.10.2.js"></script>

    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Travel</a>
            </div>
            <div style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;">
            <a href="<?php echo base_url('Login/logout')?>" class="btn btn-danger square-btn-adjust">Logout</a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li class="text-center">
                        <div class="profile clearfix" style="">
                            <div class="profile_pic" style="margin-top: 14px;">
                                <img height="100px" width="100px"
                               
                                    src='http://localhost/ci/uploads/userImage/<?php  echo  $this->session->userdata('photo')?>'
                                    class="img-circle profile_img" />

                                <!-- <img src="<?= base_url(); ?>assets/template/assets/imageUser/younes.jpg" alt="..."
                                class="img-circle profile_img"> -->

                            </div>
                            <div class="profile_info" style="">
                                <h2 style="  color: #d9edf7;    font-size: 17px;">
                                    <?php  echo  $this->session->userdata('name')."  ".$this->session->userdata('lastname')?>
                                </h2>
                                <a><i class="fa fa-circle text-success"></i>
                                    <?php  
                                   if($this->session->userdata('level') ==='member'){
                                       echo 'Member';
                                   }else{
                                    echo 'Admin';
                                   }
                                    
                                ?>
                                </a>
                            </div>
                        </div>
                        <!-- <img src='<?= base_url(); ?>uploads/userImage/<?php  echo  $this->session->userdata('photo')?>' class="user-image img-responsive" /> -->
                    </li>


                    <li>
                        <a href="<?php echo base_url('Welcome/main_page')?>"><i class="fa fa-dashboard fa-3x"></i>
                            Home</a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('User/index')?>"><i class="fa fa-user fa-3x"></i> Users </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('User/create_user')?>">Create User</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('User/index')?>">List Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Car/index')?>"><i class="fa fa-rocket fa-3x"></i> Cars </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('Car/create_car')?>">Add Car</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Car/index')?>">List Cars</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Driver/index')?>"><i class="fa fa-user fa-3x"></i> Drivers </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('Driver/create_driver')?>">Add Driver</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Driver/index')?>">List Drivers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Ticket/index')?>"><i class="fa fa-ticket fa-3x"></i> Tickets </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('Ticket/create_ticket')?>">Add Ticket</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Ticket/index')?>">List Tickets</a>
                            </li>
                        </ul>
                    </li>


                    
                </ul>

            </div>

        </nav>