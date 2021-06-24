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
                        <div class="col-lg-12">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
<!--                                 <div id="cardheading" class="card-header text-center text-light bg-secondary"> -->
<!--                                     ADD NEW VENDOR -->
<!--                                 </div> -->
                                <div class="card-body">
                                	<p class="text-center text-danger.Try again..."><?php echo $this->session->flashdata('msg'); ?></p>
                                    <form name="f1" method="POST" action=<?php echo base_url('vendor/create');?>>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Bill No.<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<input type="hidden" id="vendorid" name="vendorid" />
                                            	<input type="text" class="form-control form-control-sm" readonly id="billno" name="billno" placeholder="Vendor Name" value="<?php echo set_value('name');?>">
                                            	<?php echo form_error('billno'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Bill Date.<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<input type="hidden" id="vendorid" name="vendorid" />
                                            	<input type="text" class="form-control form-control-sm" id="billno" name="billno" placeholder="Vendor Name" value="<?php echo date('d-m-Y');?>">
                                            	<?php echo form_error('billno'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">Seller<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<select id="seller_id" class="form-control">
                                            		<option value="">Select seller</option>
                                            		<?php foreach($vendor_list as $vendor){ ?>
                                            			<option value="<?php echo $vendor['vendor_id']; ?>"><?php echo $vendor['vendor_name']; ?></option>
                                            		<?php } ?>
                                            		<option value="oth">Other</option>
                                            	</select>
                                            	<input class="mt-1" style="display:none;" id="other_vendor" type="text" placeholder="Enter vendor name"/>
                                            	<?php echo form_error('seller_id'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">Contact No.<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<input type="text" class="form-control form-control-sm" id="contact_no" name="contact_no" placeholder="Contact No." value="<?php echo set_value('contact_no'); ?>">
                                            	<?php echo form_error('contact_no'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">Alternet No.<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<input type="text" class="form-control form-control-sm" id="alternet_contact" name="alternet_contact" placeholder="Alternet No." value="<?php echo set_value('alternet_contact'); ?>">
                                            	<?php echo form_error('alternet_contact'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">GST No.<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<input type="text" class="form-control form-control-sm" id="gst_no" name="gst_no" placeholder="GST No." value="<?php echo set_value('gst_no');?>">
                                            	<?php echo form_error('gst_no'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<textarea class="form-control form-control-sm" rows="5" id="address" name="address"><?php echo set_value('address'); ?></textarea>
                                            	<?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Items</label>
                                            <div class="col-sm-10">
                                            	<div id="bill_items"></div>
                                            	<select id="item" name="item">
                                            		<option value="">Select item</option>
                                            		<?php foreach($products as $product){?>
                                            			<option value="<?php echo $product['product_id'];?>"><?php echo $product['name']; ?>[<?php echo $product['code']; ?>]</option>
                                            		<?php }?>
                                            	</select>
                                            	<select id="unit" name="unit">
                                            		<option value="">Select unit</option>
                                            		<?php foreach($units as $unit){?>
                                            			<option value="<?php echo $unit['unit_id']?>"><?php echo $unit['name']; ?></option>
                                            		<?php } ?>
                                            	</select>
                                            	<label>ppu</label>
                                            	<input tye="text" id="ppu" placeholder="Prie per unit"/>
                                            	<label>Qty</label>
                                            	<input tye="text" id="quantity" placeholder="Quantity"/>	
                                            	<input type="button" value="Add" id="add_item" class="btn btn-success">
                                            	<?php echo form_error('address'); ?>
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
        	var items = [];
        	
        	$(document).on('click','.edit',function(){
        		var vendorId = $(this).data('vid');
        		$('#cardheading').html('UPDATE VENDOR');
        		$('#vendorid').val(vendorId);
        		$('#create').hide();
        		$('#update').show();
        		$.ajax({
        			url : baseUrl+'vendor/getdetail/',
        			type : 'POST',
        			dataType : 'JSON',
        			data : {
        				vendorId : vendorId
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
        					$('#name').val(response.data[0].vendor_name);
        					$('#contact').val(response.data[0].contact_no);
        					$('#alternet_contact').val(response.data[0].Alternate_contact_no);
        					$('#gst_no').val(response.data[0].gst_no);
        					$('#address').val(response.data[0].address);
        				}
        				
        				
        			}
        		});
        	});
        	
        	$(document).on('click','.delete',function(){
        		let c = confirm('Are you sure!');
        		if(c){
        			let vendorId = $(this).data('vid');
        			var that = this;
        			$.ajax({
            			url : baseUrl+'vendor/delete/',
            			type : 'POST',
            			dataType : 'JSON',
            			data : {
            				vendorId : vendorId
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
        		$('#create').show();
        		$('#update').hide();
        	});
        	

        	$(document).on('click','#add_item',function(){
            	temp = {};
				
            	temp['item'] = $('#item').val();
            	temp['itemText'] = $('#item option:selected').text();
            	temp['unit'] = $('#unit').val();
            	temp['unitText'] = $('#unit option:selected').text();
            	temp['ppu'] = $('#ppu').val();
            	temp['qty'] = $('#quantity').val();
            	items.push(temp);
            	$('#item,#unit,#ppu,#quantity').val('');

            	var x = '<table class=" table-bordered text-center table-sm">'+
                			'<thead><tr>'+
            				'<th>sno.</th>'+
            				'<th>Item</th>'+
            				'<th>Unit</th>'+
            				'<th>PPU</th>'+
            				'<th>Quantity</th>'+
            				'<th>Total</th>'+
            				'<th></th>'+	
            			'</tr></thead><tbody>';
            	$.each(items,function(key,value){
					x = x + '<tr>'+
								'<td>'+ parseInt(key+1) +'</td>'+
								'<td>'+ value.itemText +'</td>'+
								'<td>'+ value.unitText +'</td>'+
								'<td>'+ value.ppu +'</td>'+
								'<td>'+ value.qty +'</td>'+
								'<td>'+ (value.qty * value.ppu) +'</td>'+
								'<td><input type="button" value="del" class="btn btn-danger"/></td>'+
							'</tr>';
                });
                x = x + '</tbody></table>';
            	$('#bill_items').html(x).show();
            });


        	$(document).on('change','#seller_id',function(){
            	var sellerId = $(this).val();
            	if(sellerId == 'oth'){
                	$('#other_vendor').show();	
                } else {
                	$('#other_vendor').val('').hide();
                	$('#contact_no').val('');
                	$('#alternet_contact').val('');	
                	$('#gst_no').val('');	
                	$('#address').val('');
                	
                	if(sellerId != ''){
                    	$.ajax({
                        	url : baseUrl + 'vendor' 
                        });
                    } else {
                        alert('blank');		
                    }
                }
            });
            
            $('#vendorTable').DataTable({
                //dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    


