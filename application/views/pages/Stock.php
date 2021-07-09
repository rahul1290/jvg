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
                        <div class="offset-2 col-lg-8">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-center text-light bg-secondary">
                                    PRODUCT STOCK LIST
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="dataTables_wrapper dt-bootstrap4 table-striped" id="productTable">
                                            <thead>
                                            	<tr class="text-center">
                                                    <th>S.No.</th>
                                                    <th>Product Name</th>
                                                    <th>Available Stock</th>
                                                    <th>Unit</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
                                            	$c = 0;
                                            	foreach($stocks as $stock){ ?>
                                                    <tr class="text-center">
                                                        <td><?php echo ++$c;?></td>
                                                        <td><?php echo $stock['productname']; ?></td>
                                                        <td><?php echo $stock['qty']; ?></td>
                                                        <td><?php echo $stock['unitname']; ?></td>
                                                        <td>
                                                        	<a href="javascript:void(0);" class="edit" data-pid="<?php echo $stock['product_id'];?>">View detail</a>
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
    


