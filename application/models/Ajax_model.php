<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_model extends CI_Model
{
	public function getData()
	{
		return $this->db->get_where('tb_docdata')->result_array();
	}

	public function save_data($data)
	{
		return $this->db->insert("tb_docdata", $data);
	}

	public function updateData($id, $data)
	{
		$tableName = 'tb_docdata';
		$primaryKey = 'kode';

		//update data
		$this->db->where($primaryKey, $id);
		$this->db->update($tableName, $data);
	}

	public function deleteData($kode)
	{
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
}
