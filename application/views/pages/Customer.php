<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php print_r($navbar); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php print_r($topbar); ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->



                    <div class="row">
                        <div class="col-lg-5">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div id="cardheading" class="card-header text-center text-light bg-secondary">
                                    ADD NEW CUSTOMER
                                </div>
                                <div class="card-body">
                                	<p class="text-center text-danger.Try again..."><?php echo $this->session->flashdata('msg'); ?></p>
                                    <form name="f1" method="POST" action=<?php echo base_url('customer/create');?>>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="hidden" id="customerid" name="customerid" />
                                            	<input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Customer Name" value="<?php echo set_value('name');?>">
                                            	<?php echo form_error('name'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">GST No.<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="gst_no" name="gst_no" placeholder="GST no." value="<?php echo set_value('gst_no');?>" maxlength="15">
                                            	<?php echo form_error('gst_no'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Contact<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="contact_no" name="contact_no" placeholder="Contact no." value="<?php echo set_value('contact_no');?>">
                                            	<?php echo form_error('contact_no'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Alternet No.</label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="alternet_no" name="alternet_no" placeholder="Alternet no." value="<?php echo set_value('alternet_no'); ?>">
                                            	<?php echo form_error('alternet_no'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email-Id</label>
                                            <div class="col-sm-9">
                                            	<input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="email" value="<?php echo set_value('email'); ?>">
                                            	<?php echo form_error('email'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<textarea id="address" name="address" class="form-control" rows="5"><?php echo set_value('address');?></textarea>
                                            	<?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-3 col-sm-9">
                                            	<input type="submit" id="create" class="btn btn-success" value="Add Customer"/>
                                            	<input type="submit" id="update" style="display: none;" class="btn btn-warning" value="Update"/>
                                            	<input type="reset" id="reset" class="btn btn-secondary" value="Cancel"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-center text-light bg-secondary">
                                    CUSTOMER LIST
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="dataTables_wrapper dt-bootstrap4" id="vendorTable">
                                            <thead>
                                            	<tr>
                                                    <th>S.No.</th>
                                                    <th>Name</th>
                                                    <th>GST No.</th>
                                                    <th>Contact No.</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
                                            	$c = 0;
                                            	foreach($customer_list as $customer){ ?>
                                                    <tr>
                                                        <td><?php echo ++$c;?></td>
                                                        <td><?php echo $customer['customer_name']; ?></td>
                                                        <td><?php echo $customer['gst_no']; ?></td>
                                                        <td><?php echo $customer['contact_no'].','.$customer['alternet_no']; ?></td>
                                                        <td>
                                                        	<a href="javascript:void(0);" class="edit" data-cid="<?php echo $customer['id'];?>"><i class="fas fa-pencil-alt"></i></a>
                                                        	<a href="javascript:void(0);" class="delete" data-cid="<?php echo $customer['id'];?>"><i class="fas fa-trash-alt"></i></a>
														</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php print_r($copyright); ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <script>
        $(document).ready( function () {
        	var baseUrl = $('#baseurl').val();
        	
        	$(document).on('click','.edit',function(){
        		var customerId = $(this).data('cid');
        		$('#cardheading').html('UPDATE CUSTOMER');
        		$('#customerid').val(customerId);
        		$('#create').hide();
        		$('#update').show();
        		$.ajax({
        			url : baseUrl+'customer/getdetail/',
        			type : 'POST',
        			dataType : 'JSON',
        			data : {
        				customerId : customerId
        			},
//         			beforeSend : function(){
//         				$('#loadermodal').modal({
//         					show : true,
//         					backdrop : 'static',
//         					keyboard : false 
//         				});
//         			},
        			success : function(response){
        				console.log(response);
        				if(response.status == 200){
        					$('#name').val(response.data[0].customer_name);
        					$('#gst_no').val(response.data[0].gst_no);
        					$('#contact_no').val(response.data[0].contact_no);
        					$('#alternet_no').val(response.data[0].alternet_no);
        					$('#email').val(response.data[0].email);
        					$('#address').val(response.data[0].address);
        				}
        			}
        		});
        	});
        	
        	$(document).on('click','.delete',function(){
        		let c = confirm('Are you sure!');
        		if(c){
        			let customerId = $(this).data('cid');
        			var that = this;
        			$.ajax({
            			url : baseUrl+'customer/delete/',
            			type : 'POST',
            			dataType : 'JSON',
            			data : {
            				customerId : customerId
            			},
    //         			beforeSend : function(){
    //         				$('#loadermodal').modal({
    //         					show : true,
    //         					backdrop : 'static',
    //         					keyboard : false 
    //         				});
    //         			},
            			success : function(response){
            				if(response.status == 200){
            					alert(response.msg);
            					$(that).closest('tr').hide();
            				} else {
            					alert(response.msg);
            				}
            			}
        			});
        		} 
        	});
        	
        	$(document).on('click','#reset',function(){
        		$('#cardheading').html('ADD NEW VENDOR');
                $('#customerid').val('');
        		$('#create').show();
        		$('#update').hide();
        	});
        	
        
            $('#vendorTable').DataTable({
                //dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    


