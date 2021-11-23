<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            $this->session->set_flashdata('danger', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Anda belum Log in</div>');
            redirect(base_url(), 'refresh');
        }
	}

	public function index()
	{
		$data 	= [
			'title'	=> 'User',
			'isi'	=> 'user/read'
		];
        
        $this->template->load('template/index','user/read', $data);
    }
    
    // 02-10-2020

    // menampilkan list user 
    public function tampil_data_user()
    {
        $list = $this->user->get_data_user();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['id_role'] == 1) {
                $role = 'Admin';
                $hid  = '';
            } else {
                $role = 'Super Admin';
                $hid  = 'hidden';
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['username'];
            $tbody[]    = ($o['id_role'] == 1) ? 'Admin' : 'Super Admin';
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-info edit-user' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' pass_lama='".$o['pass']."'><i class='fa fa-pencil-alt'></i></span><span style='cursor:pointer' class='text-danger hapus-user' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' user='".$o['username']."' $hid><i class='fa fa-trash-alt'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->user->jumlah_semua_user(),
                    "recordsFiltered"  => $this->user->jumlah_filter_user(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data user
    public function simpan_data_user()
    {
        $aksi           = $this->input->post('aksi');
        $id_user        = $this->input->post('id_user');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $password_lama  = $this->input->post('password_lama');

        $data = ['username'     => $username,
                 'pass'         => ($password != '') ? password_hash($password, PASSWORD_DEFAULT) : $password_lama, 
                 'active'       => 1,
                 'id_role'      => 1,
                 'id_owner'     => 1,
                 'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->bahan->input_data('mst_user', $data);
        } elseif ($aksi == 'Ubah') {
            $this->bahan->ubah_data('mst_user', $data, array('id' => $id_user));
        } elseif ($aksi == 'Hapus') {
            $this->bahan->hapus_data('mst_user', array('id' => $id_user));
        }

        echo json_encode($aksi);
    }

    // ambil data user
    public function ambil_data_user($id_user)
    {
        $data = $this->bahan->cari_data('mst_user', array("id" => $id_user))->row_array();

        echo json_encode($data);
    }

	public function ajax_read()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $user) {
            $row = array();
            $row[] = $no++.'.';
            $row[] = $user->username;
            $row[] = $user->id_role == 1 ? 'Admin' : 'Super Admin';
            if($user->id_role == 1)
            {
                $row[] = '<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Edit" onclick="update('."'".$user->id."'".')"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$user->id."'".')"><i class="fa fa-trash"></i></a>';
            }
            else
            {
                $row[] = '<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Edit" onclick="update('."'".$user->id."'".')"><i class="fa fa-edit"></i></a>';
            }
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user->count_all(),
                        "recordsFiltered" => $this->user->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->user->get($id)->row();
        echo json_encode($data);
    }

    public function ajax_create()
    {
        $this->_validate_create();
        $data = array(
                        'username'  => $this->input->post('username'),
                        'pass'      => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
                        'active'    => 1,
                        'id_role'   => 1,
                        'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                    );
        $insert = $this->user->create($data);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_update()
    {
        $this->_validate_update();
        $data = array(
                        'username'  => $this->input->post('username'),
                    );
        if($this->input->post('pass') != null)
        {
            $data['pass'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
        }
        $this->user->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete()
    {
        $id = $this->input->post('id');
        $data = $this->user->delete($id);
        echo json_encode($data);
    }

    private function _validate_create()
    {
        $username = $this->input->post('username');
        $this->db->from('mst_user')
        ->where('username', $username);
        $query = $this->db->get();
        $user = $query->row_array();
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username belum diisi';
            $data['status'] = FALSE;
        }
        if($this->input->post('pass') == '' && strlen($this->input->post('password')) == 0)
        {
            $data['inputerror'][] = 'pass';
            $data['error_string'][] = 'Password belum diisi';
            $data['status'] = FALSE;
        }
        if ($user['username'] != null) 
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username '.$username.' sudah Digunakan';
            $data['status'] = FALSE;
        } 
        if(strlen($this->input->post('pass')) < 6 && strlen($this->input->post('pass')) > 0)
        {
            $data['inputerror'][] = 'pass';
            $data['error_string'][] = 'Password minimal harus mengandung 6 karakter';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_update()
    {
        $post = $this->input->post();
        $this->db->from('mst_user')
        ->where('username', $post['username'])
        ->where('id !=', $post['id']);
        $query = $this->db->get();
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username belum diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username '.$post['username'].' sudah Digunakan';
            $data['status'] = FALSE;
        } 
        if(strlen($this->input->post('password')) < 6 && strlen($this->input->post('password')) > 0)
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password minimal harus mengandung 6 karakter';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */