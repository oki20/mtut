<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>

    <div style="text-align: right;">
        <div style="display: inline-block;">
            <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a>
        </div>
    </div>


    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data ku</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="mydata" width="100%" cellspacing="0">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- MODAL ADD -->
<form>
    <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Devisi</label>
                        <div class="col-md-10">
                            <select name="dvnm" id="dvnm" class="form-control">
                                <option value="">--- Pilih Divisi ---</option>
                                <option value="delivery">delivery</option>
                                <option value="maintenance">maintenance</option>
                                <option value="packing">packing</option>
                                <option value="production">production</option>
                                <option value="project">project</option>
                                <option value="purchase">purchase</option>
                                <option value="sales">sales</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Deskripsi</label>
                        <div class="col-md-10">
                            <input type="text" name="dscr" id="dscr" class="form-control" placeholder="Deskripsi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Waktu Mulai</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="waktu" id="waktu" class="form-control" placeholder="Waktu Mulai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Durasi</label>
                        <div class="col-md-10">
                            <input type="number" name="dura" id="dura" class="form-control" placeholder="Durasi Waktu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Link Google Form</label>
                        <div class="col-md-10">
                            <input type="text" name="lgfo" id="lgfo" class="form-control" placeholder="Link Google Form">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kategori</label>
                        <div class="col-md-10">
                            <select name="catgor" id="catgor" class="form-control">
                                <option value="">--- Pilih Kategori ---</option>
                                <option value="modul">Modul</option>
                                <option value="test">Test</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">File Image</label>
                        <div class="col-md-10">
                            <input type="file" name="foto" id="foto" class="form-control-file">
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="col">
                            <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; max-height: 250px; display: none;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">File PDF</label>
                        <div class="col-md-10">
                            <input type="file" name="fpdf" id="fpdf" class="form-control-file">
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="col">
                            <div id="pdfObject" style="max-width: 100%; max-height: 300px; overflow: auto;">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<form>
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kode_edit" id="kode_edit" class="form-control">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Devisi</label>
                        <div class="col-md-10">
                            <select name="dvnm_edit" id="dvnm_edit" class="form-control">
                                <option value="">--- Pilih Divisi ---</option>
                                <option value="delivery">delivery</option>
                                <option value="maintenance">maintenance</option>
                                <option value="packing">packing</option>
                                <option value="production">production</option>
                                <option value="project">project</option>
                                <option value="purchase">purchase</option>
                                <option value="sales">sales</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Deskripsi</label>
                        <div class="col-md-10">
                            <input type="text" name="dscr_edit" id="dscr_edit" class="form-control" placeholder="Product Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Waktu Mulai</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="waktu_edit" id="waktu_edit" class="form-control" placeholder="Waktu Mulai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Durasi</label>
                        <div class="col-md-10">
                            <input type="number" name="dura_edit" id="dura_edit" class="form-control" placeholder="Durasi Waktu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Link Google Form</label>
                        <div class="col-md-10">
                            <input type="text" name="lgfo_edit" id="lgfo_edit" class="form-control" placeholder="Link Google Form">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="foto_edit_exist" id="foto_edit_exist" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="fpdf_edit_exist" id="fpdf_edit_exist" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kategori</label>
                        <div class="col-md-10">
                            <select name="catgor_edit" id="catgor_edit" class="form-control">
                                <option value="">--- Pilih Kategori ---</option>
                                <option value="modul">Modul</option>
                                <option value="test">Test</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-md-2 col-form-label">Product Image</label>
                        <div class="col-md-10">
                            <input type="file" name="foto_edit" id="foto_edit" class="form-control-file">
                            <!--<input type="file" name="foto" id="imageInput" style="display: none;">
                            <button type="button" onclick="chooseImage()" class="btn btn-primary">Choose Image File</button>-->
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="col">
                            <img id="imagePreviewEdit" src="" alt="Image Preview" style="max-width: 100%; max-height: 250px; display: none;">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-md-2 col-form-label">Product PDF</label>
                        <div class="col-md-10">
                            <input type="file" name="fpdf_edit" id="fpdf_edit" class="form-control-file">
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="col">
                            <div id="pdfObjectEdit" style="max-width: 100%; max-height: 300px; overflow: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_edit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL EDIT-->


<script type="text/javascript">
    $(document).ready(function() {
        tampildata();

        $('#mydata').dataTable();

        // Function to show data
        function tampildata() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('admin/ajaxmnt/tampildata') ?>',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no;
                    for (i = 0; i < data.length; i++) {
                        var nomor = i + 1;
                        html += '<tr>' +
                            '<td>' + nomor + '</td>' +
                            '<td>' + data[i].dvnm + '</td>' +
                            '<td>' + data[i].dscr + '</td>' +
                            '<td>' + data[i].fpdf + '</td>' +
                            '<td>' + data[i].lgfo + '</td>' +
                            '<td>' + data[i].catgor + '</td>' +
                            '<td>' + data[i].foto + '</td>' +
                            '<td>' + data[i].waktu + '</td>' +
                            '<td style="text-align:right;">' +
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-kode="' + data[i].kode +
                            '" data-dvnm="' + data[i].dvnm + '" data-dscr="' + data[i].dscr + '" data-fpdf="' + data[i].fpdf + '" data-lgfo="' + data[i].lgfo +
                            '" data-catgor="' + data[i].catgor + '" data-foto="' + data[i].foto + '" data-dura="' + data[i].dura + '" data-waktu="' + data[i].waktu + '">Edit</a>' + ' ' +
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-kode="' + data[i].kode + '">Delete</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }
            });
        }

        // Get data for updating record
        $('#show_data').on('click', '.item_edit', function() {
            // Base URL for images obtained from CodeIgniter base_url() function
            var baseUrl = '<?php echo base_url(); ?>';

            var kode = $(this).data('kode');
            var dvnm = $(this).data('dvnm');
            var dscr = $(this).data('dscr');
            var lgfo = $(this).data('lgfo');
            var dura = $(this).data('dura');
            var catgor = $(this).data('catgor');
            var waktu = $(this).data('waktu');
            var foto = $(this).data('foto');
            var fpdf = $(this).data('fpdf');

            // Construct the URL for the image dynamically
            var foto_preview = baseUrl + 'assets/gudang_file/' + dvnm + '/' + foto;
            // Construct the URL for the PDF dynamically
            var pdf_preview = baseUrl + 'assets/gudang_file/' + dvnm + '/' + fpdf;

            $('#Modal_Edit').modal('show');
            $('[name="kode_edit"]').val(kode);
            $('[name="dvnm_edit"]').val(dvnm);
            $('[name="dscr_edit"]').val(dscr);
            $('[name="lgfo_edit"]').val(lgfo);
            $('[name="dura_edit"]').val(dura);
            $('[name="catgor_edit"]').val(catgor);
            $('[name="waktu_edit"]').val(waktu);
            $('[name="foto_edit_exist"]').val(foto);
            $('[name="fpdf_edit_exist"]').val(fpdf);

            // Set the source of the image preview to foto_preview
            $('#imagePreviewEdit').attr('src', foto_preview).show();
            // Set the source of the PDF preview
            $('#pdfObjectEdit').html('<embed src="' + pdf_preview + '?v=' + Date.now() + '" width="100%" height="100%" type="application/pdf">');
        });


        // Save product
        $('#btn_save').on('click', function() {
            console.log('Tombol Save diklik');
            var dvnm = $('#dvnm').val();
            var dscr = $('#dscr').val();
            var dura = $('#dura').val();
            var lgfo = $('#lgfo').val();
            var catgor = $('#catgor').val();
            var waktu = $('#waktu').val();
            var foto = $('#foto')[0].files[0];
            var fpdf = $('#fpdf')[0].files[0];

            if (dvnm.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Devisi Wajib Di Pilih !'
                });

            } else if (dscr.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Deskripsi Wajib Diisi !'
                });

            } else if (dura.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Deskripsi Wajib Diisi !'
                });

            } else if (catgor.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Deskripsi Wajib Diisi !'
                });

            } else if (waktu.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Deskripsi Wajib Diisi !'
                });

            } else {
                // Form data untuk mengirimkan file
                var formData = new FormData();
                formData.append('dvnm', dvnm);
                formData.append('dscr', dscr);
                formData.append('dura', dura);
                formData.append('lgfo', lgfo);
                formData.append('catgor', catgor);
                formData.append('waktu', waktu);
                formData.append('foto', foto);
                formData.append('fpdf', fpdf); // PDF


                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url() ?>/admin/ajaxmnt/save",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        try {
                            var jsonResponse = JSON.parse(response);
                            if (jsonResponse.status === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Simpan Data Berhasil!'
                                });

                                $('[name="dvnm"]').val("");
                                $('[name="dscr"]').val("");
                                $('[name="dura"]').val("");
                                $('[name="lgfo"]').val("");
                                $('[name="catgor"]').val("");
                                $('[name="waktu"]').val("");
                                $('#Modal_Add').modal('hide');

                                tampildata();
                            } else {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Simpan data Gagal!',
                                    text: 'silahkan coba lagi!'
                                });

                            }
                        } catch (e) {
                            console.error('Error parsing server response:', e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oppss!',
                                text: 'Error parsing server response!!'
                            });
                        }

                        console.log(response);
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Opps!',
                            text: 'server error!'
                        });
                    }
                });
            }

            //return false;
        });

        // Edit product
        $('#btn_edit').on('click', function() {
            // Form data
            var kode = $('#kode_edit').val();
            var dvnm = $('#dvnm_edit').val();
            var dscr = $('#dscr_edit').val();
            var dura = $('#dura_edit').val();
            var lgfo = $('#lgfo_edit').val();
            var catgor = $('#catgor_edit').val();
            var waktu = $('#waktu_edit').val();
            var foto_exist = $('#foto_edit_exist').val();
            var fpdf_exist = $('#fpdf_edit_exist').val();
            var foto = $('#foto_edit')[0].files[0];
            var fpdf = $('#fpdf_edit')[0].files[0];

            // Form data untuk mengirimkan file
            var formData = new FormData();
            formData.append('kode_edit', kode);
            formData.append('dvnm_edit', dvnm);
            formData.append('dscr_edit', dscr);
            formData.append('dura_edit', dura);
            formData.append('lgfo_edit', lgfo);
            formData.append('catgor_edit', catgor);
            formData.append('waktu_edit', waktu);
            formData.append('foto_edit_exist', foto_exist);
            formData.append('fpdf_edit_exist', fpdf_exist);
            formData.append('foto_edit', foto);
            formData.append('fpdf_edit', fpdf);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url() ?>/admin/ajaxmnt/edit",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == "success") {
                        Swal.fire({
                            type: 'success',
                            title: 'Berhasil!',
                            text: 'Update Data Berhasil!'
                        });

                        // Clear form fields and hide modal
                        $('[name="dvnm_edit"]').val("");
                        $('[name="dscr_edit"]').val("");
                        $('[name="dura_edit"]').val("");
                        $('[name="lgfo_edit"]').val("");
                        $('[name="catgor_edit"]').val("");
                        $('[name="waktu_edit"]').val("");
                        $('[name="foto_edit"]').val(""); // Mengosongkan nilai input file foto_edit
                        $('[name="fpdf_edit"]').val(""); // Mengosongkan nilai input file fpdf_edit

                        $('#Modal_Edit').modal('hide');

                        // Reload or update data in your table
                        tampildata();
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Update data Gagal!',
                            text: 'Silahkan coba lagi!'
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops!',
                        text: 'Server error!'
                    });
                }
            });
        });

        // Function to handle delete confirmation
        $('#show_data').on('click', '.item_delete', function() {
            var kode = $(this).data('kode');

            // SweetAlert confirmation before proceeding with deletion
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform actual deletion after confirmation
                    deleteProduct(kode);
                }
            });
        });

        // Function to handle actual deletion using AJAX
        function deleteProduct(kode) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/ajaxmnt/delete') ?>",
                dataType: "JSON",
                data: {
                    kode: kode
                },
                success: function(data) {
                    // Handle success, for example, show success message
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tampildata();
                },
                error: function(xhr, status, error) {
                    // Handle error, for example, show error message
                    Swal.fire({
                        title: 'Error!',
                        text: 'Unable to delete product.',
                        icon: 'error'
                    });
                }
            });
        }
    });
