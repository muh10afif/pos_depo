<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {

    // 20-10-2020
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
    }

    // 20-10-2020
    public function index()
    {
        $data = ['title'        => 'Hutang',
                 'list_nama'    => $this->hutang->cari_pelanggan()->result_array(),
                ];

        $this->template->load('template/index', 'hutang/lihat', $data);
    }

    // 20-10-2020
    public function tampil_data_hutang()
    {
        $list = $this->hutang->get_data_hutang();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['tot_hutang'] == 0) {
                $tt = "<span class='badge badge-success'>LUNAS</span>";
            } else {
                $tt = number_format($o['tot_hutang'],0,'.','.');
            }

            $hs = $this->bahan->cari_data('trn_bayar_hutang', ['id_pelanggan' => $o['id']])->row_array();

            if (count($hs) == 0) {
                $dis = 'disabled';
            } else {
                $dis = '';
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['pelanggan'];
            $tbody[]    = "<div align='right'>".$tt."</div>";
            $tbody[]    = "<button class='btn btn-sm btn-icon btn-warning text-white mr-2 detail-hutang' data-id='".$o['id']."' nama='".$o['pelanggan']."' $dis>History Bayar</button>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->hutang->jumlah_semua_hutang(),
                    "recordsFiltered"  => $this->hutang->jumlah_filter_hutang(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 12-10-2020
    public function tampil_data_detail_hutang()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        
        $list = $this->hutang->get_data_detail_hutang($id_pelanggan);

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = "<div align='center'>".nice_date($o['tanggal'], 'd M Y')."</div>";
            $tbody[]    = "<div align='right'>".number_format($o['bayar'],0,'.','.')."</div>";
            $tbody[]    = "<div align='right'>".number_format($o['sisa_hutang'],0,'.','.')."</div>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->hutang->jumlah_semua_detail_hutang($id_pelanggan),
                    "recordsFiltered"  => $this->hutang->jumlah_filter_detail_hutang($id_pelanggan),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 12-10-2020
    public function simpan_data_hutang()
    {
        $tgl_bayar      = date('Y-m-d', strtotime($this->input->post('tgl_bayar')));
        $id_pelanggan   = $this->input->post('id_pelanggan');
        $bayar          = str_replace('.','', $this->input->post('bayar'));
        $tot_hutang     = str_replace('.','', $this->input->post('tot_hutang'));

        $t_p = ($bayar) - ($tot_hutang);

        $sisa_hutang    = ($tot_hutang) - ($bayar);
        
        $data = ['id_pelanggan' => $id_pelanggan,
                 'tanggal'      => $tgl_bayar,
                 'bayar'        => $bayar,
                 'sisa_hutang'  => $sisa_hutang,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        // input trn bayar hutang
        $this->bahan->input_data('trn_bayar_hutang', $data);

        // ubah data tot hutang
        $this->bahan->ubah_data('mst_pelanggan', ['tot_hutang' => $sisa_hutang], ['id' => $id_pelanggan]);

        // cari data pelanggan
        $pl = $this->hutang->cari_pelanggan_2()->result_array();

        $option = "";

        $option = "<option value='' tot_hutang=''>Pilih Pelanggan</option>";

        foreach ($pl as $d) {
            $option .= "<option value='".$d['id']."' tot_hutang='".$d['tot_hutang']."'>".$d['pelanggan']."</option>";
        }

        echo json_encode(['status' => true, 'sisa_hutang' => $t_p, 'list_pl' => $option]);
    }

    // 12-10-2020
    public function ambil_list_pelanggan()
    {
        $pl = $this->hutang->cari_pelanggan_2()->result_array();

        $option = "";

        $option = "<option value='' tot_hutang=''>Pilih Pelanggan</option>";

        foreach ($pl as $d) {
            $option .= "<option value='".$d['id']."' tot_hutang='".$d['tot_hutang']."'>".$d['pelanggan']."</option>";
        }

        echo json_encode(['status' => true, 'list_pl' => $option]);

    }


}

/* End of file Hutang.php */
