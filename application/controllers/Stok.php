<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            $this->session->set_flashdata('danger', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Anda belum Log in</div>');
            redirect(base_url(), 'refresh');
        }
    }
    
    public function tes()
    {
        print(chr(72).chr(101).chr(108).chr(108).chr(111)."\n");
        print(ord("H")."\n");
    }

	public function index()
	{
        $habis  = $this->stok->get_stok_habis();
        $ada    = $this->stok->get_stok_ada();

        $array = array(
            'stok_habis' => $habis
        );
        
        $this->session->set_userdata( $array );

		$data 	= [
			'title'		    => 'Stok',
			'produk'	    => $this->produk->get()->result(),
            'stok'          => $this->stok->get()->result(),
            'produk'        => $this->stok->get_produk_stok()->result_array(),
            'stok_habis'    => $this->stok->get_stok_habis(),
            't_habis'       => $habis,
            't_ada'         => $ada,
            'list_nama'     => $this->kategori->get_data_order('mst_pelanggan', 'pelanggan', 'asc')->result_array()
        ];
        
        $this->template->load('template/index','stok/read', $data);
    }
    
    // 02-10-2020

    // menampilkan list stok 
    public function tampil_data_stok()
    {
        $list = $this->stok->get_data_stok();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_product'];
            $tbody[]    = "<code class='text-info' style='font-size:17px'>".$o['stok']."</code>";
            $tbody[]    = "<span style='cursor:pointer' class='text-success detail-stok' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' produk='".$o['nama_product']."' tot_masuk='".$o['tot_masuk']."' tot_keluar='".$o['tot_keluar']."' tot_retur='".$o['tot_retur']."' stok='".$o['stok']."'><i class='mdi mdi-information-outline mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->stok->jumlah_semua_stok(),
                    "recordsFiltered"  => $this->stok->jumlah_filter_stok(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 03-10-2020
    public function tampil_data_detail()
    {
        $list = $this->stok->get_data_stok_detail();

        $data = array();

        $no   = $this->input->post('start');

        $st = $this->bahan->cari_data('mst_stok', ['id' => $this->input->post('id_stok')])->row_array();

        $stok = $st['stok'];
        foreach ($list as $o) {
            $no++;
            $tbody = array();
            
            // $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['barang_masuk'];
            $tbody[]    = $o['barang_keluar'];
            $tbody[]    = $o['barang_retur'];
            $tbody[]    = $stok;
            $tbody[]    = nice_date($o['created_at'], 'd-M-Y H:i:s');
            $data[]     = $tbody;

            if ($o['barang_masuk'] == 0) {
                $stok = $stok + ($o['barang_keluar'] + $o['barang_retur']);
            } else {
                $stok = $stok - $o['barang_masuk'];
            }

        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->stok->jumlah_semua_stok_detail(),
                    "recordsFiltered"  => $this->stok->jumlah_filter_stok_detail(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 03-10-2020

    public function simpan_data_stok()
    {
        $aksi           = $this->input->post('aksi');
        $produk         = $this->input->post('produk');
        $nilai_stok     = $this->input->post('nilai_stok');
        $total_stok     = $this->input->post('total_stok');
        $id_stok        = $this->input->post('id_stok');

        $id_pelanggan   = $this->input->post('id_pelanggan');
        $total_hutang   = str_replace(".", "", $this->input->post('total_hutang'));
        $status_hutang  = $this->input->post('status_hutang');

        if ($aksi == 'Tambah') {
            $dt_stok  = [
                'id_stok'           => $id_stok,
                'barang_masuk'      => $nilai_stok,
                'barang_keluar'     => 0,
                'barang_retur'      => 0,
                'created_at'   	    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
            ];
        } else {
            $dt_stok  = [
                'id_stok'           => $id_stok,
                'barang_masuk'      => 0,
                'barang_keluar'     => 0,
                'barang_retur'      => $nilai_stok,
                'created_at'   	    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
            ];
        }

        $this->bahan->input_data('trn_stok', $dt_stok);
        $id_trn_stok = $this->db->insert_id();

        if ($aksi == 'Tambah') {
            if ($status_hutang == 'ya') {

                $dt_hutang = ['id_pelanggan'    => $id_pelanggan,
                              'id_trn_stok'     => $id_trn_stok,
                              'hutang'          => $total_hutang,
                              'status'          => 0,
                              'created_at'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                             ];

                $this->bahan->input_data('trn_hutang', $dt_hutang);

                $cr = $this->bahan->cari_data('mst_pelanggan', ['id' => $id_pelanggan])->row_array();

                $sisa_hutang = $cr['tot_hutang'] + $total_hutang;

                $this->bahan->ubah_data('mst_pelanggan', ['tot_hutang' => $sisa_hutang], ['id' => $id_pelanggan]);

                // if ($cr['tot_hutang'] == 0) {
                    
                //     $data_byr_h = [ 'id_pelanggan' => $id_pelanggan,
                //                     'tanggal'      => date("Y-m-d", now('Asia/Jakarta')),
                //                     'bayar'        => 0,
                //                     'sisa_hutang'  => $sisa_hutang,
                //                     'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                //                   ];

                //     $this->bahan->input_data('trn_bayar_hutang', $data_byr_h);    
                    
                // }
                
            }
        }
        
        $this->bahan->ubah_data('mst_stok', ['stok' => $total_stok], ['id' => $id_stok]);

        $pro = $this->stok->get_produk_stok()->result_array();

        $option = "<option value=''>Pilih Produk</option>";

        foreach ($pro as $a) {
            $option .= "<option value='".$a['id']."' stok='".$a['stok']."' id_stok='".$a['id_stok']."'>".$a['nama_product']."</option>";
        }

        $habis  = $this->stok->get_stok_habis();
        $ada    = $this->stok->get_stok_ada();

        $array = array(
            'stok_habis' => $habis
        );
        
        $this->session->set_userdata( $array );

        echo json_encode(['status' => true, 'option' => $option, 'stok_habis' => $habis, 'stok_ada' => $ada]);
        
    }

    // 06-10-2020

    public function download_file()
    {
        $id_stok   	= $this->input->post('id_stok_report');
        $nm_produk 	= $this->input->post('nama_produk_report');
        $jns        = $this->input->post('jns');

        $brg        = $this->stok->get_tot_barang($id_stok)->row_array();

        $data   = [ 'report'        => 'Report Stok',
                    'nm_produk'     => $nm_produk,
                    'brg_masuk'     => $brg['tot_masuk'],
                    'brg_keluar'    => $brg['tot_keluar'],
                    'brg_retur'     => $brg['tot_retur'],
                    'stok'          => $brg['stok'],
                    'jns'           => $jns,
					'judul'         => 'Report Stok',
                    'trn'        	=> $this->stok->get_report_stok($id_stok)->result_array()
                  ]; 

        if ($jns == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", 'stok/V_export_stok', $data);

        } else {

            ob_start();
            $this->load->view('stok/V_export_stok', $data);
            $html = ob_get_contents();
            // var_dump($html);die();
                ob_end_clean();
				require_once('./assets/html2pdf/html2pdf.class.php');
				
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
			$pdf->WriteHTML($html);
			
			$pdf->Output('LaporanStok.pdf', 'FI');

        } 
    }

	public function read()
	{
		$list 	= $this->stok->read();
		$data 	= [];
		$no		= 1;
		foreach($list as $stok)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= $stok->nama_product;
            $row[]	= $stok->stok.' Unit';
            $row[]  = '<a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#detail'.$stok->id.'"><i class="fa fa-info-circle"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" => $this->stok->count_all(),
                    "recordsFiltered" => $this->stok->count_filtered(),
                    "data" => $data,
		          ];
        echo json_encode($output);
	}

	public function add_stock()
    {
        $this->_validate();
        $stok           = 0;
        $mst_stok       = $this->stok->get_stok($this->input->post('id_product'));
        $data_trn_stok  = [
        			'id_stok'           => $mst_stok->id,
                    'barang_masuk'      => $this->input->post('stok'),
                    'barang_keluar'     => 0,
                    'barang_retur'      => 0,
                    'created_at'   	    => date("Y-m-d h:i:s", now('Asia/Jakarta'))
                ];
        $this->stok->add_stok($data_trn_stok);
        $trn_stok       = $this->stok->get_trn_stok($mst_stok->id);
        foreach ($trn_stok as $row) 
        {
            $stok       += ($row->barang_masuk - ($row->barang_keluar + $row->barang_retur));
        }
        $data_mst_stok  = [
            'stok'      => $stok
        ];
        $this->stok->update(['id' => $mst_stok->id], $data_mst_stok);
        echo json_encode(array("status" => TRUE));
    }

    function return_stock()
    {
        $this->_validate_return();
        $stok           = 0;
        $mst_stok       = $this->stok->get_stok($this->input->post('id_product'));
        $data_trn_stok  = [
                    'id_stok'           => $mst_stok->id,
                    'barang_masuk'      => 0,
                    'barang_keluar'     => 0,
                    'barang_retur'      => $this->input->post('stok'),
                    'created_at'        => date("Y-m-d h:i:s", now('Asia/Jakarta'))
                ];
        $this->stok->add_stok($data_trn_stok);
        $trn_stok       = $this->stok->get_trn_stok($mst_stok->id);
        foreach ($trn_stok as $row) 
        {
            $stok       += ($row->barang_masuk - ($row->barang_keluar + $row->barang_retur));
        }
        $data_mst_stok  = [
            'stok'      => $stok
        ];
        $this->stok->update(['id' => $mst_stok->id], $data_mst_stok);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('id_product') == '')
        {
            $data['inputerror'][] = 'id_product';
            $data['error_string'][] = 'Produk belum Diisi';
            $data['status'] = FALSE;
        }
        if ($this->input->post('stok') == '') 
        {
            $data['inputerror'][] = 'stok';
            $data['error_string'][] = 'Stok belum Diisi';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_return()
    {
        $mst_stok       = $this->stok->get_stok($this->input->post('id_product'));
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('id_product') == '')
        {
            $data['inputerror'][] = 'id_product';
            $data['error_string'][] = 'Produk belum Diisi';
            $data['status'] = FALSE;
        }
        if ($this->input->post('stok') == '') 
        {
            $data['inputerror'][] = 'stok';
            $data['error_string'][] = 'Stok belum Diisi';
            $data['status'] = FALSE;
        }
        if($this->input->post('stok') > $mst_stok->stok)
        {
            $data['inputerror'][] = 'stok';
            $data['error_string'][] = 'Unit tidak boleh Melebihi angka '.$mst_stok->stok;
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function cetak_pdf($x)
    {
        $get_produk         = $this->stok->get_produk($x);
        $data['ket']        = 'Laporan Rekapan Stok '.$get_produk->nama_product;
        $data['laporan']    = $this->stok->get_data_report($x);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan Stok ".$get_produk->nama_product.".pdf";
        $this->pdf->load_view('format/stok_pdf', $data);
    }

    public function cetak_xls($x)
    {
        $get_produk         = $this->stok->get_produk($x);
        $data['ket']        = 'Laporan Rekapan Stok '.$get_produk->nama_product;
        $data['laporan']    = $this->stok->get_data_report($x);
        $this->load->view('format/stok_xls', $data);
    }
}

/* End of file Stok.php */
/* Location: ./application/controllers/Stok.php */