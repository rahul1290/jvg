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
    											<div style="float:left">GSTIN : <?php echo $company_info[0]['gst_no']; ?></div>
    											<div style="float:right;">Original copy</div>
    										</div>
    										<div style="text-align: center;">
                        						<p><u>TAX INVOICE</u>
                        						<br/><b><?php echo $company_info[0]['comany_name']; ?></b>
                        						<br/><?php echo $company_info[0]['address']; ?></p>
                        					</div>
										</td>
									</tr>
									
								</table>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<table width="100%" style="border-collapse: collapse;">
									<tr>
										<td>Invoice No.</td>
										<td>: <?php echo $sales_data[0]['invoice_no']; ?></td>
									</tr>
									<tr>
										<td>Date of Invoice</td>
										<td>: <?php echo date('d M Y',strtotime($sales_data[0]['invoice_date'])); ?></td>
									</tr>
									<tr>
										<td>GR/RR No. & Date</td>
										<td>: <?php echo $sales_data[0]['GR/RRNo']; ?></td>
									</tr>
									<tr>
										<td>State of Supply</td>
										<td>: <?php echo $sales_data[0]['state_name']; ?></td>
									</tr>
								</table>
							</td>
							<td width="50%">
								<table width="100%" style="border-collapse: collapse;"	>
									<tr>
										<td>Transport</td>
										<td>: <?php echo $sales_data[0]['trasport']; ?></td>
									</tr>
									<tr>
										<td>Vechile No.</td>
										<td>: <?php echo $sales_data[0]['vehicle_no']; ?></td>
									</tr>
									<tr>
										<td>Eway Bill No.</td>
										<td>: <?php echo $sales_data[0]['eway_no']; ?></td>
									</tr>
									<tr>
										<td>Destination</td>
										<td>: <?php echo $sales_data[0]['destination']; ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><b>Billed To :</b><br/>
                                <?php echo $sales_data[0]['bill_address']; ?>
                            </td>
							<td><b>Shipped To:</b><br/>
								<?php echo $sales_data[0]['shipping_address']; ?>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table width="100%" border="1" style="border-collapse: collapse;">
									<tr>
										<td width="5%">S.No.</td>
										<td width="45%">Description of Goods</td>
										<td>HSN/SAC</td>
										<td>Quantity</td>
										<td>Unit</td>
										<td>Rate</td>
										<td>Amount</td>
									</tr>
									<?php $c=1; foreach($bill_detail as $bill){ ?>
									<tr>
										<td width="5%"><?php echo $c++; ?></td>
										<td width="45%"><?php echo $bill['product_name']; ?></td>
										<td>7207</td>
										<td><?php echo $bill['qty']; ?></td>
										<td><?php echo $bill['unit_name']; ?></td>
										<td><?php echo $bill['sales_per_unit']; ?></td>
										<td><?php echo $bill['sales_product_amount']; ?></td>
									</tr>
									<?php } ?>
									<tr>
										<td colspan="6" style="text-align: right;">Total</td>
										<td><?php echo $sales_data[0]['grand_total']; ?></td>
									</tr>
									
									<?php if($sales_data[0]['insurance'] != '0'){?>
										<tr>
    										<td colspan="6" style="text-align: right;">Insurance :</td>
    										<td><?php echo $sales_data[0]['insurance']; ?></td>
    									</tr>
									<?php } ?>
									<?php if($sales_data[0]['frieght '] != '0'){?>
										<tr>
    										<td colspan="6" style="text-align: right;">Frieght :</td>
    										<td><?php echo $sales_data[0]['frieght']; ?></td>
    									</tr>
									<?php } ?>
									<?php if($sales_data[0]['cgst_amount'] != '0'){?>
									<tr>
										<td colspan="6"style="text-align: right;">Add : CGST @ 9.00 %</td>
										<td><?php echo $sales_data[0]['cgst_amount']; ?></td>
									</tr>
									<?php } ?>
									<?php if($sales_data[0]['sgst_amount'] != '0'){?>
									<tr>
										<td colspan="6" style="text-align: right;">Add : SGST @ 9.00 %</td>
										<td><?php echo $sales_data[0]['sgst_amount'];?></td>
									</tr>
									<?php } ?>
									<?php if($sales_data[0]['igst_amount'] != '0'){?>
									<tr>
										<td colspan="6" style="text-align: right;">Add : IGST @ 9.00 %</td>
										<td><?php echo $sales_data[0]['igst_amount'];?></td>
									</tr>
									<?php } ?>
									<tr>
										<td colspan="6" style="text-align: right;">Grand Total :</td>
										<td><?php echo $sales_data[0]['grand_total'] + $sales_data[0]['total_tax_amount'];?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table>
									<tr>
										<td><u>Tax%</u>&nbsp;&nbsp;</td>
										<td><u>Taxable Amt.</u>&nbsp;&nbsp;</td>
										<td><u>CGST</u>&nbsp;&nbsp;</td>
										<td><u>SGST</u>&nbsp;&nbsp;</td>
										<td><u>Total Tax</u>&nbsp;&nbsp;</td>	
									</tr>
									<tr>
										<td>9%&nbsp;&nbsp;</td>
										<td><?php echo $sales_data[0]['grand_total'] + $sales_data[0]['insurance']; ?>&nbsp;&nbsp;</td>
										<td><?php echo $sales_data[0]['cgst_amount']; ?>&nbsp;&nbsp;</td>
										<td><?php echo $sales_data[0]['sgst_amount']; ?>&nbsp;&nbsp;</td>
										<td><?php echo $sales_data[0]['total_tax_amount']; ?>&nbsp;&nbsp;</td>	
									</tr>
									<tr>
										<td colspan="5">
											<?php $this->mylibrary->get_words(($sales_data[0]['grand_total'] + $sales_data[0]['total_tax_amount']))?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table>
									<tr>
										<td>Bank Details</td>
										<td>: Karnataka Bank Ltd., Raigarh Branch</td>
									</tr>
									<tr>
										<td>Account No.</td>
										<td>: 6 6 1 7 0 0 0 6 0 0 0 0 7 6 0 1</td>
									</tr>
									<tr>
										<td>IFSC Code</td>
										<td>: KARB0000661</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								Terms & Conditions<br/>
                                E. & O.E.<br/>
                                1. Goods once sold will not be taken back.<br/>
                                2. Interest @ 18% p.a. will be charged if the payement<br/>
                                is not made with in the stipulated time.<br/>
                                3. Subject to "Raigarh" Jurisdiction only.<br/>
							</td>
							<td style="text-align: center;">	
								<p>For <?php echo $company_info[0]['comany_name']; ?></p>
								<br/>
								Authorised Signatory	
							
							</td>
						</tr>
					</table>
					
					
					                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php if(isset($copyright)){ print_r($copyright); } ?>
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
    


