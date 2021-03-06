<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

    var $table = 'mst_kategori';

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

    // Menampilkan list kategori
    public function get_data_kategori()
    {
        $this->_get_datatables_query_kategori();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_kategori = [null, 'b.kategori', 'b.have_bahan'];
    var $kolom_cari_kategori  = ['LOWER(b.kategori)', 'b.have_bahan'];
    var $order_kategori       = ['b.id' => 'desc'];

    public function _get_datatables_query_kategori()
    {
        $this->db->from('mst_kategori as b'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_kategori;

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

            $kolom_order = $this->kolom_order_kategori;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_kategori)) {
            
            $order = $this->order_kategori;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_kategori()
    {
        $this->db->from('mst_kategori as b');   

        return $this->db->count_all_results();
    }

    public function jumlah_filter_kategori()
    {
        $this->_get_datatables_query_kategori();

        return $this->db->get()->num_rows();
        
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

}

/* End of file M_kategori.php */
