<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hutang extends CI_Model {

    // 20-10-2020
    public function cari_pelanggan()
    {
        $this->db->select('p.id, p.pelanggan, p.tot_hutang');
        $this->db->from('mst_pelanggan as p');
        $this->db->join('trn_hutang as h', 'h.id_pelanggan = p.id', 'inner');
        $this->db->group_by('p.id');
        
        return $this->db->get();
    }

    // 20-10-2020
    public function cari_pelanggan_2()
    {
        $this->db->select('p.id, p.pelanggan, p.tot_hutang');
        $this->db->from('mst_pelanggan as p');
        $this->db->where('p.tot_hutang !=', 0);
        
        return $this->db->get();
    }

    // 20-10-2020

    // Menampilkan list hutang
    public function get_data_hutang()
    {
        $this->_get_datatables_query_hutang();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_hutang = [null, 'p.pelanggan', 'p.tot_hutang'];
    var $kolom_cari_hutang  = ['LOWER(p.pelanggan)', 'p.tot_hutang'];
    var $order_hutang       = ['p.pelanggan' => 'asc'];

    public function _get_datatables_query_hutang()
    {
        $this->db->select('p.id, p.pelanggan, p.tot_hutang');
        $this->db->from('mst_pelanggan as p');
        $this->db->join('trn_hutang as h', 'h.id_pelanggan = p.id', 'inner');
        $this->db->group_by('p.id');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_hutang;

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

            $kolom_order = $this->kolom_order_hutang;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_hutang)) {
            
            $order = $this->order_hutang;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_hutang()
    {
        $this->db->select('p.id, p.pelanggan, p.tot_hutang');
        $this->db->from('mst_pelanggan as p');
        $this->db->join('trn_hutang as h', 'h.id_pelanggan = p.id', 'inner');  
        $this->db->group_by('p.id');      

        return $this->db->count_all_results();
    }

    public function jumlah_filter_hutang()
    {
        $this->_get_datatables_query_hutang();

        return $this->db->get()->num_rows();
        
    }

    // 20-10-2020

    // Menampilkan list hutang
    public function get_data_detail_hutang($id_pelanggan)
    {
        $this->_get_datatables_query_detail_hutang($id_pelanggan);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_detail_hutang = [null, 'tanggal', 'bayar', 'sisa_hutang'];
    var $kolom_cari_detail_hutang  = ['tanggal', 'bayar', 'sisa_hutang'];
    var $order_detail_hutang       = ['id' => 'desc'];

    public function _get_datatables_query_detail_hutang($id_pelanggan)
    {
        $this->db->select('id, tanggal, bayar, sisa_hutang');
        $this->db->from('trn_bayar_hutang'); 
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('created_at', 'desc');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_detail_hutang;

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

            $kolom_order = $this->kolom_order_detail_hutang;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_detail_hutang)) {
            
            $order = $this->order_detail_hutang;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_detail_hutang($id_pelanggan)
    {
        $this->db->select('id, tanggal, bayar, sisa_hutang');
        $this->db->from('trn_bayar_hutang'); 
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('created_at', 'desc');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_detail_hutang($id_pelanggan)
    {
        $this->_get_datatables_query_detail_hutang($id_pelanggan);

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_hutang.php */
