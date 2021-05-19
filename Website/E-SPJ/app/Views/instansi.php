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
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card card-secondary">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/instansi/update" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <?php foreach ($instansi as $S) : ?>
                                    <input type="hidden" name="fileLama" value="<?= $S['logo']; ?>">
                                    <div class="form-group">
                                        <label class="col-form-label" for="nama">Nama Instansi</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('nama')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $S['nama']; ?>" id="nama" placeholder="Nama Instansi">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('nama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="alamat">Alamat Instansi</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('alamat')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="alamat" autofocus value="<?= (old('alamat')) ? old('alamat') : $S['alamat']; ?>" id="alamat" placeholder="Alamat Instansi">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('alamat'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Logo Instansi</label>
                                    </div>
                                    <div class="form-group">
                                        <img src="/dist/img/<?= $S['logo']; ?>" class="img-thumbnail img-preview img" width="72" height="72">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= ($validasi->hasError('logo')) ? 'is-invalid' : 'is-valid'; ?>" value="<?= old('logo'); ?>" id="logo" name="logo" onchange="previewImg()">
                                            <div class="invalid-feedback">
                                                <?= $validasi->getError('logo'); ?>
                                            </div>
                                            <label class="custom-file-label" for="logo"><?= $S['logo']; ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="tahun">Tahun Anggaran</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('tahun')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="tahun" autofocus value="<?= (old('tahun')) ? old('tahun') : $S['tahun']; ?>" id="tahun" placeholder="Nomor tahun">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('tahun'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="dpa">Nomor DPA</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('dpa')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="dpa" autofocus value="<?= (old('dpa')) ? old('dpa') : $S['dpa']; ?>" id="dpa" placeholder="Nomor DPA">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('dpa'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="pengguna">Pengguna Anggaran</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('pengguna')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="pengguna" autofocus value="<?= (old('pengguna')) ? old('pengguna') : $S['pengguna']; ?>" id="pengguna" placeholder="Nama pengguna">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('pengguna'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="nip">NIP Pengguna Anggaran</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('nip')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="nip" autofocus value="<?= (old('nip')) ? old('nip') : $S['nip']; ?>" id="nip" placeholder="Nomor nip">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('nip'); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <button type="submit" class="btn btn-info">Update</button>
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