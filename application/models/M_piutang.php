<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_piutang extends CI_Model {

    // 12-10-2020

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
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

    // 12-10-2020

    // Menampilkan list piutang
    public function get_data_piutang()
    {
        $this->_get_datatables_query_piutang();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_piutang = [null, 'p.pelanggan', 'p.tot_piutang'];
    var $kolom_cari_piutang  = ['LOWER(p.pelanggan)', 'p.tot_piutang'];
    var $order_piutang       = ['p.pelanggan' => 'asc'];

    public function _get_datatables_query_piutang()
    {
        $this->db->select('p.id, p.pelanggan, p.tot_piutang');
        $this->db->from('mst_pelanggan as p'); 
        $this->db->join('trn_piutang as t', 't.id_pelanggan = p.id', 'inner');
        $this->db->group_by('p.id');

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_piutang;

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

            $kolom_order = $this->kolom_order_piutang;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_piutang)) {
            
            $order = $this->order_piutang;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_piutang()
    {
        $this->db->select('p.id, p.pelanggan, p.tot_piutang');
        $this->db->from('mst_pelanggan as p'); 
        $this->db->join('trn_piutang as t', 't.id_pelanggan = p.id', 'inner');
        $this->db->group_by('p.id');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_piutang()
    {
        $this->_get_datatables_query_piutang();

        return $this->db->get()->num_rows();
        
    }

    // 12-10-2020

    // Menampilkan list piutang
    public function get_data_detail_piutang($id_pelanggan)
    {
        $this->_get_datatables_query_detail_piutang($id_pelanggan);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_detail_piutang = [null, 'tanggal', 'bayar', 'sisa_piutang'];
    var $kolom_cari_detail_piutang  = ['tanggal', 'bayar', 'sisa_piutang'];
    var $order_detail_piutang       = ['id' => 'desc'];

    public function _get_datatables_query_detail_piutang($id_pelanggan)
    {
        $this->db->select('id, tanggal, bayar, sisa_piutang');
        $this->db->from('trn_bayar_piutang'); 
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('created_at', 'desc');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_detail_piutang;

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

            $kolom_order = $this->kolom_order_detail_piutang;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_detail_piutang)) {
            
            $order = $this->order_detail_piutang;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_detail_piutang($id_pelanggan)
    {
        $this->db->select('id, tanggal, bayar, sisa_piutang');
        $this->db->from('trn_bayar_piutang'); 
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('created_at', 'desc');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_detail_piutang($id_pelanggan)
    {
        $this->_get_datatables_query_detail_piutang($id_pelanggan);

        return $this->db->get()->num_rows();
        
    }

    // 12-10-2020
    
    public function cari_pelanggan()
    {
        $this->db->select('id, pelanggan, tot_piutang');
        $this->db->from('mst_pelanggan');
        $this->db->where('tot_piutang !=', 0);
        
        return $this->db->get();
    }

}

/* End of file M_piutang.php */
