<body>
    <div class="container-fluid">
        <div class="alert alert-success" role="alert">
            <i class="fas fa-university"></i> Iki Tampilan Materi
        </div>

        <div class="card">
            <div class="card-header">
                Materi Modul
                <div id="content" style="float: right;">
                    <p>Waktu tersisa: <span id="timer"></span></p>
                </div>
            </div>
            <div class="card-body">
                <!--<object id="pdf-object" data="<?= base_url('assets/gudang_file/' . $readdata->dvnm . '/' . $readdata->fpdf) ?>" style="max-width: 100%; height: 1000px;" width="100%" download=""></object>-->
                <iframe src="<?= base_url('assets/gudang_file/' . $readdata->dvnm . '/' . $readdata->fpdf . '?v=' . time()) ?>" style="width: 100%; height: 1000px;" frameborder="0"></iframe>

            </div>
        </div>
    </div>

    <?php
    $dateTimeString = $readdata->waktu;
    $iso8601String = str_replace(" ", "T", $dateTimeString);
    $iso8601String = trim($iso8601String); // Menghilangkan spasi ekstra (jika ada)
    ?>

    <script>
        window.onload = function() {
            var currentDateTime = new Date();
            var redirectURL = "<?php echo base_url('uzer/listdoc/index/' . $readdata->dvnm . '/' . $readdata->catgor); ?>"; // URL halaman tujuan

            // Periksa apakah nilai waktu dari database valid (tidak sama dengan '0000-00-00 00:00:00')
            if ("<?= $iso8601String ?>" === "0000-00-00T00:00:00") {
                // Menampilkan SweetAlert jika nilai waktu tidak valid
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Waktu tidak diatur dengan benar di database.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Arahkan ke halaman lain setelah pengguna menekan OK
                    if (result.isConfirmed) {
                        window.location.href = redirectURL;
                    }
                });
                return;
            }

            // Coba parse ISO 8601 string, tambahkan penanganan kesalahan jika format tidak sesuai
            try {
                allowedDateTime = new Date("<?= $iso8601String ?>");
            } catch (error) {
                // Jika terjadi kesalahan dalam parsing tanggal dan waktu, tampilkan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Format waktu tidak sesuai.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Arahkan ke halaman lain setelah pengguna menekan OK
                    if (result.isConfirmed) {
                        window.location.href = redirectURL;
                    }
                });
                return;
            }
            var durationInMinutes = <?= $readdata->dura ?>; // Durasi waktu dalam menit


            var endTime = new Date(allowedDateTime.getTime() + durationInMinutes * 60000); // Hitung waktu akhir berdasarkan durasi

            var timerInterval;

            function updateTimer() {
                var timeDifference = endTime - new Date();
                if (timeDifference <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById("timer").innerHTML = "Waktu habis!";
                    // Menampilkan SweetAlert saat waktu habis
                    Swal.fire({
                        icon: 'info',
                        title: 'Waktu habis!',
                        text: 'Tekan OK untuk melanjutkan.',
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Arahkan ke halaman lain setelah pengguna menekan OK
                        if (result.isConfirmed) {
                            window.location.href = redirectURL;
                        }
                    });
                    return;
                }

                var minutes = Math.floor((timeDifference / 1000 / 60) % 60);
                var seconds = Math.floor((timeDifference / 1000) % 60);

                document.getElementById("timer").innerHTML = minutes + " menit " + seconds + " detik";
            }

            if (currentDateTime >= allowedDateTime) {
                // Tanggal dan waktu saat ini diizinkan
                document.getElementById("content").style.display = "block";
                timerInterval = setInterval(updateTimer, 1000);
                updateTimer();
            } else if (currentDateTime <= allowedDateTime) {
                // Tanggal dan waktu saat ini diluar dari tanggal dan waktu yang diizinkan
                //document.getElementById("outside").style.display = "block";
                // Menampilkan SweetAlert saat di luar waktu yang diizinkan
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses ditolak!',
                    text: 'Anda tidak diizinkan untuk mengakses halaman ini pada saat ini.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Arahkan ke halaman lain setelah pengguna menekan OK
                    if (result.isConfirmed) {
                        window.location.href = redirectURL;
                    }
                });
            }
        };
    </script>