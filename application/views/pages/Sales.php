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
                                <div id="cardheading" class="card-header text-center text-light bg-secondary">
                                    BILL GENERATION
                                </div>
                                <div class="card-body">
                                	<p class="text-center text-danger.Try again..."><?php echo $this->session->flashdata('msg'); ?></p>
                                    <form name="f1" method="POST" action='#'>
                                    	
                                    	<div class="row">
                                    		<div class="col-12">
                                    			<div class="">
                                        			<div class="form-row">
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-3 col-form-label col-form-label-sm">Bill No.<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="billno" name="billno" placeholder="bill no" value="<?php echo $billno;?>">
                                                  			<div id="billno_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-4 col-form-label col-form-label-sm">Buyer<span class="text-danger">*</span></label>
                                                            <select id="vendor_id" class="form-control">
                                                        		<option value="">Select Buyer</option>
                                                        		<?php foreach($vendor_list as $vendor){ ?>
                                                        			<option value="<?php echo $vendor['vendor_id']; ?>"><?php echo $vendor['vendor_name']; ?></option>
                                                        		<?php } ?>
                                                        		<option value="oth">Other</option>
                                                        	</select>
                                                        	<input class="mt-1 form-control" style="display:none;" id="other_vendor" type="text" placeholder="Enter buyer name"/>
                                                        	<div id="other_vendor_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-6 col-form-label col-form-label-sm">Date of Sales<span class="text-danger">*</span></label>
                                                    		<input type="text" class="form-control" id="billdate" name="billdate" placeholder="Date" value="<?php echo date('d/m/Y');?>">
                                                  			<div id="billdate_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-row">
                                                    	<div class="form-group col-md-3">
                                                        	<label class="col-sm-6 col-form-label col-form-label-sm">Contact No.</label>
                                                            <input type="text" class="form-control form-control-sm" id="contact_no" name="contact_no" placeholder="Contact No." value="<?php echo set_value('contact_no'); ?>">
                                                            <div id="contact_no_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                        	<label class="col-sm-6 col-form-label col-form-label-sm">Alternet No.</label>
                                                            <input type="text" class="form-control form-control-sm" id="alternet_contact" name="alternet_contact" placeholder="Alternet No." value="<?php echo set_value('alternet_contact'); ?>">
                                                        	<div id="alternet_contact_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                        	<label class="col-sm-6 col-form-label col-form-label-sm">GST No.<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm" id="gst_no" name="gst_no" placeholder="GST No." value="<?php echo set_value('gst_no');?>">
                                                        	<div id="gst_no_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                        	<label class="col-sm-6 col-form-label col-form-label-sm">GR/RR No.</label>
                                                            <input type="text" class="form-control form-control-sm" id="grrr_no" name="grrr_no" placeholder="GR/RR No">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-row">
