<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	public function index()
	{

		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$var['title_judul'] = "MTUT LOGIN";

			$this->load->view('templates_admin/header', $var);
			$this->load->view('templates_uzer/header', $var);
			$this->load->view('login');
		} else {
			$username = $this->input->post('txtUsnm');
			$password = $this->input->post('txtPasw');

			$cek = $this->login_model->query_cek_login($username, $password);

			if ($cek == FALSE) {
				$this->session->set_flashdata(
					'pesan',
					'<div class="alert alert-success alert-danger fade show" role="alert">
                Username atau Password salah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
				);
				redirect('welcome');
			} else {
				$this->session->set_userdata('ss_levl', $cek->levl);
				$this->session->set_userdata('ss_usnm', $cek->usnm); //untuk tampilin nama di selamat datang di pojok kanan atas
				$this->session->set_userdata('ss_foto', $cek->foto); //untuk tampilin foto di pojok kanan atas
				$this->session->set_userdata('ss_id', $cek->id); //untuk tampilin foto di pojok kanan atas

				switch ($cek->levl) {
					case 1:
						redirect('admin/dashboard');
						break;
					case 2:
						redirect('uzer/dashboard');
						break;
					default:
						break;
				}
			}
		}
	}


	public function _rules()
	{
		$this->form_validation->set_rules('txtPasw', 'username', 'required');
		$this->form_validation->set_rules('txtPasw', 'password', 'required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}
}
