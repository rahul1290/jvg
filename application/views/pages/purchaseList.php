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
                                    	<input type="text" id="to-date" name="to-date" value="<?php echo date('t/12/Y'); ?>" />
                                    	<input type="button" value="Search" id="search"/>
                                    </div>
                                    <table class="table table-striped table-bordered" id="purchaseTable">
                                    	<thead>
                                        	<tr>
                                        		<th>SNo.</th>
                                        		<th>Bill No.</th>
                                        		<th>Vendor Name</th>
                                        		<th>Pre Tax Amount</th>
                                        		<th>Tax Amount</th>
                                        		<th>Total Amount</th>
                                        		<th>Bill Date</th>
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
            			url : baseUrl+'purchase/purchase_list_ajax/',
            			type : 'POST',
            			dataType : 'JSON',
            			data : {
            				'from_date' : $('#from-date').val(),
            				'to_date' : $('#to-date').val()
            			},
            			success : function(response){
            			if(response.status == 200){
            				var x;
            				$.each(response.data,function(key,value){
            					x = x + '<tr>'+
                    						'<td>'+ parseInt(key + 1) +'</td>'+
                    						'<td>'+ value.bill_no + '</td>'+
                    						'<td>'+ value.vendor_name +'</td>'+
                    						'<td>'+ indrupee_format(value.product_total_amount) +'</td>'+
                    						'<td>'+ indrupee_format(value.gst_amount) +'</td>'+
                    						'<td>'+ indrupee_format(value.grandtotal_amount) + '</td>'+
                    						'<td>'+ value.bill_date + '</td>'+
                    						'<td>'+	
                    							'<a href="'+ baseUrl+'purchase/bill_entry_update/'+value.bill_no +'" class="btn btn-secondary btn-sm">Edit</a>'+
                    							'<input type="button" data-billid="'+ value.bill_no +'" class="view btn btn-primary btn-sm" value="View"/>'+
                    							'<a target="_blank" href="'+ baseUrl+'purchase/purchase_pdf/'+value.bill_no +'" class="btn btn-info btn-sm">PDF</a>'+
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
        			url : baseUrl+'purchase/purchase_bill_detail_ajax/',
        			type : 'POST',
        			dataType : 'JSON',
        			data : {
        				'bill_no' : billno
        			},
        			success : function(response){
        				console.log(response)
        				$('#modalTitle').html('<p style="line-height:7px;"><span class="text-primary">Bill No. </span>: '+ response.data.billdetail[0].bill_no +'</p>'+
        									  '<p style="line-height:10px;"><span class="text-primary">Bill Date </span>: '+ response.data.billdetail[0].bill_date +'</p>'+
        									  '<p style="line-height:7px;"><span class="text-primary">Vendor Name </span>:'+ response.data.billdetail[0].vendor_name +'</p>');
        				var x = '<table class="table table-bordered"><tr>'+
        								'<th>Sno.</th>'+
        								'<th>Product Name</th>'+
        								'<th>Product Code</th>'+
        								'<th>Qunatity</th>'+
        								'<th>Unit</th>'+
        								'<th>PPU</th>'+
        								'<th>Total</th>'+
        							'</tr>';
        				$.each(response.data.items,function(key,value){
        					x = x + '<tr>'+
        								'<td>'+ parseInt(key + 1) +'</td>'+	
        								'<td>'+ value.productname +'</td>'+
        								'<td>'+ value.productcode +'</td>'+
        								'<td>'+ value.qty +'</td>'+
        								'<td>'+ value.unitname +'</td>'+
        								'<td>'+ indrupee_format(value.perunit_price) +'</td>'+
        								'<td>'+ indrupee_format(value.product_total_amount) +'</td>'+
        							'</tr>';
        				});
        				x = x + '<tr class="bg-dark text-light">'+
        							'<td colspan="6" class="text-center">Total</td>'+
        							'<td colspan="6">'+ indrupee_format(response.data.billdetail[0].product_total_amount) +'</td>'+
        						'</tr>'+
								'<tr>'+
        							'<td colspan="6" class="text-center">Discount Amount</td>'+
        							'<td colspan="6">'+ indrupee_format(response.data.billdetail[0].discount) +'</td>'+
        						'</tr>'+
        						'<tr>'+
        							'<td colspan="6" class="text-center">GST Amount</td>'+
        							'<td colspan="6">'+ indrupee_format(response.data.billdetail[0].gst_amount) +'</td>'+
        						'</tr>'+
        						'<tr class="bg-dark text-danger">'+
        							'<td colspan="6" class="text-center">Payable Amount</td>'+
        							'<td colspan="6"><b>'+ indrupee_format(response.data.billdetail[0].grandtotal_amount) +'</b></td>'+
        						'</tr>';
        				x = x + '</table>';
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
    


