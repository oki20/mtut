<div class="container-fluid">

	<div class="alert alert-success" role="alert">
		<i class="fas fa-university"></i> Form Create Dokumen
	</div>


	<!--untuk upload gambar harus pakai form open, gabisa pakai form biasa-->
	<?php echo form_open_multipart('Admin/Mntdoc/tambahdata_aksi') ?>

	<div class="form_group">
		<label>DIVISI</label>
		<select name="txtDvnm" class="form-control">
			<option value="">--- Pilih Divisi ---</option>
			<option>delivery</option>
			<option>maintenance</option>
			<option>packing</option>
			<option>production</option>
			<option>project</option>
			<option>purchase</option>
			<option>sales</option>

		</select>
		<?php echo form_error('dvnm', '<div class="text-danger small ml-3">', '</div>') ?>
	</div>

	<div class="form_group">
		<label>DESKRIPSI</label>
		<input type="text" name="txtDscr" placeholder="Masukkan Deskripsi" class="form-control">
		<?php echo form_error('dvnm', '<div class="text-danger small ml-3">', '</div>') ?>
	</div>

	<div class="form_group">
		<label>WAKTU MULAI</label>
		<input type="datetime-local" name="txtWaktu" placeholder="Masukkan Durasi" class="form-control">
		<?php echo form_error('txtWaktu', '<div class="text-danger small ml-3">', '</div>') ?>
	</div>

	<div class="form_group">
		<label>DURASI WAKTU</label>
		<input type="number" name="txtDura" placeholder="Masukkan Durasi" class="form-control">
		<?php echo form_error('dvnm', '<div class="text-danger small ml-3">', '</div>') ?>
	</div>

	<div class="form_group">
		<label>KATEGORI</label>
		<select name="txtCatgor" class="form-control">
			<option value="">--- Pilih Kategori ---</option>
			<option>modul</option>
			<option>test</option>
		</select>
		<?php echo form_error('catgor', '<div class="text-danger small ml-3">', '</div>') ?>
	</div>

	<hr>

	<div class="form_group">
		<label>LINK GFORM</label>
		<input type="text" name="txtLgfo" placeholder="Masukkan Link Google Form" class="form-control">
		<?php echo form_error('docum', '<div class="text-danger small ml-3">', '</div>') ?>
	</div>

	<div class="form-group row mt-3">
		<label class="col-md-2 col-form-label">File Image</label>
		<div class="col-md-10">
			<input type="file" name="txtImage" id="txtImage" class="form-control-file">
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
			<input type="file" name="txtFpdf" id="txtFpdf" class="form-control-file">
		</div>
	</div>
	<div class="mt-2">
		<div class="col">
			<div id="pdfObject" style="max-width: 100%; max-height: 300px; overflow: auto;">
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary mt-3 mb-5">Simpan</button>

	<?php form_close(); ?>

</div>

<!-- Script untuk handle file foto dan PDF untuk modal Add -->
<script>
	// Function to handle image file selection
	function chooseImage() {
		document.getElementById('txtImage').click();
	}

	// Display selected image file
	$('#txtImage').change(function() {
		var file = this.files[0];
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#imagePreview').attr('src', e.target.result).show();
		}

		reader.readAsDataURL(file);
	});

	// Function to handle PDF file selection
	function choosePDF() {
		document.getElementById('txtFpdf').click();
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
	$('#txtFpdf').change(function() {
		var file = this.files[0];
		var reader = new FileReader();

		reader.onload = function(e) {
			displayPDF(e.target.result);
		};

		reader.readAsDataURL(file);
	});
</script>