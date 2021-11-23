<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    public function __construct()
    {
        $this->id_user = $this->session->userdata('id_user');
    }

    // 03-10-2020

    public function get_kategori()
    {
        $this->db->select('k.id, k.kategori');
        $this->db->from('mst_kategori as k');
        $this->db->join('mst_product as p', 'p.id_kategori = k.id', 'inner');
        $this->db->order_by('k.kategori', 'asc');
        $this->db->group_by('k.id');
        
        return $this->db->get();
    }

    // 01-10-2020

    public function get_transaksi_hari_ini()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));

        $this->db->select('kode_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tgl);

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('id_user', $this->id_user);
		} else {
            $this->db->where('created_by', $this->id_user);
        }
        
        return $this->db->get();
    }

    // 01-10-2020

    public function get_produk_hari_ini()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));

        $this->db->select_sum('jumlah');
        $this->db->from('trn_transaksi as t');
        $this->db->join('trn_detail_transaksi as d', 'd.id_transaksi = t.id', 'inner');
        $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') =", $tgl);
        // $this->db->group_by('d.id_product');

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('id_user', $this->id_user);
		} else {
            $this->db->where('created_by', $this->id_user);
        }
        
        return $this->db->get();
        
    }

    // 01-10-2020

    public function get_pendapatan_hari_ini()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));

        $this->db->select_sum('total_harga');
        $this->db->from('trn_transaksi');
        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tgl);

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('id_user', $this->id_user);
		} else {
            $this->db->where('created_by', $this->id_user);
        }
        
        $a = $this->db->get()->row_array();

        return $a['total_harga'];
    }

    // 01-10-2020

    public function get_hpp_hari_ini()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));

        $this->db->select("r.id, p.id as id_product, p.nama_product, p.hpp, t.jumlah, (p.hpp * t.jumlah) as total_hpp");
        // $this->db->select("*");
        $this->db->from('trn_transaksi as r');
        $this->db->join('trn_detail_transaksi as t', 't.id_transaksi = r.id', 'inner');
        $this->db->join('mst_product as p', 'p.id = t.id_product', 'inner');
        $this->db->where("DATE_FORMAT(r.created_at, '%Y-%m-%d') =", $tgl);

        $id_o = $this->session->userdata('id_owner');

		if ($id_o == 0) {
            $this->db->where('r.id_user', $this->id_user);
		} else {
            $this->db->where('r.created_by', $this->id_user);
        }
        
        $hpp = $this->db->get()->result_array();

        $tot_hpp = 0;
        foreach ($hpp as $h) {
            $tot_hpp += $h['total_hpp'];
        }

        return $tot_hpp;
    }

	public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    function get_product($id)
    {
        $this->db->select('mst_product.*, mst_stok.stok')
        ->from('mst_product')
        ->join('mst_stok', 'mst_stok.id_product = mst_product.id', 'inner')
        ->where('mst_product.id', $id);
    }

    function get_pendapatan()
    {
        $this->db->select('sum(total_harga) as pendapatan')
        ->from('trn_transaksi')
        ->where('created_at', date('Y-m-d'));
        $query = $this->db->get();
        return $query->row();
    }

	public function get_data_order($tabel, $field, $order)
    {
        $this->db->order_by($field, $order);
        
        return $this->db->get($tabel);
    }

    public function input_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function ubah_data($tabel, $data, $where)
    {
        return $this->db->update($tabel, $data, $where);
    }

    public function hapus_data($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }

    public function cari_data_tr($id_tr)
    {
        $this->db->select('*, a.id as id_d_tr');
        $this->db->from("trn_detail_transaksi as a");
        $this->db->join('mst_product as b', 'b.id = a.id_product', 'inner');
        $this->db->where('a.id_transaksi', $id_tr);
        $this->db->order_by('a.id', 'asc');

        return $this->db->get();
    }

    public function get_total_pesanan($id_tr)
    {
        $this->db->select_sum('subtotal');
        $this->db->from('trn_detail_transaksi');
        $this->db->where('id_transaksi', $id_tr);
        return $this->db->get();
    }

    public function get_total_diskon($id_tr)
    {
        $this->db->select_sum('discount');
        $this->db->from('trn_detail_transaksi');
        $this->db->where('id_transaksi', $id_tr);
        return $this->db->get();
    }

    public function cari_data_kd_tr($tabel, $where)
    {
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->where($where);
        $this->db->order_by('id', 'desc');

        return $this->db->get();
        
    }

    public function get_transaksi()
    {
        $this->db->select('t.*, p.pelanggan, p.alamat');
        $this->db->from('trn_transaksi t')
        ->join('mst_pelanggan p', 'p.id = t.id_pelanggan', 'inner')
        ->order_by('t.id', 'desc')
        ->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    // 16-10-2020
    public function get_pelanggan()
    {
        $this->db->select('p.id, p.pelanggan, p.no_telp, p.alamat, j.jenis, j.diskon');
        $this->db->from('mst_pelanggan as p'); 
        $this->db->join('mst_jenis as j', 'j.id = p.jenis', 'inner');

        return $this->db->get();
        
    }
}

/* End of file M_transaksi.php */
/* Location: ./application/models/M_transaksi.php */