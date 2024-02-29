<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajaxmnt extends CI_Controller
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
        $this->load->model('ajax_model', 'model');
    }

    public function index()
    {
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/mnt_read');
        $this->load->view('templates_admin/footer');
    }

    public function tampildata()
    {
        $dataAll = $this->model->getData();
        echo json_encode($dataAll);
    }

    public function delete()
    {
        $kode = $this->input->post('kode');
        // Panggil model untuk menghapus data
        $result = $this->model->deleteData($kode);
        echo json_encode($result);
    }

    public function save()
    {
        //$data = $this->model->save_data();
        //echo json_encode($data);
        $dvnm   = $this->input->post('dvnm');
        $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : null;
        $fpdf = isset($_FILES['fpdf']['name']) ? $_FILES['fpdf']['name'] : null;

        // Jika ada file gambar yang diunggah
        if (!empty($foto)) {

            // Specify the destination directory with spaces in the path
            $destinationPath = './assets/gudang_file/' . $dvnm . '/';
            // Ensure the destination directory exists; create it if not
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $newImagePath = $destinationPath . $foto;
            move_uploaded_file($_FILES['foto']['tmp_name'], $newImagePath);
        } else {
            // Jika tidak ada gambar yang diunggah, atur path gambar ke null
            $foto = "";
        }

        // Jika ada file PDF yang diunggah
        if (!empty($fpdf)) {

            // Specify the destination directory with spaces in the path
            $destinationPath = './assets/gudang_file/' . $dvnm . '/';
            // Ensure the destination directory exists; create it if not
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $newImagePath = $destinationPath . $fpdf;
            move_uploaded_file($_FILES['fpdf']['tmp_name'], $newImagePath);
        } else {
            // Jika tidak ada PDF yang diunggah, atur path PDF ke null
            $fpdf = "";
        }

        $data = array(
            'dvnm' => $this->input->post('dvnm'),
            'dscr' => $this->input->post('dscr'),
            'fpdf' => $fpdf,
            'lgfo' => $this->input->post('lgfo'),
            'catgor' => $this->input->post('catgor'),
            'docdt' => 1,
            'dura' => $this->input->post('dura'),
            'waktu' => $this->input->post('waktu'),
            'foto' => $foto
        );

        // Insert data via model
        $simpanData = $this->model->save_data($data);

        // Cek apakah data berhasil tersimpan
        if ($simpanData) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function edit()
    {
        $id     = $this->input->post('kode_edit');
        $dvnm   = $this->input->post('dvnm_edit');
        $foto   = isset($_FILES['foto_edit']['name']) ? $_FILES['foto_edit']['name'] : $this->input->post('foto_edit_exist');
        $fpdf   = isset($_FILES['fpdf_edit']['name']) ? $_FILES['fpdf_edit']['name'] : $this->input->post('fpdf_edit_exist');

        // Jika ada file gambar yang diunggah
        if (!empty($_FILES['foto_edit']['tmp_name'])) {
            // Hapus file foto yang lama jika ada
            $oldFoto = $this->input->post('foto_edit_exist');
            if (!empty($oldFoto)) {
                $oldFotoPath = './assets/gudang_file/' . $dvnm . '/' . $oldFoto;
                if (file_exists($oldFotoPath)) {
                    unlink($oldFotoPath);
                }
            }

            // Specify the destination directory with spaces in the path
            $destinationPath = './assets/gudang_file/' . $dvnm . '/';
            // Ensure the destination directory exists; create it if not
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $newImagePath = $destinationPath . $foto;
            move_uploaded_file($_FILES['foto_edit']['tmp_name'], $newImagePath);
        }

        // Jika ada file PDF yang diunggah
        if (!empty($_FILES['fpdf_edit']['tmp_name'])) {
            // Hapus file PDF yang lama jika ada
            $oldPdf = $this->input->post('fpdf_edit_exist');
            if (!empty($oldPdf)) {
                $oldPdfPath = './assets/gudang_file/' . $dvnm . '/' . $oldPdf;
                if (file_exists($oldPdfPath)) {
                    unlink($oldPdfPath);
                }
            }

            // Specify the destination directory with spaces in the path
            $destinationPath = './assets/gudang_file/' . $dvnm . '/';
            // Ensure the destination directory exists; create it if not
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $newPdfPath = $destinationPath . $fpdf;
            move_uploaded_file($_FILES['fpdf_edit']['tmp_name'], $newPdfPath);
        }

        // Update data directly
        $data = array(
            'kode'  => $this->input->post('kode_edit'),
            'dvnm'  => $this->input->post('dvnm_edit'),
            'dscr'  => $this->input->post('dscr_edit'),
            'lgfo'  => $this->input->post('lgfo_edit'),
            'catgor' => $this->input->post('catgor_edit'),
            'waktu' => $this->input->post('waktu_edit'),
            'docdt' => 1,
            'dura'  => $this->input->post('dura_edit'),
            'foto'  => $foto,
            'fpdf'  => $fpdf,
        );

        //$this->db->where('kode', $id);
        //$this->db->update('tb_docdata', $data);
        $this->model->updateData($id, $data);

        // Check if data is successfully updated
        if ($this->db->affected_rows() > 0) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
