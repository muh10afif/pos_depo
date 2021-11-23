<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {

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
			'title'	=> 'Merk',
			'isi'	=> 'merk/read',
			'merk'	=> $this->merk->get()->result()
        ];
        
        $this->template->load('template/index','merk/read', $data);
    }
    
    // 02-10-2020

    // menampilkan list merk 
    public function tampil_data_merk()
    {
        $list = $this->merk->get_data_merk();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['merk'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-info edit-merk' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."'><i class='fa fa-pencil-alt'></i></span><span style='cursor:pointer' class='text-danger hapus-merk' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' merk='".$o['merk']."'><i class='fa fa-trash-alt'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->merk->jumlah_semua_merk(),
                    "recordsFiltered"  => $this->merk->jumlah_filter_merk(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data merk
    public function simpan_data_merk()
    {
        $aksi          = $this->input->post('aksi');
        $id_merk       = $this->input->post('id_merk');
        $merk          = $this->input->post('nama_merk');

        $data = ['merk'         => $merk,
                 'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->merk->input_data('mst_merk', $data);
        } elseif ($aksi == 'Ubah') {
            $this->merk->ubah_data('mst_merk', $data, array('id' => $id_merk));
        } elseif ($aksi == 'Hapus') {
            $this->merk->hapus_data('mst_merk', array('id' => $id_merk));
        }

        echo json_encode($aksi);
    }

    // ambil data merk
    public function ambil_data_merk($id_merk)
    {
        $data = $this->merk->cari_data('mst_merk', array("id" => $id_merk))->row_array();

        echo json_encode($data);
    }

	public function read()
	{
		$list 	= $this->merk->get()->result();
		$data 	= [];
		$no		= 1;
		foreach($list as $merk)
		{
			$row = [];
			$row[] = $no++.'.';
            $row[] = $merk->merk;
            $row[] = 
            		'<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Edit" onclick="update('."'".$merk->id."'".')"><i class="fa fa-edit"></i></a>
                     <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$merk->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" => $this->merk->count_all(),
                    "recordsFiltered" => $this->merk->count_filtered(),
                    "data" => $data,
		          ];
        echo json_encode($output);
	}

    public function edit($id)
    {
        $data = $this->merk->get($id)->row();
        echo json_encode($data);
    }

	public function create()
    {
        $this->_validate();
        $data = [
                    'merk'  => $this->input->post('merk'),
                    'created_at'   => date("Y-m-d", now('Asia/Jakarta'))
                ];
        $insert = $this->merk->create($data);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $data = [
                    'merk'  => $this->input->post('merk')
                ];
        $this->merk->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $data = $this->merk->delete($id);
        echo json_encode($data);
    }

    private function _validate()
    {
        $merk = $this->input->post('merk');
        $this->db->from('mst_merk')
        ->where('merk', $merk);
        $query = $this->db->get();
        $user = $query->row_array();
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('merk') == '')
        {
            $data['inputerror'][] = 'merk';
            $data['error_string'][] = 'Nama Merk belum Diisi';
            $data['status'] = FALSE;
        }
        if ($user['merk'] != null) 
        {
            $data['inputerror'][] = 'merk';
            $data['error_string'][] = 'Merk '.$merk.' sudah Digunakan';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Merk.php */
/* Location: ./application/controllers/Merk.php */