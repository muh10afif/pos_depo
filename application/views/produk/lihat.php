<div class="row">
    <?php foreach ($kategori as $k): 
        
        if ($k['jml'] == 0) {
            $class = '';
            $color = "background-color: red; color: white;";
        } else {
            $class = 'badge-success';
            $color = "";
        }

        ?>
        <div class="col-lg-4">
            <div class="card card-body card-hover">
                <div class="row p-3">
                    <div class="col-md-6">
                        <h3 class="card-text"><?= $k['kategori'] ?></h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <h2><span class="badge badge-success"><?= $k['jml'] ?></span></h2>
                    </div>
                </div>
                <a href="<?= base_url('produk/detail/'.$k['id']) ?>" class="btn btn-primary waves-effect waves-light mt-1 btn_lihat" id_kategori="<?= $k['id'] ?>" type="button">
                <span id="lihat<?= $k['id'] ?>"><i class="ti-arrow-right mr-1"></i> Lihat</span>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    $(document).ready(function () {

        
        
    })
</script>