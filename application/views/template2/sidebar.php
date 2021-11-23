<div class="mdk-drawer js-mdk-drawer" id="default-drawer" style="background:white !important;" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark sidebar-left simplebar" data-simplebar>
            <div class="d-flex align-items-center sidebar-p-a border-bottom sidebar-account flex-shrink-0">
                <a href="javascript:void(0)" class="flex d-flex align-items-center text-underline-0 text-body">
                    <span class="mr-3">
						 <img src="<?php echo base_url('/assets/img/bannerlogo.png') ?>" alt="Logobanner" height="75" >
                    </span>
                </a>
            </div>
            <ul class="sidebar-menu flex">
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Dashboard' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url() ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Produk' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#menu_produk">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">view_stream</i>
                        <span class="sidebar-menu-text">Produk</span>
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse" id="menu_produk">
                        <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Produk' && $this->uri->segment(2) == null ? 'active' : null ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('Produk') ?>">
                                <span class="sidebar-menu-text">List Produk</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item <?php echo $this->uri->segment(2) == 'input' ? 'active' : null ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('Produk/input') ?>">
                                <span class="sidebar-menu-text">Input Produk</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Stok' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url('Stok') ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">format_list_numbered</i>
                        <span class="sidebar-menu-text">Stok</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Merk' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url('Merk') ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">new_releases</i>
                        <span class="sidebar-menu-text">Merk</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Kategori' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url('Kategori') ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">call_to_action</i>
                        <span class="sidebar-menu-text">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Bahan' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url('Bahan') ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">apps</i>
                        <span class="sidebar-menu-text">Bahan</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Transaksi' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url('Transaksi') ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">toll</i>
                        <span class="sidebar-menu-text">Transaksi</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Report' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url('Report') ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                        <span class="sidebar-menu-text">Report</span>
                    </a>
                </li>
                <!-- <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Report' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#menu_report">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                        <span class="sidebar-menu-text">Report</span>
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse" id="menu_report">
                        <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'Report' && $this->uri->segment(2) == null ? 'active' : null ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('Report') ?>">
                                <span class="sidebar-menu-text">Transaksi</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item <?php echo $this->uri->segment(2) == 'stok' ? 'active' : null ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('Report/stok') ?>">
                                <span class="sidebar-menu-text">Stok</span>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li class="sidebar-menu-item <?php echo $this->uri->segment(1) == 'User' ? 'active' : null ?>">
                    <a class="sidebar-menu-button" href="<?php echo base_url('User') ?>">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
                        <span class="sidebar-menu-text">User</span>
                    </a>
                </li>
            </ul>
            <div class="mt-auto sidebar-p-a sidebar-b-t d-flex flex-column flex-shrink-0">
                ©<?php echo date('Y') ?> Bagja Indonesia
            </div>
        </div>
    </div>
</div>
</div>
