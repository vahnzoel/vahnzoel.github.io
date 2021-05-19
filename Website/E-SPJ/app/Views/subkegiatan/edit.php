<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-11 mx-auto">
                    <!-- general form elements disabled -->
                    <div class="card card-secondary">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/subkegiatan/update/<?= $sub['id_sub']; ?>" method="POST">
                                <input type="hidden" name="slug" value="<?= $sub['slug_sub']; ?>">
                                <div class="form-group">
                                    <label>Nama Program</label>
                                    <select class="custom-select" name="program">
                                        <option value="<?= $sub['id_program']; ?>"><?= $sub['nama_prog']; ?></option>
                                        <?php foreach ($program as $k) : ?>
                                            <option value="<?= $k['id_program']; ?>"><?= $k['nama_prog']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <select class="custom-select" name="kegiatan">
                                        <option value="<?= $sub['id_kegiatan']; ?>"><?= $sub['nama_keg']; ?></option>
                                        <?php foreach ($kegiatan as $k) : ?>
                                            <option value="<?= $k['id_kegiatan']; ?>"><?= $k['nama_keg']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess">Nama Sub kegiatan</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('sub')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="sub" autofocus value="<?= (old('sub')) ? old('sub') : $sub['nama_sub']; ?>" id="sub" placeholder="Nama Sub kegiatan">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('sub'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess">Keterangan</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('keterangan')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="keterangan" value="<?= (old('keterangan')) ? old('keterangan') : $sub['keterangan_sub']; ?>" id="keterangan" placeholder="Keterangan">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('keterangan'); ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info toastrDefaultSuccess">Edit</button>
                            </form>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>