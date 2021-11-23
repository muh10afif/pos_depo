<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {

    public function __construct()
    {
        $this->id_user = $this->session->userdata('id_user');
    }

    // 06-10-2020
    public function get_kasir()
    {
        $this->db->select('u.username, u.id');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_user as u', 'u.id = t.created_by', 'inner');
        $this->db->group_by('u.id');
        
        return $this->db->get();
    }

    // 04-10-2020
    public function get_pendapatan()
    {
        $date = date("Y-m-d", now('Asia/Jakarta'));

        $this->db->select_sum('total_harga');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$date' AND '$date'");

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }
        
        $a = $this->db->get()->row_array();

        return $a['total_harga'];
    }

    // 06-10-2020
    public function get_pendapatan_download($tgl_awal, $tgl_akhir, $id_user)
    {
        $awal   = $tgl_awal;
        $akhir  = $tgl_akhir;

        $this->db->select_sum('total_harga');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->where("DATE_FORMAT(t.created_at, '%d/%m/%Y') BETWEEN '$awal' AND '$akhir'");

        if ($id_user != '') {
            $this->db->where('t.created_by', $id_user);
        }

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }
        
        $a = $this->db->get()->row_array();

        return $a['total_harga'];
    }

    // 04-10-2020
    public function get_transaksi()
    {
        $date = date("Y-m-d", now('Asia/Jakarta'));

        $this->db->select('t.id');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$date' AND '$date'");

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }
        
        return $this->db->get()->num_rows();
    }

    // 06-10-2020
    public function get_transaksi_download($tgl_awal, $tgl_akhir, $id_user)
    {
        $awal   = $tgl_awal;
        $akhir  = $tgl_akhir;

        $this->db->select('t.id');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->where("DATE_FORMAT(t.created_at, '%d/%m/%Y') BETWEEN '$awal' AND '$akhir'");

        if ($id_user != '') {
            $this->db->where('t.created_by', $id_user);
        }

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }
        
        return $this->db->get()->num_rows();
    }

    // 06-10-2020
    public function get_report_transaksi($tgl_awal, $tgl_akhir, $id_user)
    {
        $this->db->select('t.*, p.pelanggan, u.username');
        $this->db->from('trn_transaksi as t'); 
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->join('mst_user as u', 'u.id = t.created_by', 'inner');
        
        $id_o = $this->session->userdata('id_owner');

        if ($id_o == 0) {
            
            if ($id_user != '' ) {
                $this->db->where('t.created_by', $id_user);
            }

        } else {
            $this->db->where('t.created_by', $this->id_user);
        }

        $awal   = $tgl_awal;
        $akhir  = $tgl_akhir;

        $this->db->where("DATE_FORMAT(t.created_at, '%d/%m/%Y') BETWEEN '$awal' AND '$akhir'");

        return $this->db->get();
        
    }

    // 06-10-2020

    public function get_detail_report($id_transaksi)
    {
        $this->db->select('k.kategori, t.*, p.nama_product, p.harga');
        $this->db->from('trn_detail_transaksi as t');
        $this->db->join('mst_product as p', 'p.id = t.id_product', 'inner');
        $this->db->join('mst_kategori as k', 'k.id = p.id_kategori', 'inner');
        $this->db->where('t.id_transaksi', $id_transaksi);

        return $this->db->get();
        
    }

    // 04-10-2020
    public function get_pendapatan_f()
    {
        $this->db->select_sum('total_harga');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        
        $awal   = $this->input->post('tgl_awal');
        $akhir  = $this->input->post('tgl_akhir');
        
        if ($this->input->post('tgl_awal') != '' && $this->input->post('tgl_akhir') != '') {

            $this->db->where("DATE_FORMAT(t.created_at, '%d/%m/%Y') BETWEEN '$awal' AND '$akhir'");
    
        }

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }
        
        $a = $this->db->get()->row_array();

        return $a['total_harga'];
    }

    // 04-10-2020
    public function get_transaksi_f()
    {
        $this->db->select('t.id');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');

        $awal   = $this->input->post('tgl_awal');
        $akhir  = $this->input->post('tgl_akhir');
        
        if ($this->input->post('tgl_awal') != '' && $this->input->post('tgl_akhir') != '') {

            $this->db->where("DATE_FORMAT(t.created_at, '%d/%m/%Y') BETWEEN '$awal' AND '$akhir'");
    
        }

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }
        
        return $this->db->get()->num_rows();
    }

    // 04-10-2020

    public function get_detail($id_tr)
    {
        $this->db->select('t.*, p.pelanggan, u.username, p.alamat, p.no_telp');
        $this->db->from('trn_transaksi as t'); 
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->join('mst_user as u', 'u.id = t.created_by', 'inner');
        
        $this->db->where('t.id', $id_tr);
        
        return $this->db->get();
    }

    public function get_tr_detail($id_kat, $id_tr)
    {
        $this->db->select('t.*, p.nama_product, p.harga, (SELECT r.potongan_harga FROM trn_transaksi as r WHERE r.id = t.id_transaksi) as potongan_harga');
        $this->db->from('trn_detail_transaksi as t');
        $this->db->join('mst_product as p', 'p.id = t.id_product', 'inner');
        $this->db->where('t.id_transaksi', $id_tr);
        $this->db->where('p.id_kategori', $id_kat);
        
        return $this->db->get();
        
    }

    public function get_tr_detail_r($id_tr)
    {
        $this->db->select('t.*, p.nama_product, p.harga, k.kategori');
        $this->db->from('trn_detail_transaksi as t');
        $this->db->join('mst_product as p', 'p.id = t.id_product', 'inner');
        $this->db->join('mst_kategori as k', 'k.id = p.id_kategori', 'inner');
        $this->db->where('t.id_transaksi', $id_tr);
        
        return $this->db->get();
        
    }

    public function get_kategori($id_tr)
    {
        $this->db->select('k.id, k.kategori');
        $this->db->from('trn_detail_transaksi as t');
        $this->db->join('mst_product as p', 'p.id = t.id_product', 'inner');
        $this->db->join('mst_kategori as k', 'k.id = p.id_kategori', 'inner');
        $this->db->where('t.id_transaksi', $id_tr);
        $this->db->group_by('k.id');
        
        return $this->db->get();
    }

    // 03-10-2020

    // Menampilkan list report
    public function get_data_report()
    {
        $this->_get_datatables_query_report();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_report = [null, 't.created_at', 't.kode_transaksi', 't.total_harga', 'p.pelanggan'];
    var $kolom_cari_report  = ['t.created_at', 't.kode_transaksi', 't.total_harga', 'LOWER(p.pelanggan)'];
    var $order_report       = ['t.id' => 'desc'];

    public function _get_datatables_query_report()
    {
        $this->db->select('t.*, p.pelanggan, j.diskon');
        $this->db->from('trn_transaksi as t'); 
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->join('mst_jenis as j', 'j.id = p.jenis', 'left');

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            
            if ($this->input->post('kasir') != '' ) {
                $this->db->where('t.created_by', $this->input->post('kasir'));
            }

            // $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }

        if ($this->input->post('tgl_awal') == '' && $this->input->post('tgl_akhir') == '') {

            $awal   = date("d/m/Y", now('Asia/Jakarta'));
            $akhir  = date("d/m/Y", now('Asia/Jakarta'));
    
        } else {
            $awal   = $this->input->post('tgl_awal');
            $akhir  = $this->input->post('tgl_akhir');  
        }

        $this->db->where("DATE_FORMAT(t.created_at, '%d/%m/%Y') BETWEEN '$awal' AND '$akhir'");

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_report;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_report;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_report)) {
            
            $order = $this->order_report;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_report()
    {
        $this->db->select('t.*, p.pelanggan, j.diskon');
        $this->db->from('trn_transaksi as t'); 
        $this->db->join('mst_pelanggan as p', 't.id_pelanggan = p.id', 'left');
        $this->db->join('mst_jenis as j', 'j.id = p.jenis', 'left');

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            
            if ($this->input->post('kasir') != '' ) {
                $this->db->where('t.created_by', $this->input->post('kasir'));
            }

            // $this->db->where('t.id_user', $this->id_user);
		} else {
            $this->db->where('t.created_by', $this->id_user);
        }
        
        if ($this->input->post('tgl_awal') == '' && $this->input->post('tgl_akhir') == '') {

            $awal   = date("d/m/Y", now('Asia/Jakarta'));
            $akhir  = date("d/m/Y", now('Asia/Jakarta'));
    
        } else {
            $awal   = $this->input->post('tgl_awal');
            $akhir  = $this->input->post('tgl_akhir');  
        }

        $this->db->where("DATE_FORMAT(t.created_at, '%d/%m/%Y') BETWEEN '$awal' AND '$akhir'");

        return $this->db->count_all_results();
    }

    public function jumlah_filter_report()
    {
        $this->_get_datatables_query_report();

        return $this->db->get()->num_rows();
        
    }

	var $table = 'trn_transaksi';

	function get_datatables()
    {
        $this->db->from($this->table)
        ->where('kode_transaksi <> ""');
        if($this->input->post('start_date') != '' && $this->input->post('end_date') != '')
        {
        	$start = $this->input->post('start_date');
        	$end = $this->input->post('end_date');
        	$this->db->where("created_at BETWEEN '".$start."' AND '".$end."'");
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->db->from($this->table)
        ->where('kode_transaksi <> ""');
        if($this->input->post('start_date') != '' && $this->input->post('end_date') != '')
        {
        	$start = $this->input->post('start_date');
        	$end = $this->input->post('end_date');
        	$this->db->where("created_at BETWEEN '".$start."' AND '".$end."'");
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table)
        ->where('kode_transaksi <> ""');
        if($this->input->post('start_date') != '' && $this->input->post('end_date') != '')
        {
        	$start = $this->input->post('start_date');
        	$end = $this->input->post('end_date');
        	$this->db->where("created_at BETWEEN '".$start."' AND '".$end."'");
        }
        return $this->db->count_all_results();
    }

    public function get($id = null)
    {
        $this->db->from($this->table)
        ->where('trn_transaksi.kode_transaksi <> ""');
        if($id)
        {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_table()
    {
        $this->db->from($this->table)
        ->where('kode_transaksi <> ""')
        ->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_table_tanggal($date)
    {
        $this->db->from($this->table)
        ->where('kode_transaksi <> ""')
        ->where("created_at", $date)
        ->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_table_periode($start, $end)
    {
    	$this->db->from($this->table)
        ->where('kode_transaksi <> ""')
        ->where("created_at BETWEEN '".$start."' AND '".$end."'")
    	->order_by('id', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }
}

/* End of file M_report.php */
/* Location: ./application/models/M_report.php */