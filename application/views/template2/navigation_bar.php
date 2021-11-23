<body class="layout-default">
    <div class="preloader"></div>

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px" data-fullbleed>
        <div class="mdk-drawer-layout__content">

            <!-- Header Layout -->
            <div class="mdk-header-layout js-mdk-header-layout" data-has-scrolling-region>

                <!-- Header -->

                <div id="header" class="mdk-header js-mdk-header m-0" data-fixed data-effects="waterfall" data-retarget-mouse-scroll="false">
                    <div class="mdk-header__content">

                        <div class="navbar navbar-expand-sm navbar-main navbar-light bg-dark pr-0" id="navbar" data-primary>
                            <div class="container-fluid p-0">

                                <!-- Navbar toggler -->
                                <button class="navbar-toggler navbar-toggler-custom d-lg-none d-flex mr-navbar" type="button" data-toggle="sidebar">
                                    <span class="material-icons">short_text</span>
                                </button>

                                <!-- Navbar Brand -->
                                <div class="navbar-brand flex ">
                                    
								</div>

                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" data-caret="false" class="dropdown-toggle navbar-toggler navbar-toggler-company border-left d-flex align-items-center ml-navbar">
                                        <span class="rounded-circle " style="background:#299aff">
                                            <span class="material-icons">person</span>
                                        </span>
                                    </a>
                                    <div id="company_menu" class="dropdown-menu dropdown-menu-right navbar-company-menu">
                                        <div class="dropdown-item d-flex align-items-center py-2 navbar-company-info py-3">
                                            <span class="flex d-flex flex-column">
                                                <strong style="font-size: 1.125rem;"><?php echo ucfirst($this->session->userdata('username')); ?></strong>
                                            </span>

                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="<?php echo base_url('Auth/out') ?>">
                                            <span class="material-icons mr-2">power_settings_new</span> Log Out
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
