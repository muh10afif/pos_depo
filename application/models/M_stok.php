<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stok extends CI_Model {

    // 06-10-2020

    public function get_report_stok($id_stok)
    {
        $this->db->select('*'); 
        $this->db->from('trn_stok');
        $this->db->where('id_stok', $id_stok);
        $this->db->order_by('created_at', 'desc');

        return $this->db->get();
    }

    // 06-10-2020

    public function get_tot_barang($id_stok)
    {
        $this->db->select('b.stok, b.id, k.nama_product, (select sum(t.barang_masuk) as tot_masuk from trn_stok as t where t.id_stok = b.id) as tot_masuk, (select sum(t.barang_keluar) as tot_keluar from trn_stok as t where t.id_stok = b.id) as tot_keluar, (select sum(t.barang_retur) as tot_retur from trn_stok as t where t.id_stok = b.id) as tot_retur');
        $this->db->from('mst_stok as b'); 
        $this->db->join('mst_product as k', 'k.id = b.id_product', 'inner');
        $this->db->where('b.id', $id_stok);
        
        return $this->db->get();
        
    }

    // 02-10-2020

    // Menampilkan list stok
    public function get_data_stok()
    {
        $this->_get_datatables_query_stok();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_stok = [null, 'k.nama_product', 'b.stok'];
    var $kolom_cari_stok  = ['LOWER(k.nama_product)', 'b.stok'];
    var $order_stok       = ['k.nama_product' => 'asc'];

    public function _get_datatables_query_stok()
    {
        $this->db->select('b.stok, b.id, k.nama_product, (select sum(t.barang_masuk) as tot_masuk from trn_stok as t where t.id_stok = b.id) as tot_masuk, (select sum(t.barang_keluar) as tot_keluar from trn_stok as t where t.id_stok = b.id) as tot_keluar, (select sum(t.barang_retur) as tot_retur from trn_stok as t where t.id_stok = b.id) as tot_retur');
        $this->db->from('mst_stok as b'); 
        $this->db->join('mst_product as k', 'k.id = b.id_product', 'inner');

        $status = $this->input->post('status');

        if ($status == 'habis') {
            $this->db->where('stok', 0);
        } else {
            $this->db->where('stok !=', 0);
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_stok;

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

            $kolom_order = $this->kolom_order_stok;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_stok)) {
            
            $order = $this->order_stok;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_stok()
    {
        $this->db->select('b.stok, b.id, k.nama_product, (select sum(t.barang_masuk) as tot_masuk from trn_stok as t where t.id_stok = b.id) as tot_masuk, (select sum(t.barang_keluar) as tot_keluar from trn_stok as t where t.id_stok = b.id) as tot_keluar, (select sum(t.barang_retur) as tot_retur from trn_stok as t where t.id_stok = b.id) as tot_retur');
        $this->db->from('mst_stok as b'); 
        $this->db->join('mst_product as k', 'k.id = b.id_product', 'inner');
        
        $status = $this->input->post('status');

        if ($status == 'habis') {
            $this->db->where('stok', 0);
        } else {
            $this->db->where('stok !=', 0);
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_stok()
    {
        $this->_get_datatables_query_stok();

        return $this->db->get()->num_rows();
        
    }

    // 06-10-2020
    public function get_stok_habis()
    {
        $this->db->select('b.*');
        $this->db->from('mst_stok as b'); 
        $this->db->join('mst_product as k', 'k.id = b.id_product', 'inner');
        $this->db->where('stok', 0);

        return $this->db->count_all_results();
    }

    // 07-10-2020
    public function get_stok_ada()
    {
        $this->db->select('b.*');
        $this->db->from('mst_stok as b'); 
        $this->db->join('mst_product as k', 'k.id = b.id_product', 'inner');
        $this->db->where('stok !=', 0);

        return $this->db->count_all_results();
    }

    // 03-10-2020

    public function get_data_stok_detail()
    {
        $this->_get_datatables_query_stok_detail();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_stok_detail = [null, 'barang_masuk', 'barang_keluar', 'barang_retur','','created_at'];
    var $kolom_cari_stok_detail  = ['barang_masuk', 'barang_keluar', 'barang_retur','created_at'];
    var $order_stok_detail       = ['created_at' => 'desc'];

    public function _get_datatables_query_stok_detail()
    {
        $this->db->select('*'); 
        $this->db->from('trn_stok');
        $this->db->where('id_stok', $this->input->post('id_stok'));
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_stok_detail;

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

            $kolom_order = $this->kolom_order_stok_detail;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_stok_detail)) {
            
            $order = $this->order_stok_detail;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_stok_detail()
    {
        $this->db->select('*'); 
        $this->db->from('trn_stok');
        $this->db->where('id_stok', $this->input->post('id_stok'));

        return $this->db->count_all_results();
    }

    public function jumlah_filter_stok_detail()
    {
        $this->_get_datatables_query_stok_detail();

        return $this->db->get()->num_rows();
        
    }

    // 02-10-2020

    public function get_produk_stok()
    {
        $this->db->select('p.nama_product, s.stok, p.id, s.id as id_stok, p.harga');
        $this->db->from('mst_product as p');
        $this->db->join('mst_stok as s', 's.id_product = p.id', 'inner');
        
        return $this->db->get();
    }

	var $table = 'mst_stok';

	function count_filtered()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	public function get($id = null)
	{
		$this->db->from($this->table);
		if($id)
		{
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

    function get_jumlah_stok()
    {
        $this->db->select('sum(stok) as stok')
        ->from($this->table);
        $query = $this->db->get();
        return $query->row();
    }

    function get_stok($id)
    {
        $this->db->from($this->table)
        ->where('id_product', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_produk($x)
    {
        $this->db->from($this->table)
        ->join('mst_product', 'mst_product.id = mst_stok.id_product')
        ->where('mst_stok.id', $x);
        $query = $this->db->get();
        return $query->row();
    }

    function get_data_report($id)
    {
        $this->db->from('trn_stok')
        ->where('id_stok', $id)
        ->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_trn_stok($id)
    {
        $this->db->from('trn_stok')
        ->where('id_stok', $id);
        $query = $this->db->get();
        return $query->result();
    }

	public function add_stok($data)
    {
        $this->db->insert('trn_stok', $data);
        return $this->db->insert_id();
    }

    public function read()
    {
    	$this->db->select('mst_stok.*, mst_product.nama_product')
    	->from($this->table)
    	->join('mst_product', 'mst_product.id = mst_stok.id_product', 'inner')
    	->order_by('mst_stok.created_at', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}

/* End of file M_stok.php */
/* Location: ./application/models/M_stok.php */