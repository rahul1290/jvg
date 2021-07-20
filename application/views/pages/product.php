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
                                    ADD NEW PRODUCT
                                </div>
                                <div class="card-body">
                                	<p class="text-center text-danger.Try again..."><?php echo $this->session->flashdata('msg'); ?></p>
                                    <form name="f1" method="POST" action=<?php echo base_url('product/create');?>>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="hidden" id="productid" name="productid" />
                                            	<input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Product Name" value="<?php echo set_value('name');?>">
                                            	<?php echo form_error('name'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Code<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="Product Code" value="<?php echo set_value('contact'); ?>">
                                            	<?php echo form_error('code'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Unit<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                            	<select class="form-control" id="unit" name="unit">
                                                    <option value="">Select Unit</option>
                                                    <?php foreach($unit_list as $unit){ ?>
                                                        <option value="<?php echo $unit['unit_id']?>"><?php echo $unit['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            	<?php echo form_error('unit'); ?>
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
                                    PRODUCT LIST
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="dataTables_wrapper dt-bootstrap4 table-striped" id="productTable">
                                            <thead>
                                            	<tr>
                                                    <th>S.No.</th>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Unit</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
                                            	$c = 0;
                                            	foreach($product_list as $product){ ?>
                                                    <tr>
                                                        <td><?php echo ++$c;?></td>
                                                        <td><?php echo $product['name']; ?></td>
                                                        <td><?php echo $product['code']; ?></td>
                                                        <td><?php echo $product['unitname']; ?></td>
                                                        <td>
                                                        	<a href="javascript:void(0);" class="edit" data-pid="<?php echo $product['product_id'];?>"><i class="fas fa-pencil-alt"></i></a>
                                                        	<a href="javascript:void(0);" class="delete" data-pid="<?php echo $product['product_id'];?>"><i class="fas fa-trash-alt"></i></a>
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
        		var productId = $(this).data('pid');
        		$('#cardheading').html('UPDATE PRODUCT');
        		$('#productid').val(productId);
        		$('#create').hide();
        		$('#update').show();
        		$.ajax({
        			url : baseUrl+'product/getdetail/',
        			type : 'POST',
        			dataType : 'JSON',
        			data : {
        				productId : productId
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
        					$('#name').val(response.data[0].name);
        					$('#code').val(response.data[0].code);
        					$('#unit').val(response.data[0].unit_id);
        					$('#ppu').val(response.data[0].ppu);
        				}
        			}
        		});
        	});
        	
        	$(document).on('click','.delete',function(){
        		let c = confirm('Are you sure!');
        		if(c){
        			let productId = $(this).data('pid');
        			var that = this;
        			$.ajax({
            			url : baseUrl+'product/delete/',
            			type : 'POST',
            			dataType : 'JSON',
            			data : {
            				productId : productId
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
        		$('#cardheading').html('ADD NEW PRODUCT');
                $('#productid').val('');
        		$('#create').show();
        		$('#update').hide();
        	});
        	
        
            $('#productTable').DataTable({
                //dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    


