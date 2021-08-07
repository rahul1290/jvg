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
                                    
                                    <div class="p-3 mb-4 bg-light text-right">
                                    	<label>From Date</label>
                                    	<input type="text" id="from-date" name="from-date" value="<?php echo date('01/01/Y'); ?>"/>
                                    	<label>To Date</label>
                                    	<input type="text" id="to-date" name="to-date" value="<?php echo date('d/m/Y'); ?>" />
                                    	<input type="button" value="Search" id="search"/>
                                    </div>
                                    <table class="table table-striped table-bordered" id="purchaseTable">
                                    	<thead>
                                        	<tr>
                                        		<th>SNo.</th>
                                        		<th>Bill Date</th>
                                        		<th>Buyer Name</th>
<!--                                        		<th>Broker Name</th>
                                        		<th>Tax Amount</th> -->
                                        		<th>Total Amount</th>
                                        		<th>Action</th>
                                        	</tr>
                                    	</thead>
                                    	<tbody id="purchaseTableData">
                                    		
                                    	</tbody>
                                    </table>

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
	
	<!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalBody">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <script>
        $(document).ready( function () {
        	var baseUrl = $('#baseurl').val();
        	
        	loadData();
        	function loadData(){
        		$.ajax({
            			url : baseUrl+'sales/bill_list_ajax/',
            			type : 'POST',
            			dataType : 'JSON',
            			data : {
            				'from_date' : $('#from-date').val(),
            				'to_date' : $('#to-date').val()
            			},
            			success : function(response){
            			console.log(response);
            			if(response.status == 200){
            				var x;
            				$.each(response.data,function(key,value){
            					x = x + '<tr>'+
                    						'<td>'+ parseInt(key + 1) +'</td>'+
                    						'<td>'+ value.invoice_date + '</td>'+
                    						'<td>'+ value.vendor_name +'</td>'+
                    						//'<td>'+ value.broker_name +'</td>'+
                    						//'<td>'+ value.total_tax_amount +'</td>'+
                    						'<td>'+ value.grand_total +'</td>'+
                    						
                    						'<td>'+
                    							//'<input type="button" value="Edit" />'+	
                    							'<input type="button" data-billid="'+ value.sales_id +'" class="view" value="View" />'+
                    							'<a target="_blank" href="'+ baseUrl +'sales/generate_bill/'+ value.sales_id +'" class="btn btn-default btn-sm">PDF</a>'+
                    						'</td>'+
                    					'</tr>';
            				});
            				$('#purchaseTableData').html(x);
            				$('#purchaseTable').DataTable({
            					destroy: false,
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]
                            });
            			} else {
            				$('#purchaseTableData').html('');
            			}
            				
                                    			
            			}
        			});
        	}
        	
        	$(document).on('click','#search',function(){
        		$("#purchaseTable").dataTable().fnDestroy();
        		loadData();
        	});
        	
        	$(document).on('click','.view',function(){
        		var billno = $(this).data('billid');
        		$.ajax({
        			url : baseUrl+'sales/sales_billdetail_ajax/',
        			type : 'POST',
        			dataType : 'JSON',
        			data : {
        				'bill_no' : billno
        			},
        			success : function(response){
        				console.log(response);
        				$('#modalTitle').html('');
        					var x = '<table border="1" width="100%">'+
											'<tr>'+
												'<td colspan="2">'+
													'<table width="100%">'+
														'<tr>'+
															'<td>'+
																'<div class="ml-1 row">'+
																	'<div class="col">GSTIN :'+ response.data.company_info[0].gst_no +'</div>'+
																	'<div class="col text-right" style="float-right;">Original copy</div>'+
																'</div>'+
																'<div class="text-center">'+
																	'<p><u>TAX INVOICE</u>'+
																	'<br/><b>'+ response.data.company_info[0].comany_name +'</b>'+
																	'<br/>'+ response.data.company_info[0].address +'</p>'+
																'</div>'+
															'</td>'+
														'</tr>'+
														
													'</table>'+
												'</td>'+
											'</tr>'+
											'<tr>'+
												'<td width="50%">'+
													'<table width="100%">'+
														'<tr>'+
															'<td>Invoice No.</td>'+
															'<td>:'+ response.data.sale_detail[0].invoice_no +'</td>'+
														'</tr>'+
														'<tr>'+
															'<td>Date of Invoice</td>'+
															'<td>:'+ response.data.sale_detail[0].invoice_date +'</td>'+
														'</tr>'+
														'<tr>'+
															'<td>GR/RR No. & Date</td>'+
															'<td>:'+ response.data.sale_detail[0].rrno +'</td>'+
														'</tr>'+
														'<tr>'+
															'<td>State of Supply</td>'+
															'<td>:'+ response.data.sale_detail[0].state_name +'</td>'+
														'</tr>'+
													'</table>'+
												'</td>'+
												'<td width="50%">'+
													'<table width="100%">'+
														'<tr>'+
															'<td>Transport</td>'+
															'<td>:'+ response.data.sale_detail[0].trasport +'</td>'+
														'</tr>'+
														'<tr>'+
															'<td>Vechile No.</td>'+
															'<td>:'+ response.data.sale_detail[0].vehicle_no +'</td>'+
														'</tr>'+
														'<tr>'+
															'<td>Eway Bill No.</td>'+
															'<td>:'+ response.data.sale_detail[0].eway_no +'</td>'+
														'</tr>'+
														'<tr>'+
															'<td>Destination</td>'+
															'<td>:'+ response.data.sale_detail[0].destination +'</td>'+
														'</tr>'+
													'</table>'+
												'</td>'+
											'</tr>'+
											'<tr>'+
												'<td><b>Billed To :</b><br/>'+
													response.data.sale_detail[0].bill_address +
												'</td>'+
												'<td><b>Shipped To:</b><br/>'+
													response.data.sale_detail[0].shipping_address +
												'</td>'+
											'</tr>'+
											'<tr>'+
												'<td colspan="2">'+
													'<table width="100%" border="1">'+
														'<tr>'+
															'<td width="5%">S.No.</td>'+
															'<td width="45%">Description of Goods</td>'+
															'<td>HSN/SAC</td>'+
															'<td>Quantity</td>'+
															'<td>Unit</td>'+
															'<td>Rate</td>'+
															'<td>Amount</td>'+
														'</tr>';
														$.each(response.data.bill_detail,function(key,value){
														
														x = x + '<tr>'+
															'<td width="5%">'+ parseInt(key+1) +'</td>'+
															'<td width="45%">'+ value.product_name +'</td>'+
															'<td>7207</td>'+
															'<td>'+ value.qty +'</td>'+
															'<td>'+ value.unit_name +'</td>'+
															'<td>'+ value.sales_per_unit +'</td>'+
															'<td>'+ value.sales_product_amount +'</td>'+
														'</tr>';
														});
														
														x = x + '<tr>'+
															'<td colspan="6" class="text-right">Total</td>'+
															'<td>'+ response.data.sale_detail[0].grand_total +'</td>'+
														'</tr>';
														
														if(response.data.sale_detail[0].insurance != '0'){
														x = x + '<tr>'+
															'<td colspan="6" class="text-right">Insurance :</td>'+
															'<td>'+ response.data.sale_detail[0].insurance +'</td>'+
														'</tr>';
														}
														
														if(response.data.sale_detail[0].frieght != '0'){
														x = x + '<tr>'+
															'<td colspan="6" class="text-right">frieght :</td>'+
															'<td>'+ response.data.sale_detail[0].frieght +'</td>'+
														'</tr>';
														}
														
														if(response.data.sale_detail[0].cgst_amount != 0){
    														x = x + '<tr>'+
    															'<td colspan="6" class="text-right">Add : CGST @ 9.00 %</td>'+
    															'<td>'+ response.data.sale_detail[0].cgst_amount +'</td>'+
    														'</tr>';
														}
														if(response.data.sale_detail[0].sgst_amount != 0){
														x = x + '<tr>'+
															'<td colspan="6" class="text-right">Add : SGST @ 9.00 %</td>'+
															'<td>'+ response.data.sale_detail[0].sgst_amount +'</td>'+
														'</tr>';
														}
														if(response.data.sale_detail[0].igst_amount != 0){
														x = x + '<tr>'+
															'<td colspan="6" class="text-right">Add : IGST @ 9.00 %</td>'+
															'<td>'+ response.data.sale_detail[0].igst_amount +'</td>'+
														'</tr>';
														}
														x = x +'<tr>'+
															'<td colspan="6" class="text-right">Grand Total :</td>'+
															'<td>'+ response.data.sale_detail[0].grand_total +'</td>'+
														'</tr>'+
													'</table>'+
												'</td>'+
											'</tr>'+
											'<tr>'+
												'<td colspan="2">'+
													'<table>'+
														'<tr>'+
															'<td><u>Tax%</u>&nbsp;&nbsp;</td>'+
															'<td><u>Taxable Amt.</u>&nbsp;&nbsp;</td>'+
															'<td><u>CGST</u>&nbsp;&nbsp;</td>'+
															'<td><u>SGST</u>&nbsp;&nbsp;</td>'+
															'<td><u>Total Tax</u>&nbsp;&nbsp;</td>'+	
														'</tr>'+
														'<tr>'+
															'<td>9%&nbsp;&nbsp;</td>'+
															'<td>'+ parseFloat(parseFloat(response.data.sale_detail[0].grand_total) + parseFloat(response.data.sale_detail[0].insurance))  +'&nbsp;&nbsp;</td>'+
															'<td>'+ response.data.sale_detail[0].cgst_amount +'&nbsp;&nbsp;</td>'+
															'<td>'+ response.data.sale_detail[0].sgst_amount +'&nbsp;&nbsp;</td>'+
															'<td>'+ response.data.sale_detail[0].total_tax_amount +'&nbsp;&nbsp;</td>'+	
														'</tr>'+
														'<tr>'+
															'<td colspan="5">'+
																response.data.sale_detail[0].total_in_words + 
															'</td>'+
														'</tr>'+
													'</table>'+
												'</td>'+
											'</tr>'+
											'<tr>'+
												'<td colspan="2">'+
													'<table>'+
														'<tr>'+
															'<td>Bank Details</td>'+
															'<td>: Karnataka Bank Ltd., Raigarh Branch</td>'+
														'</tr>'+
														'<tr>'+
															'<td>Account No.</td>'+
															'<td>: 6 6 1 7 0 0 0 6 0 0 0 0 7 6 0 1</td>'+
														'</tr>'+
														'<tr>'+
															'<td>IFSC Code</td>'+
															'<td>: KARB0000661</td>'+
														'</tr>'+
													'</table>'+
												'</td>'+
											'</tr>'+
											'<tr>'+
												'<td>'+
													'Terms & Conditions</br>'+
													'E. & O.E.</br>'+
													'1. Goods once sold will not be taken back.</br>'+
													'2. Interest @ 18% p.a. will be charged if the payement</br>'+
													'is not made with in the stipulated time.</br>'+
													'3. Subject to "Raigarh" Jurisdiction only.</br>'+
												'</td>'+
												'<td class="text-center">'+	
													'<p>For '+ response.data.company_info[0].comany_name +'</p>'+
													'<br/>'+
													'Authorised Signatory'+
												'</td>'+
											'</tr>'+
										'</table>';
                						
        				$('#modalBody').html(x);
                                			
        			}
    			});
        			
        		$('#myModal').modal('show');
        	});
        	
        	
        	
        	
        	$("#to-date,#from-date").datepicker({
//                 showOn: 'button',
//                 buttonImageOnly: false,
//                 buttonImage: 'images/calendar.gif',
                dateFormat: 'dd/mm/yy'
            });
            
        });
    </script>
    


