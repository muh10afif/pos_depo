<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    // 02-10-2020

    // Menampilkan list user
    public function get_data_user()
    {
        $this->_get_datatables_query_user();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_user = [null, 'username'];
    var $kolom_cari_user  = ['LOWER(username)'];
    var $order_user       = ['id' => 'desc'];

    public function _get_datatables_query_user()
    {
        $this->db->from('mst_user');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_user;

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

            $kolom_order = $this->kolom_order_user;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_user)) {
            
            $order = $this->order_user;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_user()
    {
        $this->db->from('mst_user');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_user()
    {
        $this->_get_datatables_query_user();

        return $this->db->get()->num_rows();
        
    }

	var $table = 'mst_user';
    var $column_order = array(null,'username', null);
    var $column_search = array('LOWER(username)');
    var $order = array('id' => 'asc');

    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $i = 0;   
        foreach ($this->column_search as $item)
        {
            if($_POST['search']['value'])
            {
                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }     
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
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

	public function cek_user($username)
	{
		$this->db->from($this->table);
		$this->db->where('username', $username);
		$query = $this->db->get();
		return $query->row();
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

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */