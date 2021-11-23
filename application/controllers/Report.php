<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
			'title'		=> 'Report',
			'report'    => $this->report->get()->result(),
			'pendapatan'=> $this->report->get_pendapatan(),
			'transaksi'	=> $this->report->get_transaksi(),
			'kasir'		=> $this->report->get_kasir()->result_array()
		];
		$this->template->load('template/index','report/read', $data);
	}

	// 03-10-2020

	public function tampil_report()
	{
		$list = $this->report->get_data_report();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = nice_date($o['created_at'], 'd-M-Y H:i:s');
			$tbody[]    = $o['kode_transaksi'];
			$tbody[]    = "Rp. ".number_format($o['total_harga'],0,'.','.');
			$tbody[]    = ($o['pelanggan']) ? $o['pelanggan'] : 'Umum';
            $tbody[]    = "<span style='cursor:pointer' class='text-info detail-report' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' diskon='".$o['diskon']."'><i class='mdi mdi-information-outline mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

		$output = [ "draw"             => $_POST['draw'],
					"tgl_awal"		   => $this->input->post('tgl_awal'),
                    "recordsTotal"     => $this->report->jumlah_semua_report(),
                    "recordsFiltered"  => $this->report->jumlah_filter_report(),   
                    "data"             => $data
                ];

        echo json_encode($output);
	}

	// 04-10-2020

	public function ambil_total()
	{
		$pdp	= $this->report->get_pendapatan_f();
		$tr 	= $this->report->get_transaksi_f();

		$data 	= ['pendapatan'	=> ($pdp == null) ? 0 : $pdp,
				   'transaksi'	=> ($tr == null) ? 0 : $tr
				  ];

		echo json_encode($data);
	}

	// 04-10-2020

	public function tampil_detail()
	{
		$id_tr 	= $this->input->post('id_transaksi');
		$diskon = $this->input->post('diskon');

		$data = ['report'	=> $this->report->get_detail($id_tr)->row_array(),
				 'kategori'	=> $this->report->get_kategori($id_tr)->result_array(),
				 'id_tr'	=> $id_tr,
				 'diskon'	=> $diskon
				];

		$this->load->view('report/V_detail', $data);
		
	}

	// 06-10-2020

	public function download_file()
    {
		$tgl 		= explode(" - ", $this->input->post('tanggal'));

        $tgl_awal   	= $tgl[0];
        $tgl_akhir  	= $tgl[1];
        $id_user  		= $this->input->post('kasir');
        $jns        	= $this->input->post('jns');

		$total_p = $this->report->get_pendapatan_download($tgl_awal, $tgl_akhir, $id_user);
		$total_t = $this->report->get_transaksi_download($tgl_awal, $tgl_akhir, $id_user);

        $data   = [ 'report'        => 'Report Transaksi',
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
                    'jns'           => $jns,
					'judul'         => 'Report Transaksi',
					'total_p' 		=> ($total_p == null) ? 0 : $total_p,
					'total_t' 		=> ($total_t == null) ? 0 : $total_t,
                    'trn'        	=> $this->report->get_report_transaksi($tgl_awal, $tgl_akhir, $id_user)->result_array()
                  ]; 

        if ($jns == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", 'report/V_export_transaksi', $data);

        } else {

            ob_start();
            $this->load->view('report/V_export_transaksi', $data);
            $html = ob_get_contents();
            // var_dump($html);die();
                ob_end_clean();
				require_once('./assets/html2pdf/html2pdf.class.php');
				
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
			$pdf->WriteHTML($html);
			
			$pdf->Output('LaporanTransaksi.pdf', 'FI');

			// require __DIR__.'/html2pdf_v5.2-master/vendor/autoload.php';
			// use Spipu\Html2Pdf\Html2Pdf;
			// $html2pdf = new Html2Pdf('P','A4','fr', true, 'UTF-8', array(15, 15, 15, 15), false); 
			// $html2pdf->writeHTML($content);
			// $html2pdf->output();

        } 
        
    }


	public function read()
	{
		$list 	= $this->report->get_datatables();
		$data 	= [];
		$no		= 1;
		foreach($list as $report)
		{
			$row = [];
			$row[] = $no++.'.';
            $row[] = date('d-m-Y', strtotime($report->created_at));
            $row[] = $report->kode_transaksi ? $report->kode_transaksi : 'Tidak Ada';
            $row[] = 'Rp. '.number_format($report->total_harga);
            $row[] = '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#detail'.$report->id.'"><i class="fa fa-info-circle"></i></button>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->report->count_all(),
                    "recordsFiltered" 	=> $this->report->count_filtered(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function cetak()
    {
    	if($this->input->post('pdf') !== null)
    	{
    		if(!empty($this->input->post('start_date')) && !empty($this->input->post('end_date')))
    		{
    			$x = date('Y-m-d', strtotime($this->input->post('start_date'))).'/'.date('Y-m-d', strtotime($this->input->post('end_date')));
    			redirect('Report/cetak_pdf/'.$x);
    		}
    		elseif(!empty($this->input->post('start_date')))
    		{
    			$x = date('Y-m-d', strtotime($this->input->post('start_date')));
    			redirect('Report/cetak_pdf/'.$x);
    		}
    		elseif(!empty($this->input->post('end_date')))
    		{
    			$x = date('Y-m-d', strtotime($this->input->post('end_date')));
    			redirect('Report/cetak_pdf/'.$x);
    		}
    		else
    		{
    			redirect('Report/cetak_pdf');
    		}
    	}
    	else
    	{
    		if(!empty($this->input->post('start_date')) && !empty($this->input->post('end_date')))
    		{
    			$x = date('Y-m-d', strtotime($this->input->post('start_date'))).'/'.date('Y-m-d', strtotime($this->input->post('end_date')));
    			redirect('Report/cetak_excel/'.$x);
    		}
    		elseif(!empty($this->input->post('start_date')))
    		{
    			$x = date('Y-m-d', strtotime($this->input->post('start_date')));
    			redirect('Report/cetak_excel/'.$x);
    		}
    		elseif(!empty($this->input->post('end_date')))
    		{
    			$x = date('Y-m-d', strtotime($this->input->post('end_date')));
    			redirect('Report/cetak_excel/'.$x);
    		}
    		else
    		{
    			redirect('Report/cetak_excel');
    		}
    	}
    }

    public function cetak_pdf($x = null)
    {
    	if($x != null)
    	{
    		if($this->uri->segment(3) && empty($this->uri->segment(4)))
    		{
    			$tanggal 	= $this->uri->segment(3);
    			$ket 		= 'Laporan Rekapan Transaksi Tanggal '.date('d-m-Y', strtotime($tanggal));
				$laporan 	= $this->report->get_table_tanggal($tanggal);
    		}
    		else
    		{
				$start 		= $this->uri->segment(3);
				$end 		= $this->uri->segment(4);
				$ket 		= 'Laporan Rekapan Transaksi Periode '.date('d-m-Y', strtotime($start)).' s/d '.date('d-m-Y', strtotime($end));
				$laporan 	= $this->report->get_table_periode($start, $end);
	        }
		}
		else
		{
			$ket 		= 'Laporan Rekapan Transaksi Keseluruhan';
			$laporan 	= $this->report->get_table();
		}

		$data['ket'] 		= $ket;
        $data['laporan']	= $laporan;
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan Rekapan Transaksi.pdf";
        $this->pdf->load_view('format/transaksi_pdf', $data);
     //    ob_start();
	    // $this->load->view('format/transaksi_pdf', $data);
	    // $html = ob_get_contents();
	    // ob_end_clean();
	    // require_once('./assets/html2pdf/html2pdf.class.php');
	    // $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
	    // $pdf->WriteHTML($html);
	    // $pdf->Output('Laporan Rekapan Transaksi.pdf', 'FI');
    }

    public function cetak_excel($x =  null)
    {
    	if($x != null)
    	{
    		if($this->uri->segment(3) && empty($this->uri->segment(4)))
    		{
    			$tanggal 	= $this->uri->segment(3);
    			$ket 		= 'Laporan Rekapan Transaksi Tanggal '.date('d-m-Y', strtotime($tanggal));
				$laporan 	= $this->report->get_table_tanggal($tanggal);
    		}
    		else
    		{
				$start 		= $this->uri->segment(3);
				$end 		= $this->uri->segment(4);
				$ket 		= 'Laporan Rekapan Transaksi Periode '.date('d-m-Y', strtotime($start)).' s/d '.date('d-m-Y', strtotime($end));
				$laporan 	= $this->report->get_table_periode($start, $end);
	        }
		}
		else
		{
			$ket 		= 'Laporan Rekapan Transaksi Keseluruhan';
			$laporan 	= $this->report->get_table();
		}

		$data['ket'] 		= $ket;
        $data['laporan']	= $laporan;
        ob_start();
	    $this->load->view('format/transaksi_xls', $data);
    }

    public function cetak_faktur($id)
    {
        $data   = [
            'row'   => $this->report->get_detail($id)->row()
        ];
        $this->load->view('report/faktur', $data, FALSE);
    }

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */