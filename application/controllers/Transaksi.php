<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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
			'title'		=> 'Transaksi',
			'kategori'	=> $this->transaksi->get_kategori()->result_array(),
			'pelanggan'	=> $this->transaksi->get_data_order('mst_pelanggan','pelanggan','asc')->result_array()
		];

		$this->template->load('template/index','transaksi/lihat', $data);

		// $this->tampil_halaman();
	}

	// 16-10-2020
	public function tampil_halaman()
	{
		$id_pelanggan	= $this->input->post('pelanggan');
		$diskon			= $this->input->post('diskon');
		$nama_pel		= $this->input->post('nama');
		$jenis			= $this->input->post('jenis');
		$no_telp		= $this->input->post('no_telp');
		$alamat			= $this->input->post('alamat');
		$id_pelanggan	= $this->input->post('id_pelanggan');

		if ($id_pelanggan == '') {
			redirect();
		}

		$data 	= [
			'title'		=> 'Transaksi',
			'kategori'	=> $this->transaksi->get_kategori()->result_array(),
			'pelanggan'	=> $this->transaksi->get_data_order('mst_pelanggan','pelanggan','asc')->result_array(),
			'diskon'	=> $diskon,
			'nama_plg'	=> $nama_pel,
			'jenis'		=> $jenis,
			'no_telp'	=> $no_telp,
			'alamat'	=> $alamat,
			'id_plg'	=> $id_pelanggan
		];
		
		$this->template->load('template/index','transaksi/lihat', $data);
	}

	// 16-10-2020
	public function ambil_option_pelanggan()
	{
		$data2 = $this->transaksi->get_pelanggan()->result_array();

        $option = "<option value=''>Pilih Pelanggan</option>";

        foreach ($data2 as $d) {
            $option .= "<option value='".$d['id']."' jenis='".$d['jenis']."' diskon='".$d['diskon']."' no_telp='".$d['no_telp']."' alamat='".$d['alamat']."'>".$d['pelanggan']."</option>";
        }

        echo json_encode(['option' => $option]);
	}

	// 21-10-2020
	public function get_text($text)
	{
		// panjang text awal
		$text = $text." ";
		$lng = strlen($text);

		// panjang text kertas
		if ($lng < 32) {
			$num_char = $lng;
		} else {
			$num_char = 32;
		}

        // memotong yang kata yang terpotong
        $char     = $text{$num_char - 1};
        while($char != ' ') {
            $char = $text{--$num_char}; // Cari spasi pada posisi 49, 48, 47, dst...
		}
		$str_1 = substr($text, 0, $num_char);

		return $str_1;
	}
	
	// 21-10-2020
	public function ambil_string($text)
    {
		// $text = "Jln. Gunung Bandung No. 25 Kec.Cicendo";

        // panjang text awal
		$lng = strlen($text);
		
		$tot = ceil($lng / 32);

		$arr = [];

		// panjang text kertas
		if ($lng < 32) {
			$num_char = $lng;
		} else {
			$num_char = 32;
		}

        // memotong yang kata yang terpotong
        $char     = $text{$num_char - 1};
        while($char != ' ') {
            $char = $text{--$num_char}; // Cari spasi pada posisi 49, 48, 47, dst...
		}
		$str_1 = substr($text, 0, $num_char);

		array_push($arr, $str_1);
		
		$l_str = strlen($str_1);

		$t_str_2 	= (substr($text, $l_str));

		// ambil string kedua
		$str_2 		= $this->get_text($t_str_2);
		$l_str_2 	= strlen($str_2);

		if (count($arr) <= $tot) {
			array_push($arr, trim($str_2));
		}

		$t_str_3 	= substr($text, $l_str + $l_str_2);
		$str_3 		= $this->get_text($t_str_3);
		$l_str_3 	= strlen($str_3);

		if (count($arr) <= $tot) {
			array_push($arr, trim($str_3));
		}

		$t_str_4 	= substr($text, ($l_str + $l_str_2 + $l_str_3));
		$str_4 		= $this->get_text($t_str_4);
		$l_str_4 	= strlen($str_4);

		if (count($arr) <= $tot) {
			array_push($arr, trim($str_4));
		}

		// foreach ($arr as $r) {
		// 	if($r == '')
		// 	{
		// 		unset($link);
		// 	} else {
		// 		print_r($r);
		// 	}
		// }
		
		// echo "<pre>";
		// print_r($arr);
		// echo "</pre>";

		return $arr;
	}
	
	// 21-10-2020
	public function cetak_transaksi($post)
	{
		$total_harga		= str_replace('.','', $post['total_harga']);
		$total_diskon		= str_replace('.','', $post['total_diskon']);
		$nama_product		= $post['nm_produk'];
		$harga_list			= str_replace('.','', $post['harga_list']);
		$qty_list			= $post['qty_list'];
		$diskon_list		= str_replace('.','', $post['diskon_list']);
		$subtotal_list		= str_replace('.','', $post['subtotal_list']);
		$tunai				= str_replace('.','', $post['tunai']);
		$pot_harga			= $post['pot_harga'];
		$nm_kategori		= $post['nm_kategori'];
		$kategori			= $post['kategori'];
		$kembalian			= str_replace('.','', $post['kembalian']);
		// $no_telp 			= $post['no_telp'];
		// $alamat 			= $post['alamat'];
		// $nama_plg 			= $post['nama_plg'];
		// $kasir 				= $post['kasir'];
		$id_produk			= $post['id_produk'];
		$tanggal 			= date('Y-m-d');
		$default_tanggal	= date('dmy', now('Asia/Jakarta'));

		// untuk print

			// me-load library escpos
			$this->load->library('escpos');

			// membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
			$connector 	= new Escpos\PrintConnectors\WindowsPrintConnector("Printer-POS-58");

			// membuat objek $printer agar dapat di lakukan fungsinya
			$printer 	= new Escpos\Printer($connector);

			/* Cut the receipt and open the cash drawer */
			// $printer->cut();
			$printer->pulse();

			$gambar = "\depo.png";

			$path  = __DIR__;

			$path2 = str_replace("application\controllers","",$path);

			$path3 = $path2."assets\img$gambar";

			$tux = Escpos\EscposImage::load($path3);

			$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
			$printer->bitImageColumnFormat($tux);
			$printer->setReverseColors(true);
			$printer->text("\n");

			$printer->initialize();
			$printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
			$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
			$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
			$printer->text("JM Depo Water Filter \n");

			$dt_judul = $this->ambil_string("Taman Kopo Indah 2, Bandung");

			$printer->initialize();
			$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
			foreach ($dt_judul as $d) {
				if($d == '')
				{
					unset($d);
				} else {
					$printer->text($d."\n");
				}
			}
			$printer->text("082130301757 \n");

			$printer->initialize();
			$printer->text("--------------------------------\n \n");

			$printer->initialize();
			$tgl_tr = sprintf('%1$-15s %2$-16s',date("d F Y", now('Asia/Jakarta')), date("H:i:s", now('Asia/Jakarta')));
			$printer->text("$tgl_tr \n");
			// $ksr 	= sprintf('%1$-15s %2$-16s',"Kasir", ": ".$kasir);
			// $printer->text("$ksr \n");
			// $pel 	= sprintf('%1$-15s %2$-16s',"Pelanggan", ": ".$nama_plg);
			// $printer->text("$pel \n");
			$printer->initialize();

			$tt_sb = 0;
			foreach ($nm_kategori as $k) {
				
				$nm_kat = $k;

				$printer->text("--------------------------------\n");
				$printer->text("$nm_kat\n");
				$printer->text("--------------------------------\n");
				$header = sprintf('%1$-4s %2$-8s %3$-8s %4$-8s',"Qty", "Harga", "Diskon", "Total");
				$printer->text("$header\n");
				$printer->text("--------------------------------\n");

				$i = 0;
				foreach ($nama_product as $p) {
					
					if ($nm_kat == $kategori[$i]) {
						// echo $p." ".$post['qty_list'][$i]."x".$post['harga_list'][$i]." (".$post['diskon_list'][$i].") ".$post['subtotal_list'][$i]."<br>";

						$nm_p = $p;

						$printer->text("$nm_p \n");
						$line = sprintf('%1$-4s %2$-8s %3$-8s %4$-8s', "X".number_format($qty_list[$i],0,'.','.'),  number_format($harga_list[$i] - $pot_harga,0,'.','.'), "(".number_format($diskon_list[$i],0,'.','.').")", number_format($subtotal_list[$i],0,'.','.'));
						$printer->text($line);
						$printer->text("\n"); 

						$tt_sb += (($harga_list[$i]) * $qty_list[$i]);

					}

					// $printer->text("\n");

				$i++;
				}
			}

			$printer->text("\n"); 

			$tot_sb = sprintf('%1$-15s %2$-16s','SUBTOTAL', ": Rp. ".number_format($tt_sb,0,'.','.'));
			$printer->text("$tot_sb\n");
			$t_dis = sprintf('%1$-15s %2$-16s','TOTAL DISKON', ": Rp. ".number_format($total_diskon,0,'.','.'));
			$printer->text("$t_dis\n");
			$printer->text("\n");
			$tot_harga = sprintf('%1$-15s %2$-16s','TOTAL', ": Rp. ".number_format($total_harga,0,'.','.'));
			$printer->text("$tot_harga\n");
			$tunai = sprintf('%1$-15s %2$-16s','TUNAI', ": Rp. ".number_format($tunai,0,'.','.'));
			$printer->text("$tunai\n");
			$kembali = sprintf('%1$-15s %2$-16s','KEMBALI', ": Rp. ".number_format($kembalian,0,'.','.'));
			$printer->text("$kembali\n \n");

			$printer->initialize();
			$printer->text("\n"); 
			$printer->text("--------------------------------\n");
			$printer->text("           TERIMA KASIH         \n");
			$printer->text("--------------------------------\n");
			$printer->text("   Powered By BAGJA INDONESIA   \n");
			$printer->text("--------------------------------\n");

			$this->fun_simpan_transaksi($post);

			/* ---------------------------------------------------------
			* Menyelesaikan printer
			*/
			$printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat ke atas
			$printer->close();

		// akhir print
	}

	// 21-10-2020
	public function fun_simpan_transaksi($post)
	{
		$total_harga		= str_replace('.','', $post['total_harga']);
		$total_diskon		= str_replace('.','', $post['total_diskon']);
		$nama_product		= $post['nm_produk'];
		$harga_list			= str_replace('.','', $post['harga_list']);
		$qty_list			= $post['qty_list'];
		$diskon_list		= str_replace('.','', $post['diskon_list']);
		$subtotal_list		= str_replace('.','', $post['subtotal_list']);
		$tunai				= str_replace('.','', ($post['tunai'] == '') ? 0 : $post['tunai']);
		$kembalian			= str_replace('.','', $post['kembalian']);
		$id_produk			= $post['id_produk'];
		$tanggal 			= date('Y-m-d');
		$default_tanggal	= date('dmy', now('Asia/Jakarta'));
		
		$sts_pelanggan		= $this->input->post('sts_pelanggan');
		$id_pelanggan		= $this->input->post('id_pelanggan');
		$pel_baru			= $this->input->post('pel_baru');
		$no_telp			= $this->input->post('no_telp');
		$alamat				= $this->input->post('alamat');
		$pot_harga			= $this->input->post('pot_harga');

		$aksi_btn 			= $this->input->post('aksi_btn');

		// untuk simpan transaksi

		if ($this->session->userdata('role') == 2 ) {
			$id_user = $this->session->userdata('id_user');
		} else {
			$id_user = $this->session->userdata('id_owner');
		}

		$transaksi = $this->transaksi->cari_data_kd_tr('trn_transaksi', ['id_user' => $id_user])->row_array();

		$bagian_tanggal 	= substr($transaksi['kode_transaksi'], 3, 6);
		$bagian_urutan 		= substr($transaksi['kode_transaksi'], 9, 7);
		
		if($default_tanggal == $bagian_tanggal)
		{
			$kode = $bagian_urutan + 1;
		}
		else
		{
			$kode = '1';
		}

		$generated_code		= str_pad($kode, 5, '0', STR_PAD_LEFT);
		$kode_transaksi		= "TRN$default_tanggal$generated_code";

		$id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
			$id_u = $this->session->userdata('id_user');
		} else {
			$id_u = $id_o;
		}

		if ($sts_pelanggan == 'lama') {

			$id_pelanggan = $id_pelanggan;

		} else {

			$data_pel = ['pelanggan'	=> $pel_baru,
						 'no_telp'		=> $no_telp,
						 'alamat'		=> $alamat,
						 'created_at'	=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
						];

			$this->transaksi->input_data('mst_pelanggan', $data_pel);
			$id_pelanggan = $this->db->insert_id();

		}

		$data_trn_transaksi	= [
			'id_user'			=> $id_u,
			'kode_transaksi'	=> $kode_transaksi,
			'total_harga' 		=> $total_harga,
			'total_discount'	=> $total_diskon,
			'tunai'				=> $tunai,
			'potongan_harga'	=> $pot_harga,
			'id_pelanggan'		=> $id_pelanggan,
			'created_by'		=> $this->session->userdata('id_user'),
			'created_at'		=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
		];

		$this->db->insert('trn_transaksi', $data_trn_transaksi);
		$id_transaksi		= $this->db->insert_id();
		$batas_array 		= count($id_produk);	

		for($i = 0; $i < $batas_array; $i++)
		{

			$data_trn_detail_transaksi	= [
					'id_transaksi'		=> $id_transaksi,
					'id_product'		=> $id_produk[$i],
					'jumlah'			=> $qty_list[$i],
					'discount'			=> $diskon_list[$i],
					'subtotal'			=> $subtotal_list[$i],
					'created_at'		=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
				];

			$this->transaksi->input_data('trn_detail_transaksi', $data_trn_detail_transaksi);


			// cari data di product
			$pro1 = $this->transaksi->cari_data('mst_stok', ['id_product' => $id_produk[$i]]);

			$pro = $pro1->row_array();

			if ($pro1->num_rows() > 0) {

				// input ke trn stok
				$data_trn_stok = [	'id_stok'		=> $pro['id'],
									'barang_masuk' 	=> 0,
									'barang_keluar'	=> $qty_list[$i],
									'barang_retur' 	=> 0,
									'created_at'	=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
								];
				
				$this->transaksi->input_data('trn_stok', $data_trn_stok);
				
				// update ke mst stok
				$this->transaksi->ubah_data('mst_stok', ['stok' => ($pro['stok'] - $qty_list[$i])], ['id' => $pro['id']]);

			}

		} // end for

		// untuk piutang
			
		if ($aksi_btn == 'piutang') {

			// cari tot piutang
			$cr_piutang = $this->transaksi->cari_data('mst_pelanggan', ['id' => $id_pelanggan])->row_array();

			$tot_piutang = $cr_piutang['tot_piutang'] + str_replace("-","",$kembalian);

					
			// $data_byr_p = [ 'id_pelanggan' => $id_pelanggan,
			// 				'tanggal'      => date("Y-m-d", now('Asia/Jakarta')),
			// 				'bayar'        => 0,
			// 				'sisa_piutang' => $tot_piutang,
			// 				'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
			// 			];

			// $this->bahan->input_data('trn_bayar_piutang', $data_byr_p);    
				
			$this->transaksi->ubah_data('mst_pelanggan', ['tot_piutang' => $tot_piutang], ['id' => $id_pelanggan]);

			$input_piutang = [	'id_pelanggan' 	=> $id_pelanggan,
								'id_transaksi' 	=> $id_transaksi,
								'bayar'       	=> $tunai,
								'piutang'     	=> $kembalian,
								'created_at'  	=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
							];
			
			$this->transaksi->input_data('trn_piutang', $input_piutang);

		}

		$habis = $this->stok->get_stok_habis();

		$array = array(
			'stok_habis' => $habis
		);
		
		$this->session->set_userdata( $array );

		return $id_transaksi;

	}

	// 04-10-2020
	public function simpan_list_transaksi2()
	{
		$post 				= $this->input->post();
		$total_harga		= str_replace('.','', $post['total_harga']);
		$qty_list			= $post['qty_list'];
		$diskon_list		= str_replace('.','', $post['diskon_list']);
		$subtotal_list		= str_replace('.','', $post['subtotal_list']);
		$tunai				= str_replace('.','', ($post['tunai'] == '') ? 0 : $post['tunai']);
		$kembalian 			= str_replace('-','', $post['kembalian']);
		$id_produk			= $post['id_produk'];
		$default_tanggal	= date('dmy', now('Asia/Jakarta'));
		$id_pelanggan		= $this->input->post('id_pelanggan');

		$aksi_btn 			= $this->input->post('aksi_btn');

		// untuk simpan transaksi

			if ($this->session->userdata('role') == 2 ) {
				$id_user = $this->session->userdata('id_user');
			} else {
				$id_user = $this->session->userdata('id_owner');
			}

			$transaksi = $this->transaksi->cari_data_kd_tr('trn_transaksi', ['id_user' => $id_user])->row_array();

			$bagian_tanggal 	= substr($transaksi['kode_transaksi'], 3, 6);
			$bagian_urutan 		= substr($transaksi['kode_transaksi'], 9, 7);
			
			if($default_tanggal == $bagian_tanggal)
			{
				$kode = $bagian_urutan + 1;
			}
			else
			{
				$kode = '1';
			}

			$generated_code		= str_pad($kode, 5, '0', STR_PAD_LEFT);
			$kode_transaksi		= "TRN$default_tanggal$generated_code";

			$id_o = $this->session->userdata('id_owner');

			if ($id_o == 0) {
				$id_u = $this->session->userdata('id_user');
			} else {
				$id_u = $id_o;
			}

			$data_trn_transaksi	= [
				'id_user'			=> $id_u,
				'kode_transaksi'	=> $kode_transaksi,
				'total_harga' 		=> $total_harga,
				'tunai'				=> $tunai,
				'id_pelanggan'		=> $id_pelanggan,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_at'		=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
			];

			$this->db->insert('trn_transaksi', $data_trn_transaksi);
			$id_transaksi		= $this->db->insert_id();
			$batas_array 		= count($id_produk);	

			for($i = 0; $i < $batas_array; $i++)
			{

				$data_trn_detail_transaksi	= [
						'id_transaksi'		=> $id_transaksi,
						'id_product'		=> $id_produk[$i],
						'jumlah'			=> $qty_list[$i],
						'discount'			=> $diskon_list[$i],
						'subtotal'			=> $subtotal_list[$i],
						'created_at'		=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
					];

				$this->transaksi->input_data('trn_detail_transaksi', $data_trn_detail_transaksi);


				// cari data di product
				$pro1 = $this->transaksi->cari_data('mst_stok', ['id_product' => $id_produk[$i]]);

				$pro = $pro1->row_array();

				if ($pro1->num_rows() > 0) {

					// input ke trn stok
					$data_trn_stok = [	'id_stok'		=> $pro['id'],
										'barang_masuk' 	=> 0,
										'barang_keluar'	=> $qty_list[$i],
										'barang_retur' 	=> 0,
										'created_at'	=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
									];
					
					$this->transaksi->input_data('trn_stok', $data_trn_stok);
					
					// update ke mst stok
					$this->transaksi->ubah_data('mst_stok', ['stok' => ($pro['stok'] - $qty_list[$i])], ['id' => $pro['id']]);

				}

			} // end for

		// untuk piutang
			
		if ($aksi_btn == 'piutang') {

			// cari tot piutang
			$cr_piutang = $this->transaksi->cari_data('mst_pelanggan', ['id' => $id_pelanggan])->row_array();

			$tot_piutang = $cr_piutang['tot_piutang'] + $kembalian;

			if ($cr_piutang['tot_piutang'] == 0) {
                    
				$data_byr_p = [ 'id_pelanggan' => $id_pelanggan,
								'tanggal'      => date("Y-m-d", now('Asia/Jakarta')),
								'bayar'        => 0,
								'sisa_piutang' => $tot_piutang,
								'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
							  ];

				$this->bahan->input_data('trn_bayar_piutang', $data_byr_p);    
				
			}
			
			$this->transaksi->ubah_data('mst_pelanggan', ['tot_piutang' => $tot_piutang], ['id' => $id_pelanggan]);

			$input_piutang = ['id_pelanggan' 	=> $id_pelanggan,
							  'id_transaksi' 	=> $id_transaksi,
							  'bayar'       	=> $tunai,
							  'piutang'     	=> $kembalian,
							  'created_at'  	=> date("Y-m-d H:i:s", now('Asia/Jakarta'))
							];
			
			$this->transaksi->input_data('trn_piutang', $input_piutang);

		}

		$habis = $this->stok->get_stok_habis();

		$array = array(
			'stok_habis' => $habis
		);
		
		$this->session->set_userdata( $array );

		echo json_encode(['id_tr' => $id_transaksi, 'stok_habis' => $habis]);
	}

	// 21-10-2020
	public function simpan_list_transaksi()
	{
		$post	= $this->input->post();

		$this->cetak_transaksi($post);

		echo json_encode(['status' => TRUE]);
	}

	public function add_row()
	{
		$id_product 	= $this->input->post('id_product');
		$product 		= $this->transaksi->cari_data('mst_product', ['id' => $id_product])->row();
		$mst_stok 		= $this->transaksi->cari_data('mst_stok', ['id_product' => $id_product])->row();
		$nama_product	= $product->nama_product;
		$id_product		= $product->id;
		$diskon 		= 0;
		$total_diskon 	= "Rp. 0";
		$harga 			= $product->harga;
		$total 			= "Rp. ".number_format($harga,0,'.','.');
		$total_diskon 	= "Rp. 0";
		$stok 			= $mst_stok->stok;

		echo json_encode([
			'status' 		=> 'Sukses', 
			'id_product'	=> $id_product,
			'nama_product'	=> $nama_product,
			'total' 		=> $total,
			'diskon'		=> $diskon,
			'total_diskon'	=> $total_diskon,
			'tot_bayar'		=> $total,
			'tot_tr'		=> $harga,
			'stok'			=> $stok
		]);
	}

	public function simpan_transaksi()
	{
		$post 				= $this->input->post();
		$total_harga		= $post['total_harga'];
		$total_diskon		= $post['total_diskon'];
		$nama_product		= $post['nama_product'];
		$jumlah				= $post['jumlah'];
		$discount			= $post['discount'];
		$subtotal			= $post['subtotal'];
		$nama_pelanggan		= $post['nama_pelanggan'];
		$alamat_pelanggan 	= $post['alamat_pelanggan'];
		$tanggal 			= date('Y-m-d');
		$default_tanggal	= date('dmy');
		$jumlah_transaksi 	= $this->transaksi->cari_data('trn_transaksi', ['created_at' => $tanggal])->num_rows();
		if($jumlah_transaksi < 1)
		{
			$kode = "1";
		}
		else
		{
			$transaksi 			= $this->transaksi->cari_data('trn_transaksi', ['created_at' => $tanggal])->row_array();
			$bagian_tanggal 	= substr($transaksi['kode_transaksi'], 3, 6);
			$bagian_urutan 		= substr($transaksi['kode_transaksi'], 9, 7);
			if(strtotime($default_tanggal) == strtotime($bagian_tanggal))
			{
				$kode = $bagian_urutan + 1;
			}
			else
			{
				$kode = '1';
			}
		}
		$generated_code		= str_pad($kode, 5, '0', STR_PAD_LEFT);
		$kode_transaksi		= "TRN$default_tanggal$generated_code";
		$data_trn_transaksi	= [
			'kode_transaksi'	=> $kode_transaksi,
			'total_harga' 		=> $total_harga,
			'total_discount'	=> $total_diskon,
			'nama_pelanggan'	=> $nama_pelanggan,
			'alamat_pelanggan'	=> $alamat_pelanggan,
			'created_at'		=> date("Y-m-d", now('Asia/Jakarta'))
		];
		$this->db->insert('trn_transaksi', $data_trn_transaksi);
		$id_transaksi		= $this->db->insert_id();
		$batas_array 		= count($nama_product);
		for($i = 0; $i < $batas_array; $i++)
		{
			$produk						= $this->transaksi->cari_data('mst_product', ['nama_product' => $nama_product[$i]])->row();
			$id_product 				= $produk->id;
			$data_trn_detail_transaksi	= [
				'id_transaksi'	=> $id_transaksi,
				'id_product'	=> $id_product,
				'jumlah'		=> $jumlah[$i],
				'discount'		=> $discount[$i],
				'subtotal'		=> $subtotal[$i],
				'created_at'	=> date("Y-m-d", now('Asia/Jakarta'))
			];
			$this->transaksi->input_data('trn_detail_transaksi', $data_trn_detail_transaksi);
			$stok           = 0;
	        $mst_stok       = $this->stok->get_stok($id_product);
	        $data_trn_stok  = [
	                    'id_stok'           => $mst_stok->id,
	                    'barang_masuk'      => 0,
	                    'barang_keluar'     => $jumlah[$i],
	                    'barang_retur'      => 0,
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
		}
		
		echo json_encode(['status' => TRUE]);
	}

	public function cetak_faktur()
    {
        $data   = [
            'row'   => $this->transaksi->get_transaksi()
        ];
        $this->load->view('report/faktur', $data, FALSE);
    }

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */