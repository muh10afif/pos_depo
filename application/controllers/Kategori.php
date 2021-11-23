<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    
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
        $data = ['title'    => 'Kategori',
                 'isi'      => 'kategori/lihat'
                ];

        $this->template->load('template/index','kategori/lihat', $data);
        
    }

    // menampilkan list kategori 
    public function tampil_data_kategori()
    {
        $list = $this->kategori->get_data_kategori();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['have_bahan'] == 1) {
                $st = "<span class='badge badge-success' style='font-size:12px'>Ya</span>";
            } else {
                $st = "<span class='badge badge-danger' style='font-size:12px'>Tidak</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['kategori'];
            // $tbody[]    = $st;
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-info edit-kategori' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."'><i class='fa fa-pencil-alt'></i></span><span style='cursor:pointer' class='text-danger hapus-kategori' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' kategori='".$o['kategori']."'><i class='fa fa-trash-alt'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->kategori->jumlah_semua_kategori(),
                    "recordsFiltered"  => $this->kategori->jumlah_filter_kategori(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data kategori
    public function simpan_data_kategori()
    {
        $aksi           = $this->input->post('aksi');
        $id_kategori    = $this->input->post('id_kategori');
        $kategori       = $this->input->post('nama_kategori');
        $have_bahan     = $this->input->post('have_bahan');

        $data = ['kategori'     => $kategori,
                 'have_bahan'   => '',
                 'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->kategori->input_data('mst_kategori', $data);
        } elseif ($aksi == 'Ubah') {
            $this->kategori->ubah_data('mst_kategori', $data, array('id' => $id_kategori));
        } elseif ($aksi == 'Hapus') {
            $this->kategori->hapus_data('mst_kategori', array('id' => $id_kategori));
        }

        echo json_encode($aksi);
    }

    // ambil data kategori
    public function ambil_data_kategori($id_kategori)
    {
        $data = $this->kategori->cari_data('mst_kategori', array("id" => $id_kategori))->row_array();

        echo json_encode($data);
    }

}

/* End of file Kategori.php */
