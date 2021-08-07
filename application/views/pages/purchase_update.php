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
                                    <form name="f1" method="POST" action='#'>
                                    	
                                    	<div class="form-row" style="display: none;    ">
                                            <div class="form-group col-md-6">
                                              <label for="inputEmail4">Bill No.<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control form-control-sm" id="billno" name="billno" readonly placeholder="bill no" value="<?php echo $billno;?>">
                                              <div id="billno_error" class="text-danger" style="display: none;"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label for="inputPassword4">Bill Date<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control form-control-sm" id="billdate" name="billdate" placeholder="Date" value="<?php echo date('d-m-Y',strtotime($bill_detail[0]['bill_date'])); ?>">
                                              <div id="billdate_error" class="text-danger" style="display: none;"></div>
                                            </div>
                                          </div>
                                    	
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">Seller<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<select id="seller_id" class="form-control">
                                            		<option value="">Select seller</option>
                                            		<?php foreach($vendor_list as $vendor){ ?>
                                            			<option value="<?php echo $vendor['vendor_id']; ?>" <?php if($bill_detail[0]['vendor_id'] == $vendor['vendor_id']){ echo 'selected'; }?>><?php echo $vendor['vendor_name']; ?></option>
                                            		<?php } ?>
                                            		<option value="oth">Other</option>
                                            	</select>
                                            	<input class="mt-1" style="display:none;" id="other_vendor" type="text" placeholder="Enter vendor name"/>
                                            	<div id="other_vendor_error" class="text-danger" style="display: none;"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">Contact No.</label>
                                            <div class="col-sm-10">
                                            	<input type="text" class="form-control form-control-sm" id="contact_no" name="contact_no" placeholder="Contact No." value="<?php echo $vendor_detail[0]['contact_no']; ?>">
                                            	<div id="contact_no_error" class="text-danger" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">Alternet No.</label>
                                            <div class="col-sm-10">
                                            	<input type="text" class="form-control form-control-sm" id="alternet_contact" name="alternet_contact" placeholder="Alternet No." value="<?php echo $vendor_detail[0]['Alternate_contact_no']; ?>">
                                            	<?php echo form_error('alternet_contact'); ?>
                                            	<div id="alternet_contact_error" class="text-danger" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm">GST No.<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<input type="text" class="form-control form-control-sm" id="gst_no" name="gst_no" placeholder="GST No." value="<?php echo $vendor_detail[0]['gst_no']; ?>">
                                            	<div id="gst_no_error" class="text-danger" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<textarea class="form-control form-control-sm" rows="5" id="address" name="address"><?php echo $vendor_detail[0]['address']; ?></textarea>
                                            	<div id="address_error" class="text-danger" style="display: none;"></div>
												<?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Broker<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                            	<select id="broker" class="form-control">
                                            			<option value="">Select Broker</option>
                                            		<?php foreach($broker_list as $broker){ ?>
                                            			<option value="<?php echo $broker['id']; ?>"><?php echo $broker['broker_name']; ?></option>
                                            		<?php } ?>
                                            	</select>
                                            	<div id="broker_error" class="text-danger" style="display: none;"></div>
												<?php echo form_error('broker'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Items</label>
                                            <div class="col-sm-10 bg-secondary text-light">
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
													<table class="text-light">
														<tr>
															<td>Rate Per Metric Ton:</td>
															<td>
																<input type="number" id="ppu" placeholder="Prie Per Unit"/>
																<input type="button" value="Add Item" id="add_item" class="btn btn-sm btn-info">
															</td>
														</tr>
														<!--<tr>
															<td>Total</td>
															<td>
																<input type="text" id="total" readonly placeholder="total" value="0"/>
															</td>
														</tr>-->
														<tr class="pt-4">
															<td></td>
															
														</tr>
													</table>
													
												</div>
                                            </div>
                                        </div>
                                        
                                        </br>
                                        <div class="form-group row">
                                            <div class="offset-2 col-sm-9">	
                                            	<div class="table-responsive">
                                            		<table>
                                                		<tr>
                                                			<td>CGST</td>
                                                			<td>
                                                    			<div class="input-group">
                                                                  <input type="text" id="cgst_amount" value="" class="form-control" placeholder="CGST amount percentage" aria-label="Recipients username" aria-describedby="basic-addon2">
                                                                  <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">%</span>
                                                                  </div>
                                                                </div>
                                                            </td>
                                                            <td>SGST</td>
                                                			<td>
                                                    			<div class="input-group">
                                                                  <input type="text" id="sgst_amount" value="" class="form-control" placeholder="CGST amount percentage" aria-label="Recipients username" aria-describedby="basic-addon2">
                                                                  <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">%</span>
                                                                  </div>
                                                                </div>
                                                            </td>
                                                            <td>IGST</td>
                                                			<td>
                                                    			<div class="input-group">
                                                                  <input type="text" id="igst_amount" value="" class="form-control" placeholder="CGST amount percentage" aria-label="Recipients username" aria-describedby="basic-addon2">
                                                                  <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">%</span>
                                                                  </div>
                                                                </div>
                                                            </td>
                                                		</tr>
                                            		</table>
                                            		<br/>
                                            		<div id="bill_items" style="display: <?php if(count($bill_items)>0){ echo 'inline'; } else { echo 'none'; }?>;"></div>
                                            	</div>
                                            	<table id="total_cal" style="display: <?php if(count($bill_items)>0){ echo 'inline'; } else { echo 'none'; }?>;">
                                            		
                                            	</table>
                                            	
                                            	<br/><br/>
                                            	<input type="button" id="create" class="btn btn-success" value="Update"/>
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
        	var items =[];
        	
        	var billDetail = [];
       		<?php foreach($bill_detail as $item){ ?>
       			 $('#cgst_amount').val(parseFloat((<?php echo $item['cgst_amount']; ?>*100)/<?php echo $item['product_total_amount']; ?>));
       			 $('#sgst_amount').val(parseFloat((<?php echo $item['sgst_amount']; ?>*100)/<?php echo $item['product_total_amount']; ?>));
       			 $('#igst_amount').val(parseFloat((<?php echo $item['igst_amount']; ?>*100)/<?php echo $item['product_total_amount']; ?>));
        	     $('#broker').val(<?php echo $item['broker_id'];?>);
        	     
        	      billDetail.push({'cgst_amount':<?php echo $item['cgst_amount']; ?>,
	      			  'sgst_amount':<?php echo $item['sgst_amount']; ?>,
	      			  'igst_amount': <?php echo $item['igst_amount']; ?>,
	      			  'product_total_amount' : <?php echo $item['product_total_amount']; ?>
	      			});         
        	<?php } ?>
       		
        	<?php foreach($bill_items as $item){ ?>
        	  items.push({'item':<?php echo $item['product_id']; ?>,
        	      			  'itemText':'<?php echo $item['productname']; ?>',
        	      			  'ppu': <?php echo $item['perunit_price']; ?>,
        	      			  'total' : <?php echo $item['perunit_price'] * $item['qty']?>,
        	      			  'unit' : <?php echo $item['unit_id']?>,
        	      			  'unitText' : '<?php echo $item['unitname']?>',
        	      			  'qty' : '<?php echo $item['qty']?>'
        	      			});         
        	<?php } ?>
        	console.log(items);
        	billPreview(0);
        	
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
						'</tr></thead><tbody>';
				var totalBill = 0;	
				$.each(items,function(key,value){
					totalBill = totalBill + parseFloat(value.total);
					x = x + '<tr>'+
								'<td>'+ parseInt(key+1) +'</td>'+
								'<td>'+ value.itemText +'</td>'+
								'<td>'+ value.qty +'</td>'+
								'<td><input type="button" value="del" data-index="'+ key +'" class="btn btn-danger item-del"/></td>'+
							'</tr>';
				});
				var cgstAmount = parseFloat($('#cgst_amount').val());
				var sgstAmount = parseFloat($('#sgst_amount').val());
				var igstAmount = parseFloat($('#igst_amount').val());
				var cgstAmountrs = 0;
				var sgstAmountrs = 0;
				var igstAmountrs = 0;
				
				if(isNaN(cgstAmount) || cgstAmount == ''){
					cgstAmount = 0;
				} else{
					cgstAmountrs = parseFloat((totalBill * $('#cgst_amount').val())/100); 
				}
				if(isNaN(sgstAmount) || sgstAmount == ''){
					sgstAmount = 0;
				} else {
					sgstAmountrs = parseFloat((totalBill * $('#sgst_amount').val())/100);
				}
				if(isNaN(igstAmount) || igstAmount == ''){
					igstAmount = 0;
				} else {
					igstAmountrs = parseFloat((totalBill * $('#igst_amount').val())/100);
				}
				x = x + '<tr class="bg-secondary">'+
							'<td colspan="3" class="text-right text-light">Grand Total</td>'+
							'<td class="text-left text-light">'+ totalBill +'</td>'+
						'</tr>';
						
						if(cgstAmount != 0){
    						x = x + '<tr class="bg-secondary">'+
    							'<td colspan="3" class="text-right text-light">CGST Amount</td>'+
    							'<td class="text-left text-light">'+ parseFloat((totalBill * $('#cgst_amount').val())/100) +'</td>'+
    						'</tr>';
						}
						
						if(sgstAmount != 0){
						x = x + '<tr class="bg-secondary">'+
							'<td colspan="3" class="text-right text-light">SGST Amount</td>'+
							'<td class="text-left text-light">'+ parseFloat((totalBill * $('#sgst_amount').val())/100) +'</td>'+
						'</tr>';
						} 
						
						if(igstAmount != 0){
						x = x + '<tr class="bg-secondary">'+
							'<td colspan="3" class="text-right text-light">IGST Amount</td>'+
							'<td class="text-left text-light">'+ parseFloat((totalBill * $('#igst_amount').val())/100) +'</td>'+
						'</tr>';
						} 
						x = x + '<tr class="bg-secondary">'+
							'<td colspan="3" class="text-right text-light">Payble Amount</td>'+
							'<td class="text-left text-light">'+
								parseFloat(parseFloat(totalBill + cgstAmountrs) + parseFloat(sgstAmountrs + igstAmountrs))
							+'</td>'+
						'</tr>'+
				'</tbody></table>';
				
				if(items.length){
					$('#bill_items').html(x).show();	
					$('#total_cal').show();
				} else {
					$('#bill_items').hide();
					$('#total_cal').hide();
				}

				$('#total').val(0);
				$('#item_grand_total').val(0);
			}
            
            	
            $(document).on('click','.item-del',function(){
            	let index = $(this).data('index');
            	items.splice(index,1);
            	billPreview(0);
            });

			$(document).on('keyup','#cgst_amount',function(){
				billPreview(0);
			});

        	$(document).on('change','#seller_id',function(){
            	var sellerId = $(this).val();
            	if(sellerId == 'oth'){
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
                	
                	if(sellerId != ''){
                		$.ajax({
                        	type: 'POST',
                            url : baseUrl + 'vendor/getdetail',
                            data : {
                            	vendorId: sellerId
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
            		alert('Please select atlease one item to purchse.');
            	}
            	
            	if($('#billno').val() == ''){
            		$('#billno').addClass('haveerror');
            		$('#billno_error').html('Enter Bill no').show();
            		formvalid = false;
            	} else {
            		$('#billno').removeClass('haveerror');
            		$('#billno_error').html('').hide();
            	}
            	
            	if($('#seller_id').val() == ''){
            		$('#seller_id').addClass('haveerror');
            		$('#seller_id_error').html('please select seller').show();
            		formvalid = false;
            	} else {
            		$('#seller_id').removeClass('haveerror');
            		$('#seller_id_error').html('').show();
            	}
            	
            	if($('#broker').val() == ''){
            		$('#broker').addClass('haveerror');
            		$('#broker_error').html('please select broker').show();
            		formvalid = false;
            	} else {
            		$('#broker').removeClass('haveerror');
            		$('#broker_error').html('').show();
            	}
            	
            	if($('#seller_id').val() == 'oth'){
            		if($('#other_vendor').val() == ''){
            			$('#other_vendor').addClass('haveerror');
            			$('#other_vendor_error').html('Enter vendor name').show();
            			formvalid = false;
            		} else {
            			$('#other_vendor').removeClass('haveerror');
            			$('#other_vendor_error').html('').hide();
            		}	
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
            	
				if($('#billdate').val() == ''){
					$('#billdate').addClass('haveerror');
					$('#billdate_error').html('Please enter date.').show();
					formvalid = false;
				} else {
					$('#billdate').removeClass('haveerror');
					$('#billdate_error').html('').hide();
				}
            	
				if(formvalid){
					$.ajax({
						type: 'POST',
						url : baseUrl + 'Purchase/bill_update',
						data : {
							'items': items,
							'cgst_amount' : $('#cgst_amount').val(),
							'sgst_amount' : $('#sgst_amount').val(),
							'igst_amount' : $('#igst_amount').val(),
							'bill_no' : $('#billno').val(),
							'other_vendor' : $('#other_vendor').val(),
							'billdate' : $('#billdate').val(),
							'seller_id' : $('#seller_id').val(),
							'broker_id' : $('#broker').val(),
							'contact_no' : $('#contact_no').val(),
							'alternet_contact' : $('#alternet_contact').val(),
							'gst_no' : $('#gst_no').val(),
							'address' : $('#address').val()
						},
						dataType : 'json',
						success: function(response){
							if(response.status == 200){
								alert(response.msg);
								location.reload();
								window.location.href = baseUrl + '/purchase/list';
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

				$.ajax({
						type: 'POST',
						url : baseUrl + 'product/getdetail',
						data : {
							'productId' : productId,
							'unitId' : unitId
						},
						dataType : 'json',
						success: function(response){
							$('#ppu').val(response.data[0].ppu);

							$( "#quantity" ).trigger( "keyup" );
						}
				});
			});
            
            $(document).on('keyup','#quantity',function(){
            	let qty = $(this).val();
            	let ppu = $('#ppu').val();
            	let gstamount = $('#item_gst').val();
            	let total = (qty*ppu).toFixed(2);
				let discount = $('#item_discount').val();

            	let itemdiscount = (total*discount)/100;
            	$('#total').val(total);
            	$('#item_grand_total').val(parseInt(total) + parseFloat(gstamount) - parseFloat(itemdiscount)).toFixed(2);
            });
            
            
            $(document).on('keyup','#gst_amount,#discount_per',function(e){
            	billPreview(0);
            });
            
            $("#gst_amount").keypress(function (e) {
                 if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57)) {
                 	$("#errmsg").html("Digits Only").show().fadeOut("slow");
                    	return false;
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
 