</script>

<!-- Script untuk handle file foto dan PDF untuk modal Add -->
<script>
    // Function to handle image file selection
    function chooseImage() {
        document.getElementById('foto').click();
    }

    // Display selected image file
    $('#foto').change(function() {
        var file = this.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result).show();
        }

        reader.readAsDataURL(file);
    });

    // Function to handle PDF file selection
    function choosePDF() {
        document.getElementById('fpdf').click();
    }

    // Function to render the PDF file
    function renderPDF(url, canvasContainer) {
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            var totalPages = pdf.numPages;

            for (var i = 1; i <= totalPages; i++) {
                pdf.getPage(i).then(function(page) {
                    var scale = 1.5;
                    var viewport = page.getViewport({
                        scale: scale
                    });
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    canvasContainer.appendChild(canvas);

                    page.render(renderContext);
                });
            }
        });
    }

    // Function to display the PDF file
    function displayPDF(pdfUrl) {
        console.log("PDF URL:", pdfUrl); // Log PDF URL for debugging

        var pdfObject = document.getElementById('pdfObject');
        var canvasContainer = document.createElement('div');
        canvasContainer.setAttribute('style', 'max-width: 100%; max-height: 300px; overflow: auto;');

        // Render PDF and handle errors
        try {
            renderPDF(pdfUrl, canvasContainer);
        } catch (error) {
            console.error("Error rendering PDF:", error); // Log error message
            pdfObject.innerHTML = '<p>Error rendering PDF</p>'; // Display error message in case of failure
        }

        pdfObject.innerHTML = ''; // Clear previous content
        pdfObject.appendChild(canvasContainer);
    }

    // Event listener for file input change
    $('#fpdf').change(function() {
        var file = this.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            displayPDF(e.target.result);
        };

        reader.readAsDataURL(file);
    });
