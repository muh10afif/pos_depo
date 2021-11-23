<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

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
        $data = ['title'    => 'Pelanggan',
                 'jenis'    => $this->bahan->get_data_order('mst_jenis', 'jenis', 'asc')->result_array()
                ];

        $this->template->load('template/index', 'pelanggan/lihat', $data);
        
    }

    // menampilkan list pelanggan 
    public function tampil_data_pelanggan()
    {
        $list = $this->pelanggan->get_data_pelanggan();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['pelanggan'];
            $tbody[]    = $o['no_telp'];
            $tbody[]    = $o['alamat'];
            // $tbody[]    = $o['jenis'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-info edit-pelanggan' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."'><i class='fa fa-pencil-alt'></i></span><span style='cursor:pointer' class='text-danger hapus-pelanggan' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' pelanggan='".$o['pelanggan']."'><i class='fa fa-trash-alt'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->pelanggan->jumlah_semua_pelanggan(),
                    "recordsFiltered"  => $this->pelanggan->jumlah_filter_pelanggan(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data pelanggan
    public function simpan_data_pelanggan()
    {
        $aksi           = $this->input->post('aksi');
        $id_pelanggan   = $this->input->post('id_pelanggan');
        $no_telp        = $this->input->post('no_telp');
        $pelanggan      = $this->input->post('nama_pelanggan');
        $alamat         = $this->input->post('alamat');
        $jenis          = $this->input->post('jenis');
        $jenis_baru     = $this->input->post('jenis_baru');
        $diskon         = str_replace(".","",$this->input->post('diskon'));
        $status_jenis   = $this->input->post('status_jenis');

        if ($aksi != 'Hapus') {
            if ($status_jenis == 'lama') {

                $id_jenis   = $jenis;
                
            } else {

                $dt_jenis = ['jenis'        => $jenis_baru,
                            'diskon'       => $diskon,
                            'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                            ];

                $this->bahan->input_data('mst_jenis', $dt_jenis);
                $id_jenis   = $this->db->insert_id();

            }
        }

        $data = ['pelanggan'    => $pelanggan,
                 'no_telp'      => $no_telp,
                 'alamat'       => $alamat,
                 'jenis'        => $id_jenis,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->bahan->input_data('mst_pelanggan', $data);
        } elseif ($aksi == 'Ubah') {
            $this->bahan->ubah_data('mst_pelanggan', $data, array('id' => $id_pelanggan));
        } elseif ($aksi == 'Hapus') {
            $this->bahan->hapus_data('mst_pelanggan', array('id' => $id_pelanggan));
        }

        echo json_encode($aksi);
    }

    // ambil data pelanggan
    public function ambil_data_pelanggan($id_pelanggan)
    {
        $data = $this->bahan->cari_data('mst_pelanggan', array("id" => $id_pelanggan))->row_array();

        $data2 = $this->bahan->get_data_order('mst_jenis', 'jenis', 'asc')->result_array();

        $option = "<option value=''>Pilih Jenis</option>";

        foreach ($data2 as $d) {
            $option .= "<option value='".$d['id']."'>".$d['jenis']."</option>";
        }

        echo json_encode(['dt' => $data, 'option' => $option]);
    }

    // 16-10-2020
    public function ambil_option_jenis()
    {
        $data2 = $this->bahan->get_data_order('mst_jenis', 'jenis', 'asc')->result_array();

        $option = "<option value=''>Pilih Jenis</option>";

        foreach ($data2 as $d) {
            $option .= "<option value='".$d['id']."'>".$d['jenis']."</option>";
        }

        echo json_encode(['option' => $option]);
    }

}

/* End of file Pelanggan.php */
