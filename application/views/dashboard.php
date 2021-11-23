<!-- start page title -->
<!-- <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18"><?= $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Hegarmanah</li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div>

        </div>
    </div>
</div> -->
<!-- end page title -->

<div class="row">
    
    <div class="col-sm-12 col-md-4">
        <div class="card bg-primary shadow card-hover">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg text-primary d-inline-block text-center rounded-circle bg-light">
                        <i class="ti-medall"></i>
                    </div>
                    <div class="ml-2 align-self-center">
                        <h3 class="mb-0 font-weight-bold text-white"><?= $jml_tr ?></h3>
                        <h4 class="mb-0 text-white">Transaksi</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-12 col-md-4">

        <div class="card bg-danger shadow card-hover">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg text-danger d-inline-block text-center rounded-circle bg-light">
                        <i class="ti-harddrive"></i>
                    </div>
                    <div class="ml-2 align-self-center">
                        <h3 class="mb-0 font-weight-bold text-white"><?= ($jml_produk['jumlah']) ? $jml_produk['jumlah'] : 0 ?></h3>
                        <h4 class="mb-0 text-white">Produk</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-12 col-md-4">

        <div class="card bg-info shadow card-hover">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg text-info d-inline-block text-center rounded-circle bg-light">
                        <i class="ti-wallet"></i>
                    </div>
                    <div class="ml-2 align-self-center">
                        <h3 class="mb-0 font-weight-bold text-white">Rp. <?= number_format($pendapatan,0,'.','.') ?></h3>
                        <h4 class="mb-0 text-white">Pendapatan</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- <div class="col-sm-12 col-md-6">
        <div class="card bg-info">
            <div class="card-body text-white">
                <div class="d-flex flex-row">
                    <div class="align-self-center display-6"><i class="ti-money mr-2"></i></div>
                    <div class="p-2 align-self-center">
                        <h4 class="mb-0 text-white">Profit</h4>
                    </div>
                    <div class="ml-auto align-self-center">
                        <h2 class="font-weight-medium mb-0 text-white">Rp. <?= number_format($pendapatan - $hpp,0,'.','.') ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<!-- end row -->
