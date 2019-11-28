<?php $this->load->view('include/header');?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <h3> Tickets </h3>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('Welcome/main_page')?>"><i class="fa fa-dashboard"></i>
                                Home</a></li>
                        <li class="active"><a href="<?php echo base_url('Ticket/index');?>"> Tickets</a></li>
                    </ol>

                </div>
                <div class="col-md-8 col-sm-4 col-xs-12  " style="margin-top: 36px">
                    <?php if($msg=$this->session->flashdata('ticket_create_message')):?>
                    <div id="myalert"
                        class="alert pull-right <?=$this->session->flashdata('ticket_create_message_alert_type')?> alert-dismissible fade in col-md-5 col-sm-3 col-xs-12 pull-right "
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <strong><?php echo $msg;?></strong>
                    </div>
                    <?php elseif($msg=$this->session->flashdata('ticket_edit_message')):?>
                    <div id="myalert"
                        class="alert pull-right <?=$this->session->flashdata('ticket_edit_message_alert_type')?> alert-dismissible fade in col-md-5 col-sm-3 col-xs-12 pull-right "
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <strong><?php echo $msg;?></strong>
                    </div>
                    <?php elseif($msg=$this->session->flashdata('ticket_delete_message')):?>
                    <div id="myalert"
                        class="alert pull-right <?=$this->session->flashdata('ticket_delete_message_alert_type')?> alert-dismissible fade in col-md-5 col-sm-3 col-xs-12 pull-right "
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
        <hr />
        
        <div class="row">
            <div class="col-md-12">
                <!--   Kitchen Sink -->
                <div class=" pagination pull-right" style="    display:block ;
                        padding-left: 0;
                        margin: 0px 0;
                        border-radius: 4px;">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                <div class="panel panel-default">

                    <div class="panel-heading">
                        List Tickets(<?=$total;?>)

                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Register Date</th>
                                        <th>Travel Date</th>
                                        <th>From To</th>
                                        <th>Car Info</th>
                                        <th>Passenger Info</th>
                                        <th>Pasport Number</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Driver Info</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    if(!empty($tickets)): foreach($tickets as $ticket):  
                                        $counter = $counter; 
                                    ?>
                                    <tr>
                                        <td><?php echo $counter;?></td>
                                        <td><?php echo $ticket->ticket_rigister_date ?></td>
                                        <td><?php echo $ticket->ticket_travel_date ?></td>
                                        <td><?php echo $ticket->from_to ?></td>
                                        <td><?php echo $ticket->car_palete."  ".$ticket->car_type_name ?></td>
                                        <td><?php echo $ticket->passenger_name ?></br><small><?php echo $ticket->passenger_lastname ?></small>
                                        </td>
                                        <td><?php echo $ticket->p_passportNumber ?></td>
                                        <td><?php echo $ticket->passenger_phone ?></td>
                                        <td><?php echo $ticket->passenger_address?></td>
                                        <td><?php echo $ticket->driver_name ?></br><small><?php echo $ticket->driver_lastname ?></small>
                                        </td>

                                        <td>
                                            <a href="<?php echo base_url()."Ticket/edit_ticket/".$ticket->ticket_id?>"><button
                                                    class="btn btn-xs btn-primary btn_edit" id="" type="button"
                                                    data-toggle="tooltip" onclick="" title="Edit">
                                                    <i class="fa fa-edit text-white">
                                                    </i>
                                                </button>
                                            </a>
                                            <button class="btn btn-xs btn-danger" type="button" data-toggle="tooltip"
                                                onclick='dlt_confirm("<?=$ticket->ticket_id?>")' title="Delete">
                                                <i class="fa fa-trash-o text-white">
                                                </i>
                                            </button>
                                        </td>

                                    </tr>
                                    <?php $counter ++; 
                                endforeach; else: ?>
                                    <tr class="text-center">
                                        <td scope="row" colspan="4">No Record Exist</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End  Kitchen Sink -->
            </div>
        </div>
       
        <!-- /. ROW  -->
        <hr />
        <div class="modal fade bs-example-modal-sm" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Delete Ticket</h4>
                    </div>
                    <div class="modal-body">

                        <form id="admin_delete" action="<?php echo base_url('Ticket/delete_ticket');?>"
                            method="post" class="form-horizontal">
                            <input type="hidden" name="rowId" id="delete_rowId" readonly>
                            <div class="form-group">
                                <p class="">Are you sure to delete?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var xSeconds = 10000; // 10 second

setTimeout(function() {
    $('#myalert').fadeOut('fast');
    $('#myalert').hide();
}, xSeconds);

//ticket delete confirmation
function dlt_confirm(admin_id) {
    //get the ticket id that want to delete
    $('#delete_rowId').val(admin_id);
    //showing modal
    $('#delete-modal').modal('show');

}
</script>
<!-- /. PAGE WRAPPER  -->
<?php $this->load->view('include/footer');?>