<!--                                                         <div class="form-group col-md-6"> -->
<!--                                                         	<label class="col-sm-4 col-form-label col-form-label-sm">Date</label> -->
<!--                                                             <input type="text" class="form-control form-control-sm" id="grr_date" name="grr_date" placeholder="Alternet No." > -->
<!--                                                         </div> -->
                                                    </div>
                                        			
                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Billing Address<span class="text-danger">*</span></label>
                                                        <div class="col-sm-12">
                                                        	<textarea class="form-control form-control-sm" rows="5" id="address" name="address"><?php echo set_value('address'); ?></textarea>
                                                        	<div id="address_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-row">
                                                    	<div class="from-group col-md-4">
                                                    		<label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Shipping State<span class="text-danger">*</span></label>
                                                    		<select class="form-control" id="shipping_state" name="shipping_state">
                                                        		<option value="">Select State</option>
                                                        		<?php foreach($states as $state){ ?>
                                                        			<option value="<?php echo $state['state_id']; ?>"><?php echo $state['state_name']; ?></option>
                                                        		<?php } ?>
                                                        	</select>
                                                        	<div id="shipping_state_error" class="text-danger" style="display: none;"></div>
                                                    	</div>
                                                    	
                                                    </div>
                                                    
                                                    <div class="from-group col-md-4 mt-4">
                                                		<div class="row">
                                                			<label>Shipping Address same as Billing Address</label> <input class="m-2" type="checkbox" id="shipping_checkbox"/>
                                                		</div>
                                                	</div>
                                                    
                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Shipping Address<span class="text-danger">*</span></label>
                                                        <div class="col-sm-12">
                                                        	<textarea class="form-control form-control-sm" rows="5" id="shipping_address" name="shipping_address"><?php echo set_value('address'); ?></textarea>
                                                        	<div id="address_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                    <?php /*?>
                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Broker</label>
                                                        <div class="col-sm-12">
                                                        	<select id="broker_id" class="form-control">
                                                        		<option value="">Select Broker</option>
                                                        		<?php foreach($broker_list as $broker) { ?>
                                                        			<option value="<?php echo $broker['id'];?>"><?php echo $broker['broker_name'];?></option>
                                                        		<?php } ?>
                                                        	</select>
                                                        	<div id="broker_id_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                    <?php */ ?>
                                                </div>
                                    		</div>
                                    		
                                    	</div>
                                    	
                                    </form>
                                </div>
                            </div>
                            
                            
                            <div class="card">
                              <h5 class="card-header bg-dark text-light text-center">TRANSPORT</h5>
                              <div class="card-body">
                                
                                		<div class="form-row">
                                            <div class="form-group col-md-6">
                                              <label>Transport Name</label>
                                              <input type="text" class="form-control" id="transname" name="transname" aria-describedby="emailHelp" placeholder="Transporter Name">
                                              <div class="text-danger" id="transname_error" style="display: none;"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label for="exampleInputPassword1">Vechile No.</label>
                                              <input type="text" class="form-control" id="vechileno" name="vechileno" placeholder="Vechile no.">
                                              <div class="text-danger" id="vechileno_error" style="display: none;"></div>
                                            </div>
                                          </div>
                                		
                                      <div class="form-group">
                                        
                                        
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Eway Bill No.</label>
                                        <input type="text" class="form-control" id="ewaybillno" name="ewaybillno" placeholder="Eway Bill No.">
                                        <div class="text-danger" id="ewaybillno_error" style="display: none;"></div>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Destination<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="shipping_destination" name="shipping_destination" placeholder="Destination">
                                        <div class="text-danger" id="shipping_destination_error" style="display: none;"></div>
                                      </div>
                              </div>
                            </div>
                            
                            
                            <div class="card">
                              <h5 class="card-header bg-dark text-light text-center">ITEMS</h5>
                              <div class="card-body">
                                	<div class="form-group row">
                                        <div class="col-sm-12 text-dark">
											<div class="row">
												<select id="item" name="item" class="ml-2 mt-2 mr-2">
													<option value="">Select item</option>
													<?php foreach($products as $product){?>
														<option value="<?php echo $product['product_id'];?>"><?php echo $product['name']; ?>[<?php echo $product['code']; ?>]</option>
													<?php }?>
												</select>
                                        		<input type="number" id="quantity" placeholder="Quantity" min="0" class="mt-2 mr-2"/>
												<select id="unit" name="unit" class="mt-2 mr-2">
													<option value="">Select unit</option>
												</select>
												
											</div>
                                        	<div class="mt-2">
												<table class="text-dark">
													<tr>
														<td>Purchase From</td>
														<td>
															<select id="purchase_from" class="form-control">
																<option value="">Select Vendor</option>
															</select>
														</td>
													</tr>
													<tr>
														<td>Rate Per Metric Ton</td>
														<td>
															<input type="number" id="ppu" min="0" class="form-control" placeholder="Prie Per Unit"/>
														</td>
													</tr>
													<tr>
														<td>Total</td>
														<td>
															<input type="text" id="total" readonly placeholder="total" value="0"/>
															<input type="button" value="Add Item" id="add_item" class="btn btn-info">
														</td>
													</tr>
												</table>
												
											</div>
                                        </div>
                                    </div>
                                    
                                    </br>
                                    <div class="form-group row">
                                        <div class="col-sm-12">	
                                        	<hr/>
                                        	<table id="total_cal" style="display: none;">
                                        		<tr>
                                        			
                                        		</tr>
                                        		<tr>
                                        			<td>Insurance:</td>
                                        			<td>
                                        				<input type="text" name="insurance" id="insurance" value="0.00" class="form-control" />
                                        			</td>
                                        		
                                        			<td>Frieght:</td>
                                        			<td>
                                        				<input type="text" name="frieght" id="frieght" value="0.00" class="form-control" />
                                        			</td>
                                        			<td>CGST</td>
                                        			<td>
                                        				<div class="input-group">
                                                          <input type="text" id="cgst_amount" value="0" class="form-control" placeholder="CGST amount percentage" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                          </div>
                                                        </div>
                                        			</td>
                                        		
                                        			<td>SGST</td>
                                        			<td>
                                        				<div class="input-group">
                                                          <input type="text" id="sgst_amount" value="0" class="form-control" placeholder="SGST amount percentage" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                          </div>
                                                        </div>
                                        			</td>
                                        		
                                        			<td>IGST</td>
                                        			<td>
                                        				<div class="input-group">
                                                          <input type="text" id="igst_amount" value="0" class="form-control" placeholder="IGST amount percentage" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                          </div>
                                                        </div>
                                        			</td>
                                        		</tr>
                                        	</table>
                                        	<div class="table-responsive mt-3">
                                        		<div id="bill_items" style="display: none;"></div>
                                        	</div>
                                        </div>
                                    </div>
                              </div>
                            </div>
                            
                            <div class="text-center">
                                <input type="button" id="create" class="btn btn-success" value="Generate Bill"/>
                            	<input type="submit" id="update" style="display: none;" class="btn btn-warning" value="Update"/>
                            	<input type="reset" id="reset" class="btn btn-secondary" value="Cancel"/>
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
        		var formvalid = true;
        		if($('#item').val() == ''){
        			$('#item').addClass('haveerror');
        			formvalid = false;
        		} else {
        			$('#item').removeClass('haveerror');
        		}
        		
        		if($('#purchase_from').val() == ''){
        			$('#purchase_from').addClass('haveerror');
        			formvalid = false;
        		} else {
        			$('#purchase_from').removeClass('haveerror');
        		}
        		
