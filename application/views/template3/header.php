<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="<?= base_url() ?>assets/template_baru/assets/images/users/avatar-2.jpg" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ml-1"><?= ucwords($this->session->userdata('username'));?></span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <p class="dropdown-item"><i class="bx bx-user font-size-16 align-middle mr-2"></i><?= ucwords($this->session->userdata('username'));?></p>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="<?= base_url('auth/out') ?>"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                    </div>
                </div>

            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">

                    <a href="<?= base_url('dashboard') ?>" class="logo logo-light" style="margin-left: 20px;">
                        <span class="logo-sm">
                            <!-- <img src="<?= base_url() ?>assets/img/img.jpg" alt="" height="20"> -->
                        </span>
                        <span class="logo-lg">
                            <!-- <img src="<?= base_url() ?>assets/img/img.jpg" alt="" height="80"> -->
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

            </div>

        </div>
    </div>
</header> 