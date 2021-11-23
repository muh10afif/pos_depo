<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            $this->session->set_flashdata('danger', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Anda belum Log in</div>');
            redirect(base_url(), 'refresh');
        }
	}

	public function index()
	{
		$data 	= [
			'title'		=> 'Produk',
			'kategori'	=> $this->produk->get_kategori()->result_array()
		];

		$this->template->load('template/index','produk/lihat', $data);
	}

	// 01-10-2020

	public function detail($id_kategori)
	{
		$nm = $this->produk->cari_data('mst_kategori', ['id' => $id_kategori])->row_array();
		$data 	= [
			'title'		=> 'Produk Kategori '.$nm['kategori'],
			'judul'		=> 'Produk',
			'id_kat'	=> $id_kategori,
			'nama_kat'	=> $this->produk->cari_data('mst_kategori', ['id' => $id_kategori])->row_array(),
			'bahan'		=> $this->produk->cari_data('mst_bahan', ['id_kategori' => $id_kategori])->result_array(),
			'merk'		=> $this->produk->get_data('mst_merk', ['merk' => 'asc'])->result_array(),
			'kat'		=> $this->produk->get_produk($id_kategori)->result_array()
		];

		$this->template->load('template/index','produk/detail', $data);
	}

	// 02-10-2020

	public function hapus_produk()
	{
		$id_produk 	= $this->input->post('id_produk');
		$foto 		= $this->input->post('foto');

		$this->produk->hapus_data('mst_product', ['id' => $id_produk]);

		unlink("assets/img/upload/produk/$foto");

		echo json_encode(['status' => true]);
	}

	public function Input()
	{
		$data 	= [
			'title'		=> 'Input Produk',
			'kategori'	=> $this->kategori->get()->result(),
			'bahan'		=> $this->bahan->get()->result(),
			'merk'		=> $this->merk->get()->result(),
			'isi'		=> 'produk/form'
		];
		$this->load->view('template/wrapper', $data);
	}

	public function get_bahan()
	{
		$post = $this->input->post();
		$data = $this->kategori->get($post['id'])->row();
		echo json_encode($data);
	}

	public function get_detail()
	{
		$post	= $this->input->post();
		$data 	= $this->produk->get_detail($post['kategori']);
		echo json_encode($data);
	}

	// 05-10-2020
	public function create()
	{
		$config['upload_path']		= './assets/img/upload/produk/';
		$config['allowed_types']    = 'gif|jpg|png|jpeg';
        $config['file_name']        = $this->input->post('nama_kat').'-Produk-'.$this->input->post('nama_produk').'-'.date('Ymdhis');
        $this->load->library('upload', $config);
		$this->upload->initialize($config);

		$id_bahan 	= $this->input->post('bahan');
		$id_merk	= $this->input->post('merk');
		
		if($_FILES['foto_produk']['name'] != null)
		{
			if($this->upload->do_upload('foto_produk'))
			{
				$bahan_baru      = $this->input->post('bahan_baru');
				$status_bahan    = $this->input->post('status_bahan');

				if ($status_bahan == 'baru') {

					$data_bahan = ['nama_bahan'  => $bahan_baru,
								   'id_kategori'  => $this->input->post('id_kategori'),
								   'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
								 ];
					
					$this->bahan->input_data('mst_bahan', $data_bahan);
					$id_bahan = $this->db->insert_id();
					
				}

				$merk_baru      = $this->input->post('merk_baru');
				$status_merk    = $this->input->post('status_merk');

				if ($status_merk == 'baru') {

					$data_merk = ['merk'     	 => $merk_baru,
								  'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
								 ];
					
					$this->merk->input_data('mst_merk', $data_merk);
					$id_merk = $this->db->insert_id();
					
				}

				$data = [
                    'id_kategori'		=> $this->input->post('id_kategori'),
                    'id_bahan'			=> $id_bahan ? $id_bahan : 0,
                    'id_merk'			=> $id_merk,
					'nama_product'		=> $this->input->post('nama_produk'),
					'ukuran_panjang'	=> $this->input->post('ukuran_panjang'),
					'ukuran_lebar'		=> $this->input->post('ukuran_lebar'),
					'tipe_ukuran'		=> $this->input->post('ukuran'),
                    'harga'				=> str_replace(',', '', $this->input->post('harga')),
                    'hpp'				=> str_replace(',', '', $this->input->post('hpp')),
                    'harga_reseller'	=> str_replace(',', '', $this->input->post('harga_reseller')),
                    'foto_produk'		=> $this->upload->data('file_name'),
                    'created_at'   		=> date("Y-m-d", now('Asia/Jakarta'))
				];
				
		        $this->produk->create($data);
				$id_product = $this->db->insert_id();
				
		        $data_stok = [
		        	'id_product'	=> $id_product,
					'stok'			=> $this->input->post('stok'),
					'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
				];
				
				$this->db->insert('mst_stok', $data_stok);
				$id_stok = $this->db->insert_id();

				$data_trn_stok = ['id_stok'		=> $id_stok,
								'barang_masuk'	=> $this->input->post('stok'),
								'barang_keluar'	=> 0,
								'barang_retur'	=> 0,
								'created_at'		=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
								];

				$this->db->insert('trn_stok', $data_trn_stok);
				
				
				echo json_encode(['status' => true]);
			}
			else
			{
				$error = $this->upload->display_errors();
				
				echo json_encode(['status' => $error]);
			}

		} else {

			$bahan_baru      = $this->input->post('bahan_baru');
			$status_bahan    = $this->input->post('status_bahan');

			if ($status_bahan == 'baru') {

				$data_bahan = ['nama_bahan'   => $bahan_baru,
							   'id_kategori'  => $this->input->post('id_kategori'),
							   'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
							];
				
				$this->bahan->input_data('mst_bahan', $data_bahan);
				$id_bahan = $this->db->insert_id();
				
			}

			$merk_baru      = $this->input->post('merk_baru');
			$status_merk    = $this->input->post('status_merk');

			if ($status_merk == 'baru') {

				$data_merk = ['merk'     	 => $merk_baru,
							  'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
							];
				
				$this->merk->input_data('mst_merk', $data_merk);
				$id_merk = $this->db->insert_id();
				
			}

			$data = [
				'id_kategori'		=> $this->input->post('id_kategori'),
				'id_bahan'			=> $id_bahan ? $id_bahan : 0,
				'id_merk'			=> $id_merk,
				'nama_product'		=> $this->input->post('nama_produk'),
				'ukuran_panjang'	=> $this->input->post('ukuran_panjang'),
				'ukuran_lebar'		=> $this->input->post('ukuran_lebar'),
				'tipe_ukuran'		=> $this->input->post('ukuran'),
				'harga'				=> str_replace(',', '', $this->input->post('harga')),
				'hpp'				=> str_replace(',', '', $this->input->post('hpp')),
				'harga_reseller'	=> str_replace(',', '', $this->input->post('harga_reseller')),
				'foto_produk'		=> null,
				'created_at'   		=> date("Y-m-d", now('Asia/Jakarta'))
			];
			$this->produk->create($data);
			$id_product = $this->db->insert_id();
			$data_stok = [
				'id_product'	=> $id_product,
				'stok'			=> $this->input->post('stok'),
				'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
			];
			$this->db->insert('mst_stok', $data_stok);
			$id_stok = $this->db->insert_id();

			$data_trn_stok = ['id_stok'			=> $id_stok,
							  'barang_masuk'	=> $this->input->post('stok'),
							  'barang_keluar'	=> 0,
							  'barang_retur'	=> 0,
							  'created_at'		=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
							 ];

			$this->db->insert('trn_stok', $data_trn_stok);
			
			echo json_encode(['status' => true]);

		}
	}

	// 05-10-2020
	public function update()
	{
		$config['upload_path']		= './assets/img/upload/produk/';
		$config['allowed_types']    = 'gif|jpg|png|jpeg';
        $config['file_name']        = $this->input->post('nama_kat').'-Produk-'.$this->input->post('nama_produk').'-'.date('Ymdhis');
        $this->load->library('upload', $config);
		$this->upload->initialize($config);

		$id_bahan 	= $this->input->post('bahan');
		$id_merk	= $this->input->post('merk');
		
		if($_FILES['foto_produk']['name'] != null)
		{
			if($this->upload->do_upload('foto_produk'))
			{
				$foto = $this->input->post('foto_produk_t');
				
				unlink("assets/img/upload/produk/$foto");
				
				$bahan_baru      = $this->input->post('bahan_baru');
				$status_bahan    = $this->input->post('status_bahan');

				if ($status_bahan == 'baru') {

					$data_bahan = ['nama_bahan'   => $bahan_baru,
								   'id_kategori'  => $this->input->post('id_kategori'),
								   'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
								];
					
					$this->bahan->input_data('mst_bahan', $data_bahan);
					$id_bahan = $this->db->insert_id();
					
				}

				$merk_baru      = $this->input->post('merk_baru');
				$status_merk    = $this->input->post('status_merk');

				if ($status_merk == 'baru') {

					$data_merk = ['merk'     	=> $merk_baru,
								  'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
								];
					
					$this->merk->input_data('mst_merk', $data_merk);
					$id_merk = $this->db->insert_id();
					
				}

				$data = [
					'id_kategori'		=> $this->input->post('id_kategori'),
					'id_bahan'			=> $id_bahan ? $id_bahan : 0,
					'id_merk'			=> $id_merk,
					'nama_product'		=> $this->input->post('nama_produk'),
					'ukuran_panjang'	=> $this->input->post('ukuran_panjang'),
					'ukuran_lebar'		=> $this->input->post('ukuran_lebar'),
					'tipe_ukuran'		=> $this->input->post('ukuran'),
                    'harga'				=> str_replace(',', '', $this->input->post('harga')),
                    'hpp'				=> str_replace(',', '', $this->input->post('hpp')),
                    'harga_reseller'	=> str_replace(',', '', $this->input->post('harga_reseller')),
                    'foto_produk'		=> $this->upload->data('file_name'),
                    'created_at'   		=> date("Y-m-d", now('Asia/Jakarta'))
				];
				
		        $this->bahan->ubah_data('mst_product', $data, ['id' => $this->input->post('id_produk')]);
				
				echo json_encode(['status' => true]);
			}
			else
			{
				$error = $this->upload->display_errors();
				
				echo json_encode(['status' => $error]);
			}

		} else {

			$bahan_baru      = $this->input->post('bahan_baru');
			$status_bahan    = $this->input->post('status_bahan');

			if ($status_bahan == 'baru') {

				$data_bahan = ['nama_bahan'	  => $bahan_baru,
							   'id_kategori'  => $this->input->post('id_kategori'),
							   'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
							];
				
				$this->bahan->input_data('mst_bahan', $data_bahan);
				$id_bahan = $this->db->insert_id();
				
			}

			$merk_baru      = $this->input->post('merk_baru');
			$status_merk    = $this->input->post('status_merk');

			if ($status_merk == 'baru') {

				$data_merk = ['merk'     	=> $merk_baru,
							  'created_at'  => date("Y-m-d", now('Asia/Jakarta'))
							];
				
				$this->merk->input_data('mst_merk', $data_merk);
				$id_merk = $this->db->insert_id();
				
			}

			$data = [
				'id_kategori'		=> $this->input->post('id_kategori'),
				'id_bahan'			=> $id_bahan ? $id_bahan : 0,
				'id_merk'			=> $id_merk,
				'nama_product'		=> $this->input->post('nama_produk'),
				'ukuran_panjang'	=> $this->input->post('ukuran_panjang'),
				'ukuran_lebar'		=> $this->input->post('ukuran_lebar'),
				'tipe_ukuran'		=> $this->input->post('ukuran'),
				'harga'				=> str_replace(',', '', $this->input->post('harga')),
				'hpp'				=> str_replace(',', '', $this->input->post('hpp')),
				'harga_reseller'	=> str_replace(',', '', $this->input->post('harga_reseller')),
				'foto_produk'		=> $this->input->post('foto_produk_t'),
				'created_at'   		=> date("Y-m-d", now('Asia/Jakarta'))
			];

			$this->bahan->ubah_data('mst_product', $data, ['id' => $this->input->post('id_produk')]);
			
			echo json_encode(['status' => true]);

		}
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */