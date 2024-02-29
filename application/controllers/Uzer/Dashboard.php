<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	
	//Agar gabisa masuk halaman dengan ketik kontroler di URL tanpa melalui Login. Pasang di semua controller
	//Satpam Uzer
	function __construct()
	{
		parent::__construct();//wajib ditulis

		//Jika hak aksesnya bukan 1 (admin) redirect ke controller welcome (halaman login/views formLogin)
		if($this->session->userdata('ss_levl') != '2'){
			$this->session->set_flashdata('pesan', 
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Anda Belum Login
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             </div>');
			redirect('welcome');
		}
	}

	public function index()
	{
		$var['title_body_dashboard'] = 'Dashboard Uzer';

		$this->load->view('templates_uzer/header',$var);
		$this->load->view('templates_uzer/sidebar');
		$this->load->view('uzer/dashboard',$var);
		$this->load->view('templates_uzer/footer');
	}
}