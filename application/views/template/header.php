<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="<?= base_url() ?>">
                <!-- Logo icon -->
                <b class="logo-icon display-7">
                    JM
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="<?= base_url()  ?>assets/material-pro/images/logo-icon.png" alt="homepage" class="dark-logo" /> -->
                    <!-- Light Logo icon -->
                    <!-- <img src="<?= base_url()  ?>assets/material-pro/images/logo-light-icon.png" alt="homepage" class="light-logo" /> -->
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text display-7">
                    DEPO
                    <!-- dark Logo text -->
                    <!-- <img src="<?= base_url()  ?>assets/material-pro/images/logo-text.png" alt="homepage" class="dark-logo" /> -->
                    <!-- Light Logo text -->
                    <!-- <img src="<?= base_url()  ?>assets/material-pro/images/logo-light-text.png" class="light-logo" alt="homepage" /> -->
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto float-left">
                <!-- This is  -->
                <li class="nav-item"> 
                    <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-menu"></i></a> 
                </li>
                <li class="nav-item d-none d-md-block search-box"> 
                    <a class="nav-link d-none d-md-block waves-effect waves-dark" href="javascript:void(0)">
                        <span id="date-part"></span>&nbsp;~&nbsp;<span id="time-part"></span>
                    </a>
                    
                </li>
                
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="<?= base_url()  ?>assets/material-pro/images/users/1.jpg" alt="user" width="30" class="profile-pic rounded-circle" />
                    </a>
                    <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                        <ul class="dropdown-user list-style-none" style="z-index: 999;">
                            <li>
                                <div class="dw-user-box p-3 d-flex">
                                    <div class="u-img"><img src="<?= base_url()  ?>assets/material-pro/images/users/1.jpg" alt="user" class="rounded" width="80"></div>
                                    <div class="u-text ml-2">
                                        <h4 class="mb-0"><?= ucwords($this->session->userdata('username'));?></h4>
                                        <p class="text-muted mb-1 font-14"><?= ucwords($this->session->userdata('username'));?></p>
                                        <!-- <a href="#" class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">View
                                            Profile</a> -->
                                    </div>
                                </div>
                            </li>
                            <!-- <li role="separator" class="dropdown-divider"></li>
                            <li class="user-list"><a class="px-3 py-2" href="#"><i class="ti-settings"></i> Account Setting</a></li> -->
                            <li role="separator" class="dropdown-divider"></li>
                            <li class="user-list"><a class="px-3 py-2" href="<?= base_url('auth/out') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script>
    $(document).ready(function () {

        var interval = setInterval(function() {
        var momentNow = moment();
            $('#date-part').html(momentNow.format('dddd')
                                .toUpperCase() + ', ' +
                                momentNow.format('DD MMMM YYYY')
                                );
            $('#time-part').html(momentNow.format('HH:mm:ss'));
        }, 100);
        
    })
</script>