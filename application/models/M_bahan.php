<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_bahan extends CI_Model {

    var $table = 'mst_bahan';

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

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
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

    // 02-10-2020
    
    // Menampilkan list bahan
    public function get_data_bahan()
    {
        $this->_get_datatables_query_bahan();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_bahan = [null, 'b.nama_bahan', 'k.kategori'];
    var $kolom_cari_bahan  = ['LOWER(b.nama_bahan)', 'LOWER(k.kategori)'];
    var $order_bahan       = ['b.id' => 'desc'];

    public function _get_datatables_query_bahan()
    {
        $this->db->select('b.nama_bahan, k.kategori, b.id as id_bahan');
        $this->db->from('mst_bahan as b'); 
        $this->db->join('mst_kategori as k', 'k.id = b.id_kategori', 'inner');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_bahan;

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

            $kolom_order = $this->kolom_order_bahan;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_bahan)) {
            
            $order = $this->order_bahan;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_bahan()
    {
        $this->db->select('b.nama_bahan, k.kategori, b.id as id_bahan');
        $this->db->from('mst_bahan as b'); 
        $this->db->join('mst_kategori as k', 'k.id = b.id_kategori', 'inner');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_bahan()
    {
        $this->_get_datatables_query_bahan();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_bahan.php */
