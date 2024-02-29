<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Iki Docdata Materi
    </div>

    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th width="20px">NO</th>
            <th>DIVISI</th>
            <th>DESKRIPSI</th>
            <th>FILE PDF</th>
            <th>LINK GFORM</th>
            <th>KATEGORI</th>
            <th>AKSI</th>
        </tr>

        <?php
        $no = 1;
        foreach ($dListdoc as $doc) : ?>
            <tr>

                <?php if ($doc->catgor == 'modul') { ?>

                    <td><?php echo $no++ ?></td>
                    <td><?php echo $doc->dvnm ?></td><!-- Tampilkan data dengan cara frmework indonesia -->
                    <td><?php echo $doc->dscr ?></td>
                    <td><?php echo $doc->fpdf ?></td>
                    <td></td>
                    <td><?php echo $doc->catgor ?></td>
                    <td width="110px">
                        <?php echo anchor('uzer/listdoc/downloadx/' . $doc->dvnm . '/' . $doc->fpdf, '
        				<div class="btn btn-sm btn-primary"><i class="fa fa-download"></i></div>
                        ') ?> |
                        <?php
                        echo anchor(
                            'uzer/listdoc/showPdf/' . $doc->kode,
                            '<div class="btn btn-sm btn-primary"><i class="fa fa-search"></i></div>',
                            'class="download-link"'
                        );
                        ?>
                    </td>

                <?php } else { ?>

                    <td><?php echo $no++ ?></td>
                    <td><?php echo $doc->dvnm ?></td>
                    <td><?php echo $doc->dscr ?></td>
                    <td></td>
                    <td><a target="_blank" href="<?php echo $doc->lgfo ?>"><?php echo $doc->lgfo ?></a></td>
                    <td><?php echo $doc->catgor ?></td>
                    <td></td>

                <?php }; ?>

            </tr>
        <?php endforeach; ?>
    </table>
</div>