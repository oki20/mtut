<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listdoc extends CI_Controller
{

	//Agar gabisa masuk halaman dengan ketik kontroler di URL tanpa melalui Login. Pasang di semua controller
	//Satpam Admin
	function __construct()
	{
		parent::__construct(); //wajib ditulis

		//Jika hak aksesnya bukan 1 (admin) redirect ke controller welcome (halaman login/views formLogin)
		if ($this->session->userdata('ss_levl') != '2') {
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
	        Anda Belum Login
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	        </button>
	        </div>'
			);
			redirect('welcome');
		}
	}

	public function index($divisi = null, $kategori = null)
	{
		//$divisi  = $this->input->get($param,TRUE);
		//$divisi  = $this->uri->segment(3);
		//echo $p1;
		//$divisi=$p1;

		//echo $this->uri->segment(2);

		//$divisi='sales';
		//$kategori='materi';

		$where = array(
			'dvnm' => $divisi,
			//'docum' => $document,
			'catgor' => $kategori,
		);

		$var['dListdoc'] = $this->listdoc_model->query_read('tb_docdata', $where)->result();

		$this->load->view('templates_uzer/header');
		$this->load->view('templates_uzer/sidebar');
		$this->load->view('uzer/listdoc_read', $var);
		$this->load->view('templates_uzer/footer');
	}

	// public function downloadx($Div,$Cat)
	// {
	// 	$data->this->db->get_where('tb_docdata',['dvnm'=>$Div,'catgor'=>$Cat])->row();
	// 	force_download('uploads/'.$data->docum,NULL);
	// }


	public function downloadx($Dvnm, $Fpdf)
	//karena di url tulisannya Tutorial%201.pdf, sedangkan file fisik namanya Tutorial 1.pdf maka rubah %20 menjadi spasi
	{

		// $data = $this->db->get_where('tb_docdata',
		// 	['docum'=>$Docum] )->row();
		// force_download('uploads/'.$data->docum,NULL);

		$data = $this->db->get_where(
			'tb_docdata',
			['dvnm' => str_replace('%20', ' ', $Dvnm), 'fpdf' => str_replace('%20', ' ', $Fpdf)]
		)->row();

		force_download('assets/gudang_file/' . $data->dvnm . '/' . $data->fpdf, NULL);
	}


	public function showPdf($kode)
	{
		$usnm = $this->session->userdata('ss_id');
		$cekdata = $this->db->get_where('tb_pdflock', ['usnm' => $usnm, 'kode' => $kode]);

		if ($cekdata->num_rows() > 0) {
			// PDF is locked, handle accordingly (e.g., show a message)
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                The PDF is currently locked. Please try again later.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
			);
			redirect('uzer/dashboard');
		} else {
			// PDF is not locked, proceed to display
			$data['readdata'] = $this->db->get_where('tb_docdata', ['kode' => $kode])->row();
			//$data['readtime'] = $this->db->get('tb_time')->row();

			$this->load->view('templates_uzer/header');
			$this->load->view('templates_uzer/sidebar');
			$this->load->view('uzer/readpdf', $data);
			$this->load->view('templates_uzer/footer');
		}
	}


	public function lockPdf($kode)
	{
		$usnm = $this->session->userdata('ss_id');

		// Check if the record already exists in tb_pdflock for the given user and code
		$existingLock = $this->db->get_where('tb_pdflock', ['usnm' => $usnm, 'kode' => $kode])->row();

		if (!$existingLock) {
			// If the record does not exist, insert a new lock record
			$data = [
				'usnm' => $usnm,
				'kode' => $kode, // Store the lock time
			];

			$this->db->insert('tb_pdflock', $data);
			redirect('uzer/dashboard');
		}

		// Continue with your logic or redirect as needed
	}




	// public function downloadx($Docum)
	// //karena di url tulisannya Tutorial%201.pdf, sedangkan file fisik namanya Tutorial 1.pdf maka rubah %20 menjadi spasi
	// {

	// 	$data = $this->db->get_where('tb_docdata',
	// 		['docum'=>str_replace('%20',' ',$Docum)] 
	// 		)->row();

	// 	force_download('gambar/'.$data->docum,NULL);
	// }


}
