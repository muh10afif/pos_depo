<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

    // Menampilkan list pelanggan
    public function get_data_pelanggan()
    {
        $this->_get_datatables_query_pelanggan();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_pelanggan = [null, 'p.pelanggan', 'p.no_telp', 'p.alamat', 'j.jenis'];
    var $kolom_cari_pelanggan  = ['LOWER(p.pelanggan)', 'p.no_telp', 'LOWER(p.alamat)', 'LOWER(j.jenis)'];
    var $order_pelanggan       = ['p.pelanggan' => 'asc'];

    public function _get_datatables_query_pelanggan()
    {
        $this->db->select('p.id, p.pelanggan, p.no_telp, p.alamat, j.jenis');
        $this->db->from('mst_pelanggan as p'); 
        $this->db->join('mst_jenis as j', 'j.id = p.jenis', 'left');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_pelanggan;

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

            $kolom_order = $this->kolom_order_pelanggan;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_pelanggan)) {
            
            $order = $this->order_pelanggan;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_pelanggan()
    {
        $this->db->select('p.id, p.pelanggan, p.no_telp, p.alamat, j.jenis');
        $this->db->from('mst_pelanggan as p'); 
        $this->db->join('mst_jenis as j', 'j.id = p.jenis', 'left');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_pelanggan()
    {
        $this->_get_datatables_query_pelanggan();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_pelanggan.php */
