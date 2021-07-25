<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- loader Modal-->
    <div class="modal fade" id="loadermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                	<i class="fas fa-circle-notch fa-spin"></i>
                	<p>please wait...</p>
                </div>
            </div>
        </div>
    </div>
<script>
	function indrupee_format(amount){
		console.log(amount);
		var x=amount;
		y = x.toString();
		const v= y.split('.');
		
		
		x = Math.trunc(v[0]);
		
        x = x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
            if(v.length > 1)
        		var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree +'.'+ v[1];
        	else
        		var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return res;
	}
</script>
<script src="<?php echo base_url('assest/');?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assest/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assest/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assest/');?>js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url('assest/');?>js/dataTables.min.js"></script>

<script src="<?php echo base_url('assest/');?>js/jszip.min.js"></script>
<script src="<?php echo base_url('assest/');?>js/pdfmake.min.js"></script>
<script src="<?php echo base_url('assest/');?>js/vfs_fonts.js"></script>
<script src="<?php echo base_url('assest/');?>js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assest/');?>js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assest/');?>js/dataTables.buttons.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assest/');?>css/jquery-ui.css" />
<script src="<?php echo base_url('assest/');?>js/jquery-ui.js"></script>
