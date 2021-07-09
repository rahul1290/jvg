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
                                    CUSTOMER DETAIL
                                </div>
                                <div class="card-body">
                                	<p class="text-center text-danger.Try again..."><?php echo $this->session->flashdata('msg'); ?></p>
                                    <form name="f1" method="POST" action='#'>
                                    	
                                    	<div class="row">
                                    		<div class="col-12">
                                    			<div class="">
                                        			<div class="form-row">
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-4 col-form-label col-form-label-sm">Customer<span class="text-danger">*</span></label>
                                                            <select id="customer_id" class="form-control">
                                                        		<option value="">Select Customer</option>
                                                        		<?php foreach($customer_list as $customer){ ?>
                                                        			<option value="<?php echo $customer['id']; ?>"><?php echo $customer['customer_name']; ?></option>
                                                        		<?php } ?>
                                                        		<option value="oth">Other</option>
                                                        	</select>
                                                        	<input class="mt-1" style="display:none;" id="other_customer" type="text" placeholder="Enter customer name"/>
                                                        	<div id="other_customer_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-3 col-form-label col-form-label-sm">Bill No.<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="billno" name="billno" placeholder="bill no" value="<?php echo $billno;?>">
                                                  			<div id="billno_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-4 col-form-label col-form-label-sm">Bill Date<span class="text-danger">*</span></label>
                                                    		<input type="text" class="form-control" id="billdate" name="billdate" placeholder="Date" value="<?php echo date('d/m/Y');?>">
                                                  			<div id="billdate_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-row">
                                                    	<div class="form-group col-md-4">
                                                        	<label class="col-sm-4 col-form-label col-form-label-sm">Contact No.<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm" id="contact_no" name="contact_no" placeholder="Contact No." value="<?php echo set_value('contact_no'); ?>">
                                                            <div id="contact_no_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-4 col-form-label col-form-label-sm">Alternet No.</label>
                                                            <input type="text" class="form-control form-control-sm" id="alternet_contact" name="alternet_contact" placeholder="Alternet No." value="<?php echo set_value('alternet_contact'); ?>">
                                                        	<div id="alternet_contact_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                        	<label class="col-sm-3 col-form-label col-form-label-sm">GST No.<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm" id="gst_no" name="gst_no" placeholder="GST No." value="<?php echo set_value('gst_no');?>">
                                                        	<div id="gst_no_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-row">
                                                    	<div class="form-group col-md-6">
                                                        	<label class="col-sm-4 col-form-label col-form-label-sm">GR/RR No.</label>
                                                            <input type="text" class="form-control form-control-sm" id="grrr_no" name="grrr_no" placeholder="GR/RR No">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                        	<label class="col-sm-4 col-form-label col-form-label-sm">Date</label>
                                                            <input type="text" class="form-control form-control-sm" id="grr_date" name="grr_date" placeholder="Alternet No." >
                                                        </div>
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
                                                    		<label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Shipping state<span class="text-danger">*</span></label>
                                                    		<select class="form-control" id="shipping_state" name="shipping_state">
                                                        		<option value="">Select State</option>
                                                        		<?php foreach($states as $state){ ?>
                                                        			<option value="<?php echo $state['state_id']; ?>"><?php echo $state['state_name']; ?></option>
                                                        		<?php } ?>
                                                        	</select>
                                                        	<div id="shipping_state_error" class="text-danger" style="display: none;"></div>
                                                    	</div>
                                                    	<div class="from-group col-md-4 mt-4">
                                                    		<div class="row">
                                                    			<input class="m-2" type="checkbox" id="shipping_checkbox"/><label>Shipping Address same as Billing Address</label>
                                                    		</div>
                                                    	</div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Shipping Address<span class="text-danger">*</span></label>
                                                        <div class="col-sm-12">
                                                        	<textarea class="form-control form-control-sm" rows="5" id="shipping_address" name="shipping_address"><?php echo set_value('address'); ?></textarea>
                                                        	<div id="address_error" class="text-danger" style="display: none;"></div>
                                                        </div>
                                                    </div>
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
                                              <label>Transport Name<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" id="transname" name="transname" aria-describedby="emailHelp" placeholder="Transporter Name">
                                              <div class="text-danger" id="transname_error" style="display: none;"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label for="exampleInputPassword1">Vechile No.<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" id="vechileno" name="vechileno" placeholder="Vechile no.">
                                              <div class="text-danger" id="vechileno_error" style="display: none;"></div>
                                            </div>
                                          </div>
                                		
                                      <div class="form-group">
                                        
                                        
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Eway Bill No.<span class="text-danger">*</span></label>
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
														<td>Price per unit</td>
														<td>
															<input type="number" id="ppu" placeholder="Prie Per Unit"/>
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
                                        	<table id="total_cal" style="display: none;">
                                        		<tr>
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
                                        		
                                        			<td>Discount</td>
                                        			<td>
                                        				<div class="input-group">
                                                          <input type="text" id="discount_per" value="0" class="form-control" placeholder="Discount amount percentage" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                            
                            
                            
                            <div class="form-group row mt-3" id="payment_tab" style="display: none;">
                            	<label for="staticEmail" class="col-sm-2 col-form-label">Payment Mode</label>
                                <div class="col-sm-10">
                                  <select id="pay_mode" name="pay_mode">
                                  	<option value="">Select payment mode</option>
                                  	<option value="cash">Cash</option>
                                  	<option value="ledger">ledger</option>
                                  </select>
                                </div>
								<label for="staticEmail" class="col-sm-2 col-form-label">Previous Due</label>
                                <div class="col-sm-10">
                                  <input type="text" id="due_amount" value="0" />
                                </div>
                                <label for="staticEmail" class="col-sm-2 col-form-label">Recived Amount</label>
                                <div class="col-sm-10">
                                  <input type="text" id="rec_amount" />
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
        		
        		if($('#unit').val() == ''){
        			$('#unit').addClass('haveerror');
        			formvalid = false;
        		} else {
        			$('#unit').removeClass('haveerror');
        		}
        		
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
				temp['qty'] = $('#quantity').val();
				temp['total'] = $('#total').val();
				
				if(i) {    
					items.push(temp);
				}
				
				$('#item,#unit,#ppu,#quantity').val('');
				var x = '<table class="table table-bordered table-striped text-center table-sm">'+
							'<thead><tr>'+
							'<th>sno.</th>'+
							'<th>Item</th>'+
							'<th>Quantity</th>'+
							'<th>Unit</th>'+
							'<th>PPU</th>'+
							'<th>Total</th>'+
							'<th></th>'+	
						'</tr></thead><tbody>';
				var totalBill = 0;	
				$.each(items,function(key,value){
					totalBill = totalBill + parseFloat(value.total);
					x = x + '<tr>'+
								'<td>'+ parseFloat(key+1) +'</td>'+
								'<td>'+ value.itemText +'</td>'+
								'<td>'+ value.qty +'</td>'+
								'<td>'+ value.unitText +'</td>'+
								'<td>'+ value.ppu +'</td>'+
								'<td>'+ value.total +'</td>'+
								'<td><input type="button" value="del" data-index="'+ key +'" class="btn btn-danger item-del"/></td>'+
							'</tr>';
				});
				var cgstAmount = ((totalBill *$('#cgst_amount').val())/100).toFixed(2);
				var sgstAmount = ((totalBill *$('#sgst_amount').val())/100).toFixed(2);
				var igstAmount = ((totalBill *$('#igst_amount').val())/100).toFixed(2);
				var discount = ((totalBill * $('#discount_per').val())/100).toFixed(2);
				
				var payableAmount = ((parseFloat(totalBill) + parseFloat(cgstAmount) + parseFloat(sgstAmount) + parseFloat(igstAmount)) - parseFloat(discount));
				
				x = x + '<tr class="bg-secondary text-light">'+
							'<td colspan="5" class="text-right">Amount</td>'+
							'<td colspan="2" class="text-left">'+ totalBill +'</td>'+
						'</tr>'+
						'<tr class="bg-secondary text-light">'+
							'<td colspan="5" class="text-right">CGST Amount</td>'+
							'<td colspan="2" class="text-left">'+ cgstAmount +'</td>'+
						'</tr>'+
						'<tr class="bg-secondary text-light">'+
							'<td colspan="5" class="text-right">SGST Amount</td>'+
							'<td colspan="2" class="text-left">'+ sgstAmount +'</td>'+
						'</tr>'+
						'<tr class="bg-secondary text-light">'+
							'<td colspan="5" class="text-right">IGST Amount</td>'+
							'<td colspan="2" class="text-left">'+ igstAmount +'</td>'+
						'</tr>'+
						'<tr class="bg-secondary text-light">'+
							'<td colspan="5" class="text-right">Discount</td>'+
							'<td colspan="2" class="text-left">'+ discount +'</td>'+
						'</tr>'+
						'<tr class="bg-secondary text-light">'+
							'<td colspan="5" class="text-right">GrandTotal</td>'+
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
			}
            
            	
            $(document).on('click','.item-del',function(){
            	let index = $(this).data('index');
            	items.splice(index,1);
            	billPreview(0);
            });


        	$(document).on('change','#customer_id',function(){
        		$('#shipping_checkbox').prop('checked', false);
        		$('#shipping_address').val('');
            	var customerId = $(this).val();
            	if(customerId == 'oth'){
                	$('#other_customer').show();	
                	$('#contact_no').val('');
                	$('#alternet_contact').val('');	
                	$('#gst_no').val('');	
                	$('#address').val('');
                } else {
                	$('#other_customer').val('').hide();
                	$('#contact_no').val('');
                	$('#alternet_contact').val('');	
                	$('#gst_no').val('');	
                	$('#address').val('');
                	
                	if(customerId != ''){
                		$.ajax({
                        	type: 'POST',
                            url : baseUrl + 'customer/getdetail',
                            data : {
                            	customerId: customerId
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
            	
            	if($('#customer_id').val() == 'oth'){
            		if($('#other_customer').val() == ''){
            			$('#other_customer').addClass('haveerror');
            			$('#other_customer_error').html('Enter customer name').show();
            			formvalid = false;
            		} else {
            			$('#other_customer').removeClass('haveerror');
            			$('#other_customer_error').html('').hide();
            		}	
            	}
            	
            	if($('#shipping_state').val() == ''){
            		formvalid = false;
            		$('#shipping_state').addClass('haveerror');
            	} else {
            		$('#shipping_state').removeClass('haveerror');
            	}
            	
            	if($('#transname').val() == ''){
            		formvalid = false;
            		$('#transname').addClass('haveerror');
            		$('#transname_error').html('Enter transporter name').show();
            	} else {
            		$('#transname').removeClass('haveerror');
            		$('#transname_error').html('').hide();
            	}
            	
            	if($('#vechileno').val() == ''){
            		formvalid = false;
            		$('#vechileno').addClass('haveerror');
            		$('#vechileno_error').html('Enter vechile no').show();
            	} else {
            		$('#vechileno').removeClass('haveerror');
            		$('#vechileno_error').html('').hide();
            	}
            	
            	if($('#ewaybillno').val() == ''){
            		formvalid = false;
            		$('#ewaybillno').addClass('haveerror');
            		$('#ewaybillno_error').html('Enter eway billno.').show();
            	} else {
            		$('#ewaybillno').removeClass('haveerror');
            		$('#ewaybillno_error').html('').hide();
            	}
            	
            	if($('#shipping_destination').val() == ''){
            		formvalid = false;
            		$('#shipping_destination').addClass('haveerror');
            		$('#shipping_destination_error').html('Enter destination').show();
            	} else {
            		$('#shipping_destination').removeClass('haveerror');
            		$('#shipping_destination_error').html('').hide();
            	}

				if($('#contact_no').val() == ''){
					$('#contact_no').addClass('haveerror');
					$('#contact_no_error').html('Enter contact No.').show();
					formvalid = false;
				} else {
					$('#contact_no').removeClass('haveerror');
					$('#contact_no_error').html('').hide();
				}

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
							'customer_id' : $('#customer_id').val(),
							'grrr_no' : $('#grrr_no').val(),
							'grr_date' : $('#grr_date').val(),
							'transname' : $('#transname').val(),
							'vechileno' : $('#vechileno').val(),
							'ewaybillno' : $('#ewaybillno').val(),
							'other_customer' : $('#other_customer').val(),
							'shipping_destination' : $('#shipping_destination').val(),
							'shipping_address' : $('#shipping_address').val(),
							'shipping_state' : $('#shipping_state').val()
						},
						dataType : 'json',
						success: function(response){
							if(response.status == 200){
								alert(response.msg);
								window.location.href = baseUrl + '/sales/sales_list';
							} else {
								alert(response.msg);
							}
						}
					});
				}
            });
            
            
            $(document).on('change','#item',function(){
            		productId = $(this).val();
            		
            	$.ajax({
						type: 'GET',
						url : baseUrl + 'stock/stock_detail/'+productId,
						data : {},
						async: false,
						dataType : 'json',
						success: function(response){
							if(response.status == 200){
								$('#quantity').attr({
									"max" : 20
								})
							}
						}
				});
					
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

			$(document).on('keyup','#ppu',function(){	
				$('#quantity').trigger('keyup');
			});
			
			$(document).on('change','#unit',function(){
				var productId = $('#item').val();
				var unitId = $('#unit').val();
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

							$( "#quantity" ).trigger( "keyup" );
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
            
            $(document).on('keyup','#quantity',function(){
            	var max = $(this).attr('max');
            	let qty = $(this).val();
            	let ppu = $('#ppu').val();
            	let gstamount = $('#item_gst').val();
            	let total = (qty*ppu).toFixed(2);
				let discount = $('#item_discount').val();

            	let itemdiscount = (total*discount)/100;
            	
            	if(parseFloat(qty) > parseFloat(max)){
            		alert('Only '+ max + ' unit available');
            	} else{
                	$('#total').val(total);
                	$('#item_grand_total').val(parseFloat(total) + parseFloat(gstamount) - parseFloat(itemdiscount));
            	}
            });
            
            
            $(document).on('keyup','#cgst_amount,#sgst_amount,#igst_amount,#discount_per',function(){
            	billPreview(0);
            });
            
            
            $("#billdate,#grr_date").datepicker({
                //showOn: 'button',
//                 buttonImageOnly: false,
//                 buttonImage: 'images/calendar.gif',
                dateFormat: 'dd/mm/yy'
            });

        });
    </script>
    


