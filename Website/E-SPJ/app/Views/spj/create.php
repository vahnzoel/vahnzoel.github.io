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
                            <form action="/spj/save" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label>Pilih Program</label>
                                    <select class="custom-select" name="program">
                                        <?php foreach ($program as $p) : ?>
                                            <option value="<?= $p['id_program']; ?>"><?= $p['nama_prog']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Kegiatan</label>
                                    <select class="custom-select" name="kegiatan">
                                        <?php foreach ($kegiatan as $k) : ?>
                                            <option value="<?= $k['id_kegiatan']; ?>"><?= $k['nama_keg']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Sub Kegiatan</label>
                                    <select class="custom-select" name="sub">
                                        <?php foreach ($sub as $s) : ?>
                                            <option value="<?= $s['id_sub']; ?>"><?= $s['nama_sub']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>File SPJ</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= ($validasi->hasError('file')) ? 'is-invalid' : 'is-valid'; ?>" id="file" name="file" onchange="fileUpload()">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('file'); ?>
                                        </div>
                                        <label class="custom-file-label" for="file">Pilih file</label>
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