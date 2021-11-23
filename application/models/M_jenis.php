<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jenis extends CI_Model {

    // Menampilkan list jenis
    public function get_data_jenis()
    {
        $this->_get_datatables_query_jenis();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_jenis = [null, 'jenis', 'diskon'];
    var $kolom_cari_jenis  = ['LOWER(jenis)', 'diskon'];
    var $order_jenis       = ['jenis' => 'asc'];

    public function _get_datatables_query_jenis()
    {
        $this->db->from('mst_jenis'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_jenis;

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

            $kolom_order = $this->kolom_order_jenis;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_jenis)) {
            
            $order = $this->order_jenis;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_jenis()
    {
        $this->db->from('mst_jenis'); 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_jenis()
    {
        $this->_get_datatables_query_jenis();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_jenis.php */
