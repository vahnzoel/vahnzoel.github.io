<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Program</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Program</li>
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
                            <form action="/program/update/<?= $program['id_program']; ?>" method="POST">
                                <input type="hidden" name="slug" value="<?= $program['slug_prog']; ?>">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess">Nama Program</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('program')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="program" autofocus value="<?= (old('program')) ? old('program') : $program['nama_prog']; ?>" id="program" placeholder="Nama Program">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('program'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess">Keterangan</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('keterangan')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="keterangan" autofocus value="<?= (old('keterangan')) ? old('keterangn') : $program['keterangan_prog']; ?>" id="keterangan" placeholder="Keterangan">
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