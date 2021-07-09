<html>
<?php if(isset($header)){ echo $header; } ?>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php if(isset($navbar)){ print_r($navbar); }  ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php if(isset($topbar)){ print_r($topbar); } ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->

					<div class="row">
						<span class="col"></span>
						<span class="col text-right"></span>
					</div>
					
					
					
					<table border="1" width="100%" style="border-collapse: collapse;">
						<tr>
							<td colspan="2">
								<table width="100%">
									<tr>
										<td>
    										<div class="ml-1 row">
    											<div class="col">Bill No. : <?php echo $purchase_data[0]['bill_no']; ?><br>Vendor Name : <?php echo $purchase_data[0]['vendor_name']; ?></div>
    											<div class="col text-right" style="float-right;"><?php echo date('d/m/Y',strtotime($purchase_data[0]['bill_date'])); ?></div>
    										</div>
    										<div style="text-align: center;">
                        						<p><u>PURCHASE BILL</u>
                        						<br/><b><?php echo $company_info[0]['comany_name']; ?></b>
                        						<br/><?php echo $company_info[0]['address']; ?></p>
                        					</div>
										</td>
									</tr>
									
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
        							<table border="1" width="100%" style="border-collapse: collapse;">
        								<tr>
        									<th>S.No.</th>
        									<th>Product Name</th>
        									<th>Product Code</th>
        									<th>Qunatity</th>
        									<th>Unit</th>
        									<th>PPU</th>
        									<th>Total</th>
        								</tr>
        								<?php $c=1; foreach($bill_detail as $bilitem){?>
        									<tr>
        									<td><?php echo $c++; ?></td>
        									<td><?php echo $bilitem['productname'];?></td>
        									<td><?php echo $bilitem['productcode']; ?></td>
        									<td><?php echo $bilitem['qty']; ?></td>
        									<td><?php echo $bilitem['unitname']; ?></td>
        									<td><?php echo $bilitem['perunit_price']; ?></td>
        									<td><?php echo $bilitem['product_total_amount']; ?></td>
        								</tr>
        								<?php } ?>
        								<tr>
        									<td colspan="6" style="text-align: right;">Total</td>
        									<td><?php echo $purchase_data[0]['product_total_amount']; ?></td>
        								</tr>
        								<tr>
        									<td colspan="6" style="text-align: right;">Discount Amount</td>
        									<td><?php echo $purchase_data[0]['discount']; ?></td>
        								</tr>
        								<tr>
        									<td colspan="6" style="text-align: right;">GST Amount</td>
        									<td><?php echo $purchase_data[0]['gst_amount']; ?></td>
        								</tr>
        								<tr>
        									<td colspan="6" style="text-align: right;">Payable Amount</td>
        									<td><?php echo $purchase_data[0]['grandtotal_amount']; ?></td>
        								</tr>
        							</table>
							</td>	
						</tr>
					</table>
					
					
					                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php if(isset($copyright)){ print_r($copyright);} ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <script>
        $(document).ready( function () {
        	var baseUrl = $('#baseurl').val();
        	
        });
    </script>
    </body>
</html>
    


