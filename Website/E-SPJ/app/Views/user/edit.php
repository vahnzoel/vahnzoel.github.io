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
                            <form action="/user/update" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <?php foreach ($user as $S) : ?>
                                    <input type="hidden" name="fileLama" value="<?= $S['foto']; ?>">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            < Akun>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="nip">NIP</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('nip')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="nip" autofocus value="<?= (old('nip')) ? old('nip') : $S['nip']; ?>" id="nip" placeholder="NIP">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('nip'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="password">Password</label>
                                        <input type="password" class="form-control <?= ($validasi->hasError('password')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="password" id="password" placeholder="Password">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('password'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="passconfirm">Confirm Password</label>
                                        <input type="password" class="form-control <?= ($validasi->hasError('passconfirm')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="passconfirm" id="passconfirm" placeholder="Confirm Password">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('passconfirm'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            < Profil>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('nama')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $S['nama']; ?>" id="nama" placeholder="Nama Lengkap">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('nama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="alamat">Alamat</label>
                                        <input type="text" class="form-control <?= ($validasi->hasError('alamat')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="alamat" autofocus value="<?= (old('alamat')) ? old('alamat') : $S['alamat']; ?>" id="alamat" placeholder="Alamat">
                                        <div class="invalid-feedback">
                                            <?= $validasi->getError('alamat'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto Profile</label>
                                    </div>
                                    <div class="form-group">
                                        <img src="/uploads/foto/<?= $S['foto']; ?>" class="img-thumbnail img-preview img" width="72" height="72">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= ($validasi->hasError('foto')) ? 'is-invalid' : 'is-valid'; ?>" value="<?= old('foto'); ?>" id="foto" name="foto" onchange="previewImg()">
                                            <div class="invalid-feedback">
                                                <?= $validasi->getError('foto'); ?>
                                            </div>
                                            <label class="custom-file-label" for="foto"><?= $S['foto']; ?></label>
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