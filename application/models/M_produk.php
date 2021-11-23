<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

	// 01-10-2020

	public function cari_data($tabel, $where)
	{
		return $this->db->get_where($tabel, $where);
	}

	// 01-10-2020

	public function get_kategori()
	{
		$this->db->select('k.id, k.kategori, (SELECT count(d.id) FROM mst_product as d WHERE d.id_kategori = k.id) as jml');
		$this->db->from('mst_kategori as k');
		$this->db->join('mst_product as p', 'k.id = p.id_kategori', 'left');
		$this->db->group_by('k.id');
		$this->db->order_by('k.kategori', 'asc');
		
		return $this->db->get();
	}

	// 02-10-2020

	public function get_produk($id_kategori)
	{
		$this->db->select('mst_product.*, mst_bahan.nama_bahan, mst_merk.merk, mst_kategori.kategori, (select s.stok from mst_stok as s where s.id_product = mst_product.id) as stok');
		$this->db->from('mst_product');
		$this->db->join('mst_kategori', 'mst_kategori.id = mst_product.id_kategori', 'inner');
		$this->db->join('mst_bahan', 'mst_bahan.id = mst_product.id_bahan', 'left');
		$this->db->join('mst_merk', 'mst_merk.id = mst_product.id_merk', 'inner');
		$this->db->where('mst_product.id_kategori', $id_kategori);
		$this->db->order_by('mst_product.nama_product', 'asc');

		return $this->db->get();
	}

	// 02-10-2020

	public function hapus_data($tabel, $where)
	{
		$this->db->delete($tabel, $where);
	}

	// 02-10-2020

	public function get_data($tabel, $order)
	{
		$this->db->order_by($order);
		return $this->db->get($tabel);
	}

	var $table = 'mst_product';

	public function get($id =  null)
	{
		$this->db->from($this->table);
		if($id)
		{
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_detail($x)
	{
		$this->db->from('mst_kategori')
		->where('kategori', $x);
		$query = $this->db->get()->row();

		$this->db->select('mst_product.*, mst_bahan.nama_bahan, mst_merk.merk, mst_kategori.kategori')
		->from($this->table)
		->join('mst_kategori', 'mst_kategori.id = mst_product.id_kategori', 'inner')
		->join('mst_bahan', 'mst_bahan.id = mst_product.id_bahan', 'left')
		->join('mst_merk', 'mst_merk.id = mst_product.id_merk', 'inner')
		->where('mst_product.id_kategori', $query->id)
		->order_by('mst_product.nama_product', 'asc');
		$query_2	= $this->db->get();
		return $query_2->result();
	}

	public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

}

/* End of file M_produk.php */
/* Location: ./application/models/M_produk.php */