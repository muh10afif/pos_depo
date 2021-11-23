<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username') == "")
        {
            $this->session->set_flashdata('danger', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Anda belum Log in</div>');
            redirect(base_url(), 'refresh');
        }
    }

    // 06-07-2020

    public function index()
    {
        $data = ['title'    => 'Bahan',
                 'kategori' => $this->bahan->cari_data('mst_kategori', ['have_bahan' => 1])->result_array()
                ];

        $this->template->load('template/index', 'bahan/lihat', $data);
        
    }

    // menampilkan list bahan 
    public function tampil_data_bahan()
    {
        $list = $this->bahan->get_data_bahan();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['kategori'];
            $tbody[]    = $o['nama_bahan'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-info edit-bahan' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_bahan']."'><i class='fa fa-pencil-alt'></i></span><span style='cursor:pointer' class='text-danger hapus-bahan' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_bahan']."' bahan='".$o['nama_bahan']."'><i class='fa fa-trash-alt'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->bahan->jumlah_semua_bahan(),
                    "recordsFiltered"  => $this->bahan->jumlah_filter_bahan(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data bahan
    public function simpan_data_bahan()
    {
        $aksi               = $this->input->post('aksi');
        $id_bahan           = $this->input->post('id_bahan');
        $id_kategori        = $this->input->post('id_kategori');
        $bahan              = $this->input->post('nama_bahan');
        $kategori_baru      = $this->input->post('kategori_baru');
        $status_kategori    = $this->input->post('status_kategori');

        if ($status_kategori == 'baru') {

            $data_kat = ['kategori'     => $kategori_baru,
                         'have_bahan'   => 1,
                         'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                        ];
            
            $this->bahan->input_data('mst_kategori', $data_kat);
            $id_kategori = $this->db->insert_id();
            
        }

        $data = ['nama_bahan'   => $bahan,
                 'id_kategori'  => $id_kategori,
                 'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->bahan->input_data('mst_bahan', $data);
        } elseif ($aksi == 'Ubah') {
            $this->bahan->ubah_data('mst_bahan', $data, array('id' => $id_bahan));
        } elseif ($aksi == 'Hapus') {
            $this->bahan->hapus_data('mst_bahan', array('id' => $id_bahan));
        }

        echo json_encode($aksi);
    }

    // ambil data bahan
    public function ambil_data_bahan($id_bahan)
    {
        $data = $this->bahan->cari_data('mst_bahan', array("id" => $id_bahan))->row_array();

        echo json_encode($data);
    }

}

/* End of file Bahan.php */
