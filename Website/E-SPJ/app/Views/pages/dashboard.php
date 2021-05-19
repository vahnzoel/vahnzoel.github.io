<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $title; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <!-- <h3 class="card-title">Title</h3> -->
      </div>
      <?php
      if (session()->get('id') == 1) {
        $status = 'Super Admin';
      } elseif (session()->get('id') == 2) {
        $status = 'Admin';
      } else {
        $status = 'PPTK';
      }

      if (session()->get('id') == 1) {
        $ket = 'Anda memiliki akses penuh terhadap sistem.';
      } elseif (session()->get('id') == 2) {
        $ket = 'Anda memiliki akses melihat semua data dan menambahkan PPTK.';
      } else {
        $ket = 'Anda memiliki akses mencetak NPD dan Upload SPJ.';
      }

      ?>
      <div class="card-body">
        <h1>Selamat Datang <b><?= session()->get('nama'); ?></b></h1><br>
        <h4>Anda login sebagai <b><?= $status; ?></b>. <?= $ket; ?></h4>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <!-- Footer -->
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
  <?php
  $host     = "localhost";
  $username = "brainweb_jyt";
  $password = "@Jyt2021";
  $database = "brainweb_spj_jyt";
  $config = mysqli_connect($host, $username, $password, $database);
  $user = session()->get('id');
  if ($user == 1 || $user == 2) {
    $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM program"));
    $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM kegiatan"));
    $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM subkegiatan"));
    $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM spj"));
  } else {
    $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM program WHERE id_user = '$user'"));
    $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM kegiatan WHERE id_user = '$user'"));
    $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM subkegiatan WHERE id_user = '$user'"));
    $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM spj WHERE id_user = '$user'"));
  }
  ?>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $count1; ?></h3>

              <p><h4><b>Program</b></h4></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-clipboard"></i>
            </div>
            <a href="/program" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $count2; ?></h3>

              <p><h4><b>Kegiatan</b></h4></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-clipboard"></i>
            </div>
            <a href="/kegiatan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $count3; ?></h3>

              <p><h4><b>Sub Kegiatan</b></h4></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-clipboard"></i>
            </div>
            <a href="/subkegiatan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $count4; ?></h3>

              <p><h4><b>SPJ</b></h4></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-clipboard"></i>
            </div>
            <a href="/spj" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
  </section>
</div>
<?= $this->endSection(); ?>