<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mntdoc_model extends CI_Model
{

	//Tanpa pagination
	public function query_read($table)
	{
		return $this->db->get($table);
	}


	public function getData()
	{
		return $this->db->get_where('tb_docdata')->result_array();
	}

	//Pagination
	public function query_read_pagination($batas, $mulai, $keyword = null)
	{
		//Query result menggunakan cara framework indonesia
		//return $this->db->get('tb_docdata',$batas,$mulai);

		//jika keyword ada nilainya
		if ($keyword) {
			$this->db->like('dvnm', $keyword);
			$this->db->or_like('dscr', $keyword);
			$this->db->or_like('fpdf', $keyword);
			$this->db->or_like('catgor', $keyword);
		}
		//Query result menggunakan cara sandhika
		return $this->db->get('tb_docdata', $batas, $mulai)->result_array();
	}



	//utk pagination juga
	public function query_countAllData()
	{
		return $this->db->get('tb_docdata')->num_rows();
	}


	public function query_create($data, $table)
	{
		$this->db->insert($table, $data);
	}


	public function query_update($where, $data, $table)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}


	//Hapus data dan file cara 2
	// public function query_delete($where,$table)
	// {
	// 	$this->db->where($where);
	// 	$this->db->delete($table);
	// }



	//Hapus data dan file cara 2
	// public function getDataByID($id)
	// {
	// 	$this->db->where('kode',$id);
	// 	return $this->db->get('tb_docdata');
	// }
	// public function hapusFile($id)
	// {
	// 	$this->db->where('kode',$id);
	// 	return $this->db->delete('tb_docdata');
	// }


	//Hapus data dan file cara 3
	public function getDataByKodeMaston($table, $where)
	{
		//$this->db->where($where);
		//return $this->db->get($table);

		//$this->db->get_where($table,$where);
		return $this->db->get_where($table, $where);
	}
	public function query_delete($where, $table)
	{
		$this->db->delete($table);
		$this->db->where($where);
	}

	public function deleteData()
	{
		$kode = $this->input->post('kode');

		// Ambil nama file gambar dan PDF dari database berdasarkan kode
		$this->db->select('foto, fpdf, dvnm');
		$this->db->where('kode', $kode);
		$query = $this->db->get('tb_docdata');
		$row = $query->row();
		$foto = $row->foto;
		$fpdf = $row->fpdf;
		$dvnm = $row->dvnm;

		// Hapus data dari tabel tb_docdata
		$this->db->where('kode', $kode);
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

		return $result;
	}


	public function save_dataku()
	{
		/*$dvnm   = $this->input->post('txtDvnm');
		$dscr   = $this->input->post('txtDscr');
		$catgor = $this->input->post('txtCatgor');
		$lgfo   = $this->input->post('txtLgfo');
		$dura   = $this->input->post('txtDura');
		$fpdf   = $_FILES['txtFpdf']['name'];
		$foto   = $_FILES['txtImage']['name'];

		// Check if file uploads are successful
		if (!empty($fpdf) && !empty($foto)) {
			$destinationPath = './assets/gudang_file/' . $dvnm . '/';
			if (!is_dir($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}

			$newFilePath = $destinationPath . $fpdf;
			$newImagePath = $destinationPath . $foto;

			// Check if files are moved successfully
			if (move_uploaded_file($_FILES['txtFpdf']['tmp_name'], $newFilePath) && move_uploaded_file($_FILES['txtImage']['tmp_name'], $newImagePath)) {
				$data = array(
					'dvnm'   => $dvnm,
					'dscr'   => $dscr,
					'catgor' => $catgor,
					'lgfo'   => $lgfo,
					'dura'   => $dura,
					'fpdf'   => $fpdf,
					'foto'   => $foto
				);
			}
		} else {
			
		}*/
		$data = array(
			'dvnm'   => $this->input->post('txtDvnm'),
			'dscr'   => $this->input->post('txtDscr'),
			'catgor' => $this->input->post('txtCatgor'),
			'lgfo'   => $this->input->post('txtLgfo'),
			'dura'   => $this->input->post('txtDura'),
			'fpdf'	 => $_FILES['txtFpdf']['name'],
			'foto'	 => $_FILES['txtImage']['name']
		);

		$result = $this->db->insert('tb_docdata', $data);
		return $result;
	}
	public function save_data_second()
	{
		// Dapatkan data dari input
		$dvnm = $this->input->post('dvnm');
		$dscr = $this->input->post('dscr');
		$dura = $this->input->post('dura');
		$lgfo = $this->input->post('lgfo');
		$catgor = $this->input->post('catgor');

		// Jika ada file gambar yang diunggah
		if (!empty($_FILES['foto']['name'])) {
			// Konfigurasi untuk upload gambar
			$image_config['upload_path'] = './uploads/images/';
			$image_config['allowed_types'] = 'jpg|jpeg|png|gif';
			$image_config['max_size'] = 2048; // Ukuran maksimum file (dalam kilobita)
			$image_config['overwrite'] = TRUE;

			$this->load->library('upload', $image_config);

			if (!$this->upload->do_upload('foto')) {
				// Jika upload gambar gagal, kembalikan pesan error
				return $this->upload->display_errors();
			} else {
				// Jika upload gambar berhasil, simpan nama file asli ke database
				$image_path = $_FILES['foto']['name']; // Menggunakan nama asli
			}
		} else {
			// Jika tidak ada gambar yang diunggah, atur path gambar ke null
			$image_path = "";
		}

		// Jika ada file PDF yang diunggah
		if (!empty($_FILES['fpdf']['name'])) {
			// Konfigurasi untuk upload PDF
			$pdf_config['upload_path'] = './uploads/pdfs/';
			$pdf_config['allowed_types'] = 'pdf';
			$pdf_config['max_size'] = 2048; // Ukuran maksimum file (dalam kilobita)
			$pdf_config['overwrite'] = TRUE;

			$this->upload->initialize($pdf_config);

			if (!$this->upload->do_upload('fpdf')) {
				// Jika upload PDF gagal, kembalikan pesan error
				return $this->upload->display_errors();
			} else {
				// Jika upload PDF berhasil, simpan nama file asli ke database
				$pdf_path = $_FILES['fpdf']['name']; // Menggunakan nama asli
			}
		} else {
			// Jika tidak ada PDF yang diunggah, atur path PDF ke null
			$pdf_path = "";
		}


		// Data untuk disimpan ke database
		$data = array(
			'dvnm' => $dvnm,
			'dscr' => $dscr,
			'fpdf' => $pdf_path,
			'lgfo' => $lgfo,
			'catgor' => $catgor,
			'docdt' => 1,
			'dura' => $dura,
			'foto' => $image_path

		);

		// Simpan data ke database

		$result = $this->db->insert('tb_docdata', $data);
		return $result;
	}

	public function save_data($data)
	{
		return $this->db->insert("tb_docdata", $data);
	}
}
