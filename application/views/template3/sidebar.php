<div class="vertical-menu">

    <div class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <?php if ($this->session->userdata('role') == 2) {
                $hid = '';
            } else {
                $hid = 'hidden';
            }?>

            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled mt-3" id="side-menu" style="margin-left: 20px;">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?= base_url('dashboard') ?>" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="<?= ($title == 'Produk') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('produk') ?>" class=" waves-effect <?= ($title == 'Produk') ? 'active' : '' ?>">
                        <i class="mdi mdi-collage"></i>
                        <span>Produk</span>
                    </a>
                </li>

                <li <?= $hid ?>>
                    <a href="<?= base_url('merk') ?>" class=" waves-effect">
                        <i class="mdi mdi-codepen"></i>
                        <span>Merk</span>
                    </a>
                </li>

                <li <?= $hid ?>>
                    <a href="<?= base_url('kategori') ?>" class=" waves-effect">
                        <i class="mdi mdi-google-circles-extended"></i>
                        <span>Kategori</span>
                    </a>
                </li>

                <li <?= $hid ?>>
                    <a href="<?= base_url('bahan') ?>" class=" waves-effect">
                        <i class="mdi mdi-cube"></i>
                        <span>Bahan</span>
                    </a>
                </li>

                <li <?= $hid ?>>
                    <a href="<?= base_url('pelanggan') ?>" class=" waves-effect">
                        <i class="mdi mdi-account-card-details"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>

                <li <?= $hid ?>>
                    <a href="<?= base_url('user') ?>" class=" waves-effect">
                        <i class="mdi mdi-account-multiple"></i>
                        <span>User</span>
                    </a>
                </li>


                <li class="menu-title">Transaksi</li>

                <?php 
                    $hbs = $this->session->userdata('stok_habis');
                    
                    if ($hbs == 0) {
                        $hid_h = 'hidden';
                    } else {
                        $hid_h = '';
                    }
                ?>

                <li <?= $hid ?>>
                    <a href="<?= base_url('stok') ?>" class=" waves-effect">
                        <i class="mdi mdi-google-circles-group"></i>
                        <span class="badge badge-pill float-right b_stok_habis" style="background-color: red; color: white;" <?= $hid_h ?>><?= $this->session->userdata('stok_habis'); ?></span>
                        <span>Stok</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('transaksi') ?>" class=" waves-effect">
                        <i class="mdi mdi-tag-text-outline"></i>
                        <span>Transaksi</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('piutang') ?>" class=" waves-effect">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span>Piutang</span>
                    </a>
                </li>

                <li class="menu-title">Report</li>

                <li>
                    <a href="<?= base_url('report') ?>" class=" waves-effect">
                        <i class="mdi mdi-file-document"></i>
                        <span>Report</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>