//         		if($('#unit').val() == ''){
//         			$('#unit').addClass('haveerror');
//         			formvalid = false;
//         		} else {
//         			$('#unit').removeClass('haveerror');
//         		}
        		
        		if($('#ppu').val() == ''){
        			$('#ppu').addClass('haveerror');
        			formvalid = false;
        		}else {
        			$('ppu').removeClass('haveerror');
        		}
        		
        		if($('#quantity').val() == ''){
        			$('#quantity').addClass('haveerror');
        			formvalid = false;
        		} else {
        			$('quantity').removeClass('haveerror');
        		}
        		if(formvalid){
					billPreview(1);
            	}
            });

			function billPreview(i){
				temp = {};
				temp['item'] = $('#item').val();
				temp['itemText'] = $('#item option:selected').text();
				temp['unit'] = $('#unit').val();
				temp['unitText'] = $('#unit option:selected').text();
				temp['ppu'] = $('#ppu').val();
				temp['vendor_id'] = $('#purchase_from').val();
				temp['vendor_text'] = $('#purchase_from option:selected').text();
				temp['qty'] = $('#quantity').val();
				temp['total'] = $('#total').val();
				
				if(i) {    
					items.push(temp);
					console.log(items);
    				}
    				console.log(items);
				
				$('#item,#unit,#ppu,#quantity').val('');
				var x = '<table class="table table-bordered table-striped text-center table-sm">'+
							'<thead><tr>'+
							'<th>Sno.</th>'+
							'<th>Vendor Name</th>'+
							'<th>Item</th>'+
							'<th>Quantity</th>'+
							'<th>Unit</th>'+
							'<th>Rate per metric ton</th>'+
							'<th>Total</th>'+
							'<th></th>'+	
						'</tr></thead><tbody>';
				var totalBill = 0;	
				$.each(items,function(key,value){
					totalBill = totalBill + parseFloat(value.total);
					x = x + '<tr>'+
								'<td>'+ parseFloat(key+1) +'</td>'+
								'<td>'+ value.vendor_text  +'</td>'+
								'<td>'+ value.itemText +'</td>'+
								'<td>'+ value.qty +'</td>'+
								'<td>'+ value.unitText +'</td>'+
								'<td>'+ value.ppu +'</td>'+
								'<td>'+ value.total +'</td>'+
								'<td><input type="button" value="del" data-index="'+ key +'" class="btn btn-danger item-del"/></td>'+
							'</tr>';
				});
				var cgstAmount = (((totalBill + parseFloat($('#insurance').val())) * $('#cgst_amount').val())/100).toFixed(2);
				var sgstAmount = (((totalBill + parseFloat($('#insurance').val())) * $('#sgst_amount').val())/100).toFixed(2);
				var igstAmount = (((totalBill + parseFloat($('#insurance').val())) * $('#igst_amount').val())/100).toFixed(2);
				//var discount = (((totalBill + parseFloat($('#insurance').val())) * $('#discount_per').val())/100).toFixed(2);
				
				var payableAmount = ((parseFloat(totalBill) + parseFloat(cgstAmount) + parseFloat(sgstAmount) + parseFloat(igstAmount))).toFixed(2);
				
				x = x + '<tr class="bg-secondary text-light">'+
							'<td colspan="6" class="text-right">Amount</td>'+
							'<td colspan="2" class="text-left">'+ totalBill +'</td>'+
						'</tr>';
						if($('#insurance').val() != '0.00'){
						x = x + '<tr class="bg-secondary text-light">'+
							'<td colspan="6" class="text-right">Insurance</td>'+
							'<td colspan="2" class="text-left">'+ $('#insurance').val() +'</td>'+
						'</tr>';
						}
						if($('#frieght').val() != '0.00'){
						x = x + '<tr class="bg-secondary text-light">'+
							'<td colspan="6" class="text-right">Frieght</td>'+
							'<td colspan="2" class="text-left">'+ $('#frieght').val() +'</td>'+
						'</tr>';
						}
						if(cgstAmount != '0.00'){
						x = x + '<tr class="bg-secondary text-light">'+
							'<td colspan="6" class="text-right">CGST Amount</td>'+
							'<td colspan="2" class="text-left">'+ cgstAmount +'</td>'+
						'</tr>';
						}
						if(sgstAmount != '0.00'){
						'x = x + <tr class="bg-secondary text-light">'+
							'<td colspan="6" class="text-right">SGST Amount</td>'+
							'<td colspan="2" class="text-left">'+ sgstAmount +'</td>'+
						'</tr>';
						}
						if(igstAmount != '0.00'){
						x = x +'<tr class="bg-secondary text-light">'+
							'<td colspan="6" class="text-right">IGST Amount</td>'+
							'<td colspan="2" class="text-left">'+ igstAmount +'</td>'+
						'</tr>';
						}
						
						x = x + '<tr class="bg-secondary text-light">'+
							'<td colspan="6" class="text-right">GrandTotal</td>'+
							'<td colspan="2" class="text-left">'+ payableAmount +'</td>'+
						'</tr>';  
				x = x + '</tbody></table>';
				
				if(items.length){
					$('#bill_items').html(x).show();	
					$('#total_cal').show();
					$('#payment_tab').show();
				} else {
					$('#bill_items').hide();
					$('#total_cal').hide();
					$('#payment_tab').hide();
				}

				$('#total').val(0);
				$('#item_gst').val(0);
				$('#item_discount').val(0);
				$('#item_grand_total').val(0);
				$('#purchase_from').val('');
			}
            
            	
            $(document).on('click','.item-del',function(){
            console.log('508');
            	let index = $(this).data('index');
            	items.splice(index,1);
            	billPreview(0);
            });


        	$(document).on('change','#vendor_id',function(){
        		$('#shipping_checkbox').prop('checked', false);
        		$('#shipping_address').val('');
            	var vendorId = $(this).val();
            	if(vendorId == 'oth'){
                	$('#other_vendor').show();	
                	$('#contact_no').val('');
                	$('#alternet_contact').val('');	
                	$('#gst_no').val('');	
                	$('#address').val('');
                } else {
                	$('#other_vendor').val('').hide();
                	$('#contact_no').val('');
                	$('#alternet_contact').val('');	
                	$('#gst_no').val('');	
                	$('#address').val('');
                	
                	if(vendorId != ''){
                		$.ajax({
                        	type: 'POST',
                            url : baseUrl + 'vendor/getdetail',
                            data : {
                            	vendorId : vendorId
                            },
                            dataType : 'json',
                            success: function(response){
                            	console.log(response.data[0]['contact_no']);
                                if(response.status == 200){
                                    $('#contact_no').val(response.data[0]['contact_no']);
        		                	$('#alternet_contact').val(response.data[0]['Alternate_contact_no']);	
        		                	$('#gst_no').val(response.data[0]['gst_no']);	
        		                	$('#address').val(response.data[0]['address']);
                                }     
                        	}
                        });
                    } else {
                        $('#contact_no').val('');
	                	$('#alternet_contact').val('');	
	                	$('#gst_no').val('');	
	                	$('#address').val('');		
                    }
                }
            });
            
            $(document).on('click','#create',function(){
            	var formvalid = true;
            	if(items.length < 1){
            		alert('Please select atlease one item to sale.');
            	}
            	
            	if($('#billno').val() == ''){
            		$('#billno').addClass('haveerror');
            		$('#billno_error').html('Enter Bill no').show();
            		formvalid = false;
            	} else {
            		$('#billno').removeClass('haveerror');
            		$('#billno_error').html('').hide();
            	}
            	
            	if($('#customer_id').val() == ''){
            		$('#customer_id').addClass('haveerror');
            		$('#customer_id_error').html('please select customer').show();
            		formvalid = false;
            	} else {
            		$('#seller_id').removeClass('haveerror');
            		$('#seller_id_error').html('').show();
            	}
            	
            	if($('#vendor_id').val() == 'oth'){
            		if($('#other_vendor').val() == ''){
            			$('#other_vendor').addClass('haveerror');
            			$('#other_vendor_error').html('Enter vendor name').show();
            			formvalid = false;
            		} else {
            			$('#other_vendor').removeClass('haveerror');
            			$('#other_vendor_error').html('').hide();
            		}	
            	}
            	
            	if($('#shipping_state').val() == ''){
            		formvalid = false;
            		$('#shipping_state').addClass('haveerror');
            	} else {
            		$('#shipping_state').removeClass('haveerror');
            	}
            	
//             	if($('#transname').val() == ''){
//             		formvalid = false;
//             		$('#transname').addClass('haveerror');
//             		$('#transname_error').html('Enter transporter name').show();
//             	} else {
//             		$('#transname').removeClass('haveerror');
//             		$('#transname_error').html('').hide();
//             	}
            	
//             	if($('#vechileno').val() == ''){
//             		formvalid = false;
//             		$('#vechileno').addClass('haveerror');
//             		$('#vechileno_error').html('Enter vechile no').show();
//             	} else {
//             		$('#vechileno').removeClass('haveerror');
//             		$('#vechileno_error').html('').hide();
//             	}
            	
//             	if($('#ewaybillno').val() == ''){
//             		formvalid = false;
//             		$('#ewaybillno').addClass('haveerror');
//             		$('#ewaybillno_error').html('Enter eway billno.').show();
//             	} else {
//             		$('#ewaybillno').removeClass('haveerror');
//             		$('#ewaybillno_error').html('').hide();
//             	}
            	
            	if($('#shipping_destination').val() == ''){
            		formvalid = false;
            		$('#shipping_destination').addClass('haveerror');
            		$('#shipping_destination_error').html('Enter destination').show();
            	} else {
            		$('#shipping_destination').removeClass('haveerror');
            		$('#shipping_destination_error').html('').hide();
            	}

// 				if($('#contact_no').val() == ''){
// 					$('#contact_no').addClass('haveerror');
// 					$('#contact_no_error').html('Enter contact No.').show();
// 					formvalid = false;
// 				} else {
// 					$('#contact_no').removeClass('haveerror');
// 					$('#contact_no_error').html('').hide();
// 				}

				if($('#gst_no').val() == ''){
					$('#gst_no').addClass('haveerror');
					$('#gst_no_error').html('please enter gstno.').show();
					formvalid = false;
				} else {
					$('#gst_no').removeClass('haveerror');
					$('#gst_no_error').html('').hide();
				}

				if($('#address').val() == ''){
					$('#address').addClass('haveerror');
					$('#address_error').html('Please enter address.').show();
					formvalid = false;
				} else {
					$('#address').removeClass('haveerror');
					$('#address_error').html('').hide();
				}
				
				if($('#shipping_address').val() == ''){
					$('#shipping_address').addClass('haveerror');
					$('#shipping_address_error').html('Please enter shipping address.').show();
					formvalid = false;
				}else {
					$('#shipping_address').removeClass('haveerror');
					$('#shipping_address_error').html('').hide();
				}
            	
				if($('#billdate').val() == ''){
					$('#billdate').addClass('haveerror');
					$('#billdate_error').html('Please enter date.').show();
					formvalid = false;
				} else {
					$('#billdate').removeClass('haveerror');
					$('#billdate_error').html('').hide();
				}
				
				if($('#pay_mode').val() ==''){
					$('#pay_mode').addClass('haveerror');
					$('#pay_mode_error').html('Select payment mode.').show();
					formvalid = false;
				} else {
					$('#pay_mode').removeClass('haveerror');
					$('#pay_mode_error').html('').hide();
				}
				
				if($('#rec_amount').val() == ''){
					formvalid = false;
					$('#rec_amount').addClass('haveerror');
					$('#rec_amount').html('Enter recived amount').show();
				} else {
					$('#rec_amount').removeClass('haveerror');
					$('#rec_amount').html('').hide();
				}
            	
				if(formvalid){
					console.log('asdasd');
					$.ajax({
						type: 'POST',
						url : baseUrl + 'Sales/bill_entry',
						data : {
							'items': items,
							'cgst' : $('#cgst_amount').val(),
							'sgst' : $('#sgst_amount').val(),
							'igst' : $('#igst_amount').val(),
							'pay_mode' : $('#pay_mode').val(),
							'rec_amount' : $('#rec_amount').val(),
							'discount_per' : $('#discount_per').val(),
							'bill_no' : $('#billno').val(),
							'other_vendor' : $('#other_vendor').val(),
							'billdate' : $('#billdate').val(),
							'seller_id' : $('#seller_id').val(),
							'contact_no' : $('#contact_no').val(),
							'alternet_contact' : $('#alternet_contact').val(),
							'gst_no' : $('#gst_no').val(),
							'address' : $('#address').val(),
							'vendor_id' : $('#vendor_id').val(),
							'grrr_no' : $('#grrr_no').val(),
							'grr_date' : $('#grr_date').val(),
							'transname' : $('#transname').val(),
							'vechileno' : $('#vechileno').val(),
							'ewaybillno' : $('#ewaybillno').val(),
							'other_customer' : $('#other_customer').val(),
							'shipping_destination' : $('#shipping_destination').val(),
							'shipping_address' : $('#shipping_address').val(),
							'shipping_state' : $('#shipping_state').val(),
							'broker_id' : $('#broker_id').val(),
							'insurance' : $('#insurance').val(),
							'frieght' : $('#frieght').val()
						},
						dataType : 'json',
						success: function(response){
							if(response.status == 200){
								alert(response.msg);
								window.location.href = baseUrl + '/bill/bill-list';
							} else {
								alert(response.msg);
							}
						}
					});
				}
            });
            
            
            $(document).on('change','#item',function(){
            	console.log('745');
            	productId = $(this).val();
            	$('#quantity').val('');
            	$('#unit').val('');
            	$('#purchase_from').val('');
            	$('#ppu').val(0);
            	$('#total').val(0);
            		
            	$.ajax({
						type: 'POST',
						url : baseUrl + 'product/getproductUnit',
						data : {
							'productId' : productId
						},
						dataType : 'json',
						success: function(response){
							console.log(response);
							if(response.status == 200){
								var x = '<option value="">Select unit</option>';
								$.each(response.data,function(key,value){
									x = x + '<option value="'+ value.unit_id +'">'+ value.name +'</option>';
								});
								$('#unit').html(x);
							}
							
						}
				});	
            });

			
			$(document).on('change','#unit',function(){
				var productId = $('#item').val();
				$('#purchase_from').val('');
				$('#ppu').val(0);
				$('#total').val(0);
				
				var unitId = $(this).val();
				var quantity = $('#quantity').val();				
				$.ajax({
						type: 'POST',
						url : baseUrl + 'product/getdetail',
						data : {
							'productId' : productId,
							'unitId' : unitId
						},
						async: false,
						dataType : 'json',
						success: function(response){
							$('#ppu').val(response.data[0].ppu);

							//$( "#quantity" ).trigger( "keyup" );
						}
				});
			});
			
			$(document).on('click','#shipping_checkbox',function(){	
				if($(this).prop("checked") == true){
					$('#shipping_address').val($('#address').val());
				} else {
					$('#shipping_address').val('');
				}
			});
            
            
            
            $(document).on('keyup','#cgst_amount,#insurance,#frieght,#sgst_amount,#igst_amount,#discount_per',function(){
            	billPreview(0);
            });
            
            
            $("#billdate,#grr_date").datepicker({
                //showOn: 'button',
//                 buttonImageOnly: false,
//                 buttonImage: 'images/calendar.gif',
                dateFormat: 'dd/mm/yy'
            });
            
            $(document).on('change','#purchase_from',function(){
            	$('#ppu').val(0);
            	$('#total').val(0);
            });
            
            
            $(document).on('keyup','#ppu',function(){
            	$('#total').val($('#quantity').val() * $(this).val());
            });
            
            $(document).on('keyup','#quantity',function(){
            	$('#purchase_from').val('');
            	$('#unit').val('');
            	$('#purchase_from').val('');
            	$('#ppu').val(0);
            	$('#total').val(0);
            	
            	var itemId = $('#item').val();
            	var quantity = $(this).val();
            	if($('#item').val() == ''){
            		alert('Please select item first');
            		return false;
            	} 
            	
            	
            	$.ajax({
						type: 'POST',
						url : baseUrl + 'stock/getvendorlist',
						data : {
							'item_id' : itemId,
							'quantity' : quantity
						},
						dataType : 'json',
						success: function(response){
							var x = '<option value="">Select Vendor</option>';
							if(response.status == 200){
								$.each(response.data,function(key,value){
									x = x + '<option value="'+ value.vendor_id +'">'+ value.vendor_name +'('+ value.availablity +')</option>';
								});
							
							$('#purchase_from').html(x);
							}
							else {
								$('#purchase_from').html(x);
							}
						}
				});
            });

        });
    </script>
    


