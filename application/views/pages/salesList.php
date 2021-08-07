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
                                        		<th>Broker Name</th>
<!--                                         		<th>Pre Tax Amount</th> -->
<!--                                         		<th>Tax Amount</th> -->
<!--                                         		<th>Total Amount</th> -->
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
            			url : baseUrl+'sales/sale_list_ajax/',
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
                    						'<td>'+ parseInt(key + 1) +'.</td>'+
                    						'<td>'+ value.bill_date + '</td>'+
                    						'<td>'+ value.vendor_name +'</td>'+
                    						'<td>'+ value.broker_name +'</td>'+
//                     						'<td>'+ value.product_total_amount +'</td>'+
//                     						'<td>'+(parseFloat((value.product_total_amount * value.cgst)/100) + parseFloat((value.product_total_amount * value.sgst)/100) + parseFloat((value.product_total_amount * value.igst)/100)) + '</td>'+
//                     						'<td>'+ value.grandtotal_amount +'</td>'+
                    						'<td>'+
                    							'<a href="'+ baseUrl+'sales/order/edit/'+value.sales_order_id +'" class="btn-secondary btn-sm">Edit</a>'+	
                    							'&nbsp; <input type="button" data-billid="'+ value.sales_order_id +'" class="view btn-primary btn-sm" value="View" />'+
                    							'&nbsp; <input type="button" data-billid="'+ value.sales_order_id +'" class="delete btn-danger btn-sm" value="Delete" />'+
                    							//'<a target="_blank" href="'+ baseUrl +'sales/generate_bill/'+ value.sales_order_id +'" class="btn btn-info btn-sm">PDF</a>'+
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
        			url : baseUrl+'sales/sales_bill_detail_ajax/',
        			type : 'POST',
        			dataType : 'JSON',
        			data : {
        				'bill_no' : billno
        			},
        			success : function(response){
        				console.log(response);
        				$('#modalTitle').html('');
        				var x = '<div>Sale Date : '+ response.data.sale_detail[0].bill_date +'</div>'+
        						'<div>Buyer Name : '+ response.data.sale_detail[0].vendor_name +'</div>'+
        						'<div>Broker Name : '+ response.data.sale_detail[0].broker_name +'</div>';
        				
        				x = x + '<table class="table table-striped table-bordered text-center"><tr class="bg-dark text-light">'+
        									'<th>S.No.</th>'+
        									'<th>Product Name</th>'+
        									'<th>Quantity</th>'+
        									'<th>Rate Per Metric Ton</th>'+
        									'<th>GST Amount <br/><small>CGST+SGST+IGST</small></th>'+
        								'</tr>'; 		
        				$.each(response.data.bill_detail,function(key,value){
        					x = x + '<tr>'+
        								'<td>'+ parseInt(parseInt(key) + 1) +'.</td>'+
        								'<td>'+ value.product_name +'</td>'+
        								'<td>'+ value.qty +'<small> ('+ value.unit_name +')</small></td>'+
        								'<td>'+ value.perunit_price +'</td>';
        								if(key == 0){
        								x = x + '<td rowspan="'+ response.data.bill_detail.length +'" valign="middle">'+ 
        									parseFloat(parseFloat(response.data.sale_detail[0].cgst) + parseFloat(response.data.sale_detail[0].sgst) + parseFloat(response.data.sale_detail[0].igst)) 
        								+'</td>';
        								}
        							x = x + '</tr>';
        				});
//         				x = x + '<tr><td></td><td></td><td></td><td></td><td></td></tr>';
//         				if(response.data.sale_detail[0].cgst != 0){
//         					x = x + '<tr><td colspan="4" class="text-right">CGST</td><td>'+ ((response.data.sale_detail[0].product_total_amount * response.data.sale_detail[0].cgst)/100) +'</td></tr>'; 
//         				}
//         				if(response.data.sale_detail[0].sgst != 0){
//         					x = x + '<tr><td colspan="4" class="text-right">CGST</td><td>'+ ((response.data.sale_detail[0].product_total_amount * response.data.sale_detail[0].sgst)/100) +'</td></tr>'; 
//         				}
//         				if(response.data.sale_detail[0].igst != 0){
//         					x = x + '<tr><td colspan="4" class="text-right">CGST</td><td>'+ ((response.data.sale_detail[0].product_total_amount * response.data.sale_detail[0].igst)/100) +'</td></tr>'; 
//         				}
//         				x = x + '<tr><td colspan="4" class="text-right">Grand Total</td><td>'+ response.data.sale_detail[0].grandtotal_amount  +'</td></tr></table>';
        				
                					
        				$('#modalBody').html(x);
                                			
        			}
    			});
        			
        		$('#myModal').modal('show');
        	});
        	
        	$(document).on('click','.delete',function(){
        		var c = confirm('Are you sure.');
        		if(c){
        			var billno = $(this).data('billid');
            		$.ajax({
            			url : baseUrl+'sales/delete',
            			type : 'POST',
            			dataType : 'JSON',
            			data : {
            				'bill_no' : billno
            			},
            			success : function(response){
            				if(response.status == 200){
            					alert(response.msg);
            					location.reload();
            				}
            			}
            		});
        		}
        	});
        	
        	
        	$("#to-date,#from-date").datepicker({
//                 showOn: 'button',
//                 buttonImageOnly: false,
//                 buttonImage: 'images/calendar.gif',
                dateFormat: 'dd/mm/yy'
            });
            
        });
    </script>
    


