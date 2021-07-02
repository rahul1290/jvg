
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">JVG</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-truck-moving"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Masters
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link <?php echo $this->uri->segment('1')== 'master'? '' : 'collapsed';?>" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Master</span>
                </a>
                <div id="collapseTwo" class="collapse <?php echo $this->uri->segment('1')== 'master'? 'show' : '';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-primary py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if($this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'vendor'){ echo 'active'; }?>" href="<?php echo base_url('master/vendor'); ?>">Vendor</a>
                        <a class="collapse-item <?php if($this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'user'){ echo 'active'; }?>" href="<?php echo base_url('master/user'); ?>">User</a>
                        <a class="collapse-item <?php if($this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'product'){ echo 'active'; }?>" href="<?php echo base_url('master/product'); ?>">Product</a>
                        <a class="collapse-item <?php if($this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'customer'){ echo 'active'; }?>" href="<?php echo base_url('master/customer'); ?>">Customer</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                transaction
            </div>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link <?php echo $this->uri->segment(1) == 'purchase'? '':'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapsethree"
                    aria-expanded="true" aria-controls="collapsethree">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Purchase</span>
                </a>
                <div id="collapsethree" class="collapse <?php echo $this->uri->segment(1) == 'purchase'? 'show':''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-primary py-2 collapse-inner rounded">
                        <a class="collapse-item <?php
                        echo ($this->uri->segment(1) == 'purchase' && ($this->uri->segment(2) == '')) ? 'active':'';
                        ?>" href="<?php echo base_url('purchase');?>">New Purchase</a>
                        
                        <a class="collapse-item <?php
                        echo ($this->uri->segment(1) == 'purchase' && ($this->uri->segment(2) == 'list')) ? 'active':'';
                        ?>" href="<?php echo base_url('purchase/list');?>">Purchase List</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Sales</span></a>
            </li>
			
			<!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Report
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('purchase');?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Stock List</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Sales</span></a>
            </li>
			
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->