<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md">
                <div class="card card-stats">
                    <div class="d-flex align-items-center mb-2">
                        <div class="card-header__title flex">Transaksi Hari ini</div>
                        Rp. <?php echo number_format($pendapatan->pendapatan) ?> 
                        <!-- <span class="text-muted">&nbsp;/ $3,200</span> -->
                    </div>
<!--                     <div class="position-relative d-flex align-items-start z-0">
                        <div class="progress flex" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <i class="material-icons text-success bg-white position-absolute" style="right: -4px; top: -10px; z-index: 2;">check_box</i>
                    </div> -->
                </div>
            </div>
            <div class="col-md">
                <div class="card card-stats">
                    <div class="d-flex align-items-center mb-2">
                        <div class="card-header__title flex">Jumlah Produk</div>
                        <?php echo $stok->stok ?>
                        <!-- <strong class="text-primary">340</strong>&nbsp;/ 2,122 -->
                    </div>
                    <!-- <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                </div>
            </div>
            <!-- <div class="col-md">
                <div class="card card-stats">
                    <div class="d-flex align-items-center mb-2">
                        <div class="card-header__title flex">Pengeluaran Hari ini</div>
                        $1,395 <span class="text-muted">&nbsp;/ $8,210</span>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 17%;" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- // END header-layout__content -->

</div>
<!-- // END header-layout -->

</div>
<!-- // END drawer-layout__content -->