<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

    // 16-10-2020
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
    }

    // 16-10-2020
    public function index()
    {
       $data = ['title' => 'Jenis'];
       
       $this->template->load('template/index', 'jenis/lihat', $data);
    }

    // 16-10-2020
    // menampilkan list jenis 
    public function tampil_data_jenis()
    {
        $list = $this->jenis->get_data_jenis();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['jenis'];
            $tbody[]    = "Rp. ".number_format($o['diskon'],0,'.','.');
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-info edit-jenis' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."'><i class='fa fa-pencil-alt'></i></span><span style='cursor:pointer' class='text-danger hapus-jenis' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' jenis='".$o['jenis']."'><i class='fa fa-trash-alt'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->jenis->jumlah_semua_jenis(),
                    "recordsFiltered"  => $this->jenis->jumlah_filter_jenis(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 16-10-2020
    // aksi proses simpan data jenis
    public function simpan_data_jenis()
    {
        $aksi       = $this->input->post('aksi');
        $id_jenis   = $this->input->post('id_jenis');
        $jenis      = $this->input->post('nama_jenis');
        $diskon     = str_replace(".","",$this->input->post('diskon'));

        $data = ['jenis'        => $jenis,
                 'diskon'       => $diskon,
                 'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->kategori->input_data('mst_jenis', $data);
        } elseif ($aksi == 'Ubah') {
            $this->kategori->ubah_data('mst_jenis', $data, array('id' => $id_jenis));
        } elseif ($aksi == 'Hapus') {
            $this->kategori->hapus_data('mst_jenis', array('id' => $id_jenis));
        }

        echo json_encode($aksi);
    }

    // 16-10-2020
    // ambil data jenis
    public function ambil_data_jenis($id_jenis)
    {
        $data = $this->kategori->cari_data('mst_jenis', array("id" => $id_jenis))->row_array();

        echo json_encode($data);
    }

}

/* End of file Jenis.php */
