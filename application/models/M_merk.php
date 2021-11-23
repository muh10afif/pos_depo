
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_merk extends CI_Model {

    // 02-10-2020

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

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    // 02-10-2020

    // Menampilkan list merk
    public function get_data_merk()
    {
        $this->_get_datatables_query_merk();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_merk = [null, 'merk'];
    var $kolom_cari_merk  = ['LOWER(merk)'];
    var $order_merk       = ['id' => 'desc'];

    public function _get_datatables_query_merk()
    {
        $this->db->select('merk, id');
        $this->db->from('mst_merk'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_merk;

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

            $kolom_order = $this->kolom_order_merk;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_merk)) {
            
            $order = $this->order_merk;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_merk()
    {
        $this->db->select('merk, id');
        $this->db->from('mst_merk'); 
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_merk()
    {
        $this->_get_datatables_query_merk();

        return $this->db->get()->num_rows();
        
    }

	var $table = 'mst_merk';

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

	public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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

/* End of file M_merk.php */
/* Location: ./application/models/M_merk.php */