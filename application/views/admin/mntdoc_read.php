<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i>
        Maintenance Dokumen
    </div>

    <!--Tampilkan pesen setelah proses submit-->
    <?php echo $this->session->flashdata('pesan') ?>

    <div style="text-align: right;">
        <a href="<?php echo base_url('Admin/Mntdoc/buka_form_tambahdata'); ?>" class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> TAMBAH DOKUMEN
        </a>
    </div>

    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data ku</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Devisi</th>
                            <th>Deskripsi</th>
                            <th>File PDF</th>
                            <th>Link Gform</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Waktu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                        <?php
                        $no = 1;
                        foreach ($dMntdoc as $doc) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $doc['dvnm'] ?></td><!-- Tampilkan data dengan cara sandhika -->
                                <td><?php echo $doc['dscr'] ?></td>
                                <td><?php echo $doc['fpdf'] ?></td>
                                <td><?php echo $doc['lgfo'] ?></td>
                                <td><?php echo $doc['catgor'] ?></td>
                                <td><?php echo $doc['foto'] ?></td>
                                <td><?php echo $doc['waktu'] ?></td>
                                <td>
                                    <a href="<?php echo base_url('Admin/Mntdoc/buka_form_updatedata/' . $doc['kode']); ?>" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?php echo base_url('Admin/Mntdoc/deletedata_aksi/' . $doc['kode']); ?>" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->