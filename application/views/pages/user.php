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
                                    ADD NEW USER
                                </div>
                                <div class="card-body">
                                	<p class="text-center text-danger.Try again..."><?php echo $this->session->flashdata('msg'); ?></p>
                                    <form name="f1" method="POST" action=<?php echo base_url('user/create');?>>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">FName<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="hidden" id="userid" name="userid" />
                                            	<input type="text" class="form-control form-control-sm" id="fname" name="fname" placeholder="first Name" value="<?php echo set_value('fname');?>">
                                            	<?php echo form_error('fname'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">LName<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="lname" name="lname" placeholder="last Name" value="<?php echo set_value('lname');?>">
                                            	<?php echo form_error('lname'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">UName<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="uname" name="uname" placeholder="User Name" value="<?php echo set_value('uname');?>">
                                            	<?php echo form_error('uname'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Contact<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="contact" name="contact" placeholder="Vendor Contact" value="<?php echo set_value('contact'); ?>">
                                            	<?php echo form_error('contact'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">User Type<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<select class="form-control" name="user_type" id="user_type">
                                            		<option value="">Select user type</option>
                                            		<?php foreach($user_types as $usert){ ?>
                                                		<option value="<?php echo $usert['user_type_id']; ?>"><?php echo $usert['type']; ?></option>
                                                	<?php } ?>
                                            	</select>
                                            	<?php echo form_error('user_type'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Password<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="password" name="password" placeholder="Password" value="<?php echo set_value('password');?>">
                                            	<?php echo form_error('password'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-3 col-sm-9">
                                            	<input type="submit" id="create" class="btn btn-success" value="Create"/>
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
                                    USER LIST
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="dataTables_wrapper dt-bootstrap4" id="vendorTable">
                                            <thead>
                                            	<tr>
                                                    <th>S.No.</th>
                                                    <th>Name</th>
                                                    <th>Uname</th>
                                                    <th>Contact No.</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
                                            	$c = 0;
                                            	foreach($user_list as $user){ ?>
                                                    <tr>
                                                        <td><?php echo ++$c;?></td>
                                                        <td><?php echo $user['fname'].' '.$user['lname']; ?></td>
                                                        <td><?php echo $user['uname']; ?></td>
                                                        <td><?php echo $user['contact_no']; ?></td>
                                                        <td>
                                                        	<a href="javascript:void(0);" class="edit" data-uid="<?php echo $user['user_id'];?>"><i class="fas fa-pencil-alt"></i></a>
                                                        	<a href="javascript:void(0);" class="delete" data-uid="<?php echo $user['user_id'];?>"><i class="fas fa-trash-alt"></i></a>
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
        		var userId = $(this).data('uid');
        		$('#cardheading').html('UPDATE USER');
        		$('#userid').val(userId);
        		$('#create').hide();
        		$('#update').show();
        		$.ajax({
        			url : baseUrl+'user/getdetail/',
        			type : 'POST',
        			dataType : 'JSON',
        			data : {
        				userId : userId
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
        					$('#fname').val(response.data[0].fname);
        					$('#lname').val(response.data[0].lname);
        					$('#uname').val(response.data[0].uname);
        					$('#contact').val(response.data[0].contact_no);
        					$('#user_type').val(response.data[0].user_type_id);
        					$('#password').val(response.data[0].password);
        				}
        			}
        		});
        	});
        	
        	$(document).on('click','.delete',function(){
        		let c = confirm('Are you sure!');
        		if(c){
        			let userId = $(this).data('uid');
        			var that = this;
        			$.ajax({
            			url : baseUrl+'user/delete/',
            			type : 'POST',
            			dataType : 'JSON',
            			data : {
            				userId : userId
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
                $('#userid').val();
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
    