</script>

<!-- Script untuk handle file foto dan PDF untuk modal Edit -->
<script>
    // Function to handle image file selection
    function chooseImage() {
        document.getElementById('foto_edit').click(); // Menggunakan ID 'foto_edit' untuk modal edit
    }

    // Display selected image file
    $('#foto_edit').change(function() { // Menggunakan ID 'foto_edit' untuk modal edit
        var file = this.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreviewEdit').attr('src', e.target.result).show();
        }

        reader.readAsDataURL(file);
    });

    // Function to handle PDF file selection
    function choosePDF() {
        document.getElementById('fpdf_edit').click(); // Menggunakan ID 'fpdf_edit' untuk modal edit
    }

    // Event listener for PDF file input change
    $('#fpdf_edit').change(function() { // Menggunakan ID 'fpdf_edit' untuk modal edit
        var file = this.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            displayPDFEdit(e.target.result);
        };

        reader.readAsDataURL(file);
    });

    // Function to render the PDF file
    function renderPDFEdit(url, canvasContainer) {
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            var totalPages = pdf.numPages;

            for (var i = 1; i <= totalPages; i++) {
                pdf.getPage(i).then(function(page) {
                    var scale = 1.5;
                    var viewport = page.getViewport({
                        scale: scale
                    });
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    canvasContainer.appendChild(canvas);

                    page.render(renderContext);
                });
            }
        });
    }

    // Function to display the PDF file
    function displayPDFEdit(pdfUrl) {
        console.log("PDF URL:", pdfUrl); // Log PDF URL for debugging

        var pdfObjectEdit = document.getElementById('pdfObjectEdit');
        var canvasContainer = document.createElement('div');
        canvasContainer.setAttribute('style', 'max-width: 100%; max-height: 300px; overflow: auto;');

        // Render PDF and handle errors
        try {
            renderPDFEdit(pdfUrl, canvasContainer);
        } catch (error) {
            console.error("Error rendering PDF:", error); // Log error message
            pdfObjectEdit.innerHTML = '<p>Error rendering PDF</p>'; // Display error message in case of failure
        }

        pdfObjectEdit.innerHTML = ''; // Clear previous content
        pdfObjectEdit.appendChild(canvasContainer);
    }
</script>