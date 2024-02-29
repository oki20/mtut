<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-tachometer-alt"></i>
        <?php echo $title_body_dashboard; ?>
    </div>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Selamat Datang</h4>
      <p>Selamat Datang <strong><?php echo $this->session->userdata('ss_usnm'); ?></strong> di Management Trainee UT, Anda login sebagai <strong><?php echo $this->session->userdata('ss_levl'); ?></strong></p>
      <hr>
    </div>
</div>