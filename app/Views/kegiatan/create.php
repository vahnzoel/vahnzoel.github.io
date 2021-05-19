<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah kegiatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah kegiatan</li>
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
                            <form action="/kegiatan/save" method="POST" class="d-inline">
                                <div class="form-group">
                                    <label>Pilih Program</label>
                                    <select class="custom-select" name="program">
                                        <?php foreach ($program as $p) : ?>
                                            <option value="<?= $p['id_program']; ?>"><?= $p['nama_prog']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="kegiatan">Nama Kegiatan</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('kegiatan')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="kegiatan" autofocus value="<?= old('kegiatan'); ?>" id="kegiatan" placeholder="Nama Kegiatan">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('kegiatan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('keterangan')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="keterangan" autofocus value="<?= old('keterangan'); ?>" id="keterangan" placeholder="Keterangan">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('keterangan'); ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Tambah</button>
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