<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            $this->session->set_flashdata('danger', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Anda belum Log in</div>');
            redirect(base_url(), 'refresh');
        }
	}

	// 01-10-2020
	
	public function index()
	{
		$data 	= [
					'title'			=> 'Dashboard',
					'pendapatan'	=> $this->transaksi->get_pendapatan(),
					'stok'			=> $this->stok->get_jumlah_stok(),
					'jml_tr'		=> $this->transaksi->get_transaksi_hari_ini()->num_rows(),
					'jml_produk'	=> $this->transaksi->get_produk_hari_ini()->row_array(),
					'pendapatan'	=> $this->transaksi->get_pendapatan_hari_ini(),
					'hpp'			=> $this->transaksi->get_hpp_hari_ini()
				  ];
		
		$this->template->load('template/index','dashboard', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */