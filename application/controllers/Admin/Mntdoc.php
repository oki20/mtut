<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mntdoc extends CI_Controller
{

	//Agar gabisa masuk halaman dengan ketik kontroler di URL tanpa melalui Login. Pasang di semua controller
	//Satpam Admin
	function __construct()
	{
		parent::__construct(); //wajib ditulis

		//Jika hak aksesnya bukan 1 (admin) redirect ke controller welcome (halaman login/views formLogin)
		if ($this->session->userdata('ss_levl') != '1') {
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
	        Anda Belum Login
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	        </button>
	        </div>'
			);
			redirect('Welcome');
		}
	}

	public function index()
	{
		//$data['dMntdoc'] = $this->mntdoc_model->query_read_pagination($config['per_page'], $data['start'], $data['dKeyword']);
		$data['dMntdoc'] = $this->mntdoc_model->getData();

		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/mntdoc_read', $data); //semua data yang akan dilempar ke view pakai variable yang sama, disini pakai $data, jadi gabisa jika pakai $berbeda
		$this->load->view('templates_admin/footer');
	}

	//klik tombol Tambah Data maka akan tampil mntdoc_create (form input data)
	public function buka_form_tambahdata()
	{
		// $data = array(
		// 	'dvnm'  => set_value('a'),
		// 	'dscr'  => set_value('b'),
		// 	'docum' => set_value('c'),
		// 	'catgor'=> set_value('d')
		// );

		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		//$this->load->view('admin/mntdoc_create',$data);
		$this->load->view('admin/mntdoc_create');
		$this->load->view('templates_admin/footer');
	}

	public function tambahdata_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->buka_form_tambahdata();
		} else {
			$dvnm   = $this->input->post('txtDvnm');
			$dscr   = $this->input->post('txtDscr');
			$catgor = $this->input->post('txtCatgor');
			$lgfo   = $this->input->post('txtLgfo');
			$dura   = $this->input->post('txtDura');
			$waktu   = $this->input->post('txtWaktu');
			$fpdf   = $_FILES['txtFpdf']['name'];
			$foto 	= $_FILES['txtImage']['name'];

			if ($fpdf != '' || $foto != '') {
				// Specify the destination directory with spaces in the path
				$destinationPath = './assets/gudang_file/' . $dvnm . '/';
				// Ensure the destination directory exists; create it if not
				if (!is_dir($destinationPath)) {
					mkdir($destinationPath, 0777, true);
				}

				// Create the full file path, preserving spaces in the file name and path
				$newFilePath = $destinationPath . $fpdf;
				$newImagePath = $destinationPath . $foto;

				// Perform the actual file saving operation
				move_uploaded_file($_FILES['txtFpdf']['tmp_name'], $newFilePath);
				move_uploaded_file($_FILES['txtImage']['tmp_name'], $newImagePath);
			} else {
				// Handle the case where no file is selected
				$this->session->set_flashdata(
					'pesan',
					'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    You did not select a file to upload.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
				);

				redirect('Admin/Mntdoc');
				return;
			}

			$data = array(
				'dvnm'   => $dvnm,
				'dscr'   => $dscr,
				'catgor' => $catgor,
				'lgfo'   => $lgfo,
				'dura' 	 => $dura,
				'waktu' 	 => $waktu,
				'fpdf'   => $fpdf, // Use the original file name
				'foto'   => $foto // Use the original file name
			);

			$this->mntdoc_model->query_create($data, 'tb_docdata');

			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Dokumen Berhasil Ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
			);

			redirect('Admin/Mntdoc');
		}
	}

	//Form view validation
	public function _rules()
	{
		$this->form_validation->set_rules('txtDvnm', 'Divisi', 'required', ['required' => 'Divisi wajib diisi']);
		$this->form_validation->set_rules('txtDscr', 'Description', 'required', ['required' => 'Deskripsi wajib diisi']);
		$this->form_validation->set_rules('txtCatgor', 'Kategori', 'required', ['required' => 'Kategori wajib diisi']);
	}


	public function buka_form_updatedata($id)
	{

		//var_dump($id);die;

		//rubah id menjadi array
		$where = array('kode' => $id);
		//masukkan hasil query ke variable dDocdata
		$var['dDocdata'] = $this->db->query("select * from tb_docdata where kode='$id'")->result();

		//load viewnya
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/mntdoc_update', $var);
		$this->load->view('templates_admin/footer');
	}

	public function updatedata_aksi()
	{
		$this->_rules();
		$id = $this->input->post('txtKode');

		if ($this->form_validation->run() == FALSE) {
			$this->buka_form_tambahdata($id);
		} else {
			$dvnm   = $this->input->post('txtDvnm');
			$dscr   = $this->input->post('txtDscr');
			$catgor = $this->input->post('txtCatgor');
			$lgfo   = $this->input->post('txtLgfo');
			$dura   = $this->input->post('txtDura');
			$waktu 	= $this->input->post('txtWaktu');

			// Check if files are uploaded
			if (!empty($_FILES['txtFpdf']['name']) || !empty($_FILES['txtImage']['name'])) {
				$destinationPath = './assets/gudang_file/' . $dvnm . '/';
				if (!is_dir($destinationPath)) {
					mkdir($destinationPath, 0777, true);
				}

				// Get existing file paths
				$existingFpdf = './assets/gudang_file/' . $dvnm . '/' . $this->input->post('existingFpdf');
				$existingImage = './assets/gudang_file/' . $dvnm . '/' . $this->input->post('existingImage');

				// Delete existing files
				if (file_exists($existingFpdf)) {
					unlink($existingFpdf);
				}
				if (file_exists($existingImage)) {
					unlink($existingImage);
				}

				// Handle PDF file
				$fpdf = $_FILES['txtFpdf']['name'];
				$newFilePath = $destinationPath . $fpdf;
				move_uploaded_file($_FILES['txtFpdf']['tmp_name'], $newFilePath);

				// Handle image file
				$foto = $_FILES['txtImage']['name'];
				$newImagePath = $destinationPath . $foto;
				move_uploaded_file($_FILES['txtImage']['tmp_name'], $newImagePath);
			} else {
				// No files uploaded, retain the existing values
				$fpdf = $this->input->post('existingFpdf');
				$foto = $this->input->post('existingImage');
			}

			$data = array(
				'dvnm'   => $dvnm,
				'dscr'   => $dscr,
				'catgor' => $catgor,
				'lgfo'   => $lgfo,
				'dura'   => $dura,
				'waktu'	 => $waktu,
				// Only update the file fields if files are uploaded
				'fpdf'   => (!empty($_FILES['txtFpdf']['name'])) ? $fpdf : $this->input->post('existingFpdf'),
				'foto'   => (!empty($_FILES['txtImage']['name'])) ? $foto : $this->input->post('existingImage'),
			);

			$where = array('kode' => $id);
			// Assuming you have a model function to update data by id
			$this->mntdoc_model->query_update($where, $data, 'tb_docdata');

			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Dokumen Berhasil Diupdate
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
			);

			redirect('Admin/Mntdoc');
		}
	}


	//Hapus data dan file cara 1
	// public function deletedata_aksi($kodE = null,$dvnM = null,$fpdF = null)
	// {
	// 	//Jika ada data file pdf
	// 	if(!$fpdF == ''){
	// 		//Hapus File
	// 		unlink('./assets/gudang_file/'.$dvnM.'/'.str_replace('%20',' ',$fpdF));
	// 	}

	// 	//Hapus data table
	// 	$where = array('kode'=> $kodE);
	// 	$this->mntdoc_model->query_delete($where,'tb_docdata');
	// 	$this->session->set_flashdata('pesan', 
	//            		'<div class="alert alert-danger alert-dismissible fade show" role="alert">
	//                Data Dokumen Berhasil Didelete
	//                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	//                <span aria-hidden="true">&times;</span>
	//                </button>
	//                </div>');
	// 	redirect('Admin/Mntdoc');	
	// }



	//Hapus data dan file cara 2
	// public function deletedata_aksi($id)
	// {

	// 	$data = $this->mntdoc_model->getDataByID($id)->row();
	// 	if($data->fpdf == ''){
	// 		$delete = $this->mntdoc_model->hapusFile($id);
	// 		redirect('Admin/Mntdoc');
	// 	}else{
	// 		$nama = './assets/gudang_file/'.$data->dvnm.'/'.$data->fpdf;
	// 		if(is_readable($nama) && unlink($nama))
	// 		{
	// 			$delete = $this->mntdoc_model->hapusFile($id);
	// 			redirect('Admin/Mntdoc');
	// 		}else{
	// 			echo "Gagal";
	// 			echo $nama;
	// 		}
	// 	}

	// }

	public function deletedata_aksi($Kode)
	{
		// Ambil nama file gambar dan PDF dari database berdasarkan kode
		$this->db->select('foto, fpdf, dvnm');
		$this->db->where('kode', $Kode);
		$query = $this->db->get('tb_docdata');
		$row = $query->row();
		$foto = $row->foto;
		$fpdf = $row->fpdf;
		$dvnm = $row->dvnm;

		// Hapus data dari tabel tb_docdata
		$this->db->where('kode', $Kode);
		$result = $this->db->delete('tb_docdata');

		// Hapus file foto dari drive jika ada
		if ($result && !empty($foto)) {
			$foto_path = './assets/gudang_file/' . $dvnm . '/' . $foto;
			if (file_exists($foto_path)) {
				unlink($foto_path); // Hapus foto dari drive
			}
		}

		// Hapus file PDF dari drive jika ada
		if ($result && !empty($fpdf)) {
			$fpdf_path = './assets/gudang_file/' . $dvnm . '/' . $fpdf;
			if (file_exists($fpdf_path)) {
				unlink($fpdf_path); // Hapus PDF dari drive
			}
		}

		if ($result) {
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					Data Dokumen Berhasil Dihapus
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
		} else {
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Gagal Menghapus Data Dokumen
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
		}

		redirect('Admin/Mntdoc'); // Ganti dengan URL halaman yang sesuai
	}


	//Hapus data dan file cara 3
	public function deletedata_aksi_original($Kode)
	{
		//$var['xxx'] = $this->mntdoc_model->getDataByKodeMaston('tb_docdata',$Kode)->result();
		$data = $this->mntdoc_model->getDataByKodeMaston('tb_docdata', intval($Kode))->row(); //ambil data dari row table tanpa menampilkan data di URL
		var_dump($Kode);
		//var_dump($data->kode);
		//echo $data->kode;
		//$kodE = $data->kode;



		// if($data->fpdf == ''){
		// 	$where = array('kode'=> $kodE);
		// 	$delete = $this->mntdoc_model->query_delete('tb_docdata',$where);
		// 	redirect('Admin/Mntdoc');
		// }else{
		// 	$nama = './assets/gudang_file/'.$data->dvnm.'/'.$data->fpdf;
		// 	if(is_readable($nama) && unlink($nama))
		// 	{
		// 		$where = array('kode'=> $kodE);
		// 		$delete = $this->mntdoc_model->query_delete('tb_docdata',$where);
		// 		redirect('Admin/Mntdoc');
		// 	}else{
		// 		echo "Gagal";
		// 		echo $nama;
		// 	}
		// }

	}
}
