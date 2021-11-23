<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {

    // 12-10-2020

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
    }

    // 12-10-2020

    public function index()
    {
        $data = ['title'        => 'Piutang',
                 'list_nama'    => $this->piutang->cari_pelanggan()->result_array(),
                ];

        $this->template->load('template/index', 'piutang/lihat', $data);
    }

    // 12-10-2020
    public function tampil_data_piutang()
    {
        $list = $this->piutang->get_data_piutang();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['tot_piutang'] == 0) {
                $tt = "<span class='badge badge-success'>LUNAS</span>";
            } else {
                $tt = number_format($o['tot_piutang'],0,'.','.');
            }

            $hs = $this->bahan->cari_data('trn_bayar_piutang', ['id_pelanggan' => $o['id']])->row_array();

            if (count($hs) == 0) {
                $dis = 'disabled';
            } else {
                $dis = '';
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['pelanggan'];
            $tbody[]    = "<div align='right'>".$tt."</div>";
            $tbody[]    = "<button class='btn btn-sm btn-icon btn-warning text-white mr-2 detail-piutang' data-id='".$o['id']."' nama='".$o['pelanggan']."' $dis>History Bayar</button>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->piutang->jumlah_semua_piutang(),
                    "recordsFiltered"  => $this->piutang->jumlah_filter_piutang(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 12-10-2020
    public function tampil_data_detail_piutang()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        
        $list = $this->piutang->get_data_detail_piutang($id_pelanggan);

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = "<div align='center'>".nice_date($o['tanggal'], 'd M Y')."</div>";
            $tbody[]    = "<div align='right'>".number_format($o['bayar'],0,'.','.')."</div>";
            $tbody[]    = "<div align='right'>".number_format($o['sisa_piutang'],0,'.','.')."</div>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->piutang->jumlah_semua_detail_piutang($id_pelanggan),
                    "recordsFiltered"  => $this->piutang->jumlah_filter_detail_piutang($id_pelanggan),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 12-10-2020
    public function simpan_data_piutang()
    {
        $tgl_bayar      = date('Y-m-d', strtotime($this->input->post('tgl_bayar')));
        $id_pelanggan   = $this->input->post('id_pelanggan');
        $bayar          = str_replace('.','', $this->input->post('bayar'));
        $tot_piutang    = str_replace('.','', $this->input->post('tot_piutang'));

        $t_p = ($bayar) - ($tot_piutang);

        $sisa_piutang    = ($tot_piutang) - ($bayar);
        
        $data = ['id_pelanggan' => $id_pelanggan,
                 'tanggal'      => $tgl_bayar,
                 'bayar'        => $bayar,
                 'sisa_piutang'  => $sisa_piutang,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        // input trn bayar piutang
        $this->bahan->input_data('trn_bayar_piutang', $data);

        // ubah data tot piutang
        $this->bahan->ubah_data('mst_pelanggan', ['tot_piutang' => $sisa_piutang], ['id' => $id_pelanggan]);

        // cari data pelanggan
        $pl = $this->piutang->cari_pelanggan()->result_array();

        $option = "";

        $option = "<option value='' tot_piutang=''>Pilih Pelanggan</option>";

        foreach ($pl as $d) {
            $option .= "<option value='".$d['id']."' tot_piutang='".$d['tot_piutang']."'>".$d['pelanggan']."</option>";
        }

        echo json_encode(['status' => true, 'sisa_piutang' => $t_p, 'list_pl' => $option]);
    }

    // 12-10-2020
    public function ambil_list_pelanggan()
    {
        $pl = $this->piutang->cari_pelanggan()->result_array();

        $option = "";

        $option = "<option value='' tot_piutang=''>Pilih Pelanggan</option>";

        foreach ($pl as $d) {
            $option .= "<option value='".$d['id']."' tot_piutang='".$d['tot_piutang']."'>".$d['pelanggan']."</option>";
        }

        echo json_encode(['status' => true, 'list_pl' => $option]);

    }

}

/* End of file Piutang.php */
