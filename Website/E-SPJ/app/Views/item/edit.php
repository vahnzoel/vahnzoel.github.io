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
                            <form action="/item/update/<?= $item['id_item']; ?>" method="POST">
                                <div class="form-group">
                                    <label>Pilih Sub Kegiatan</label>
                                    <select class="custom-select" name="sub">
                                        <option value="<?= $item['id_sub']; ?>"><?= $item['nama_sub']; ?></option>
                                        <?php foreach ($sub as $s) : ?>
                                            <option value="<?= $s['id_sub']; ?>"><?= $s['nama_sub']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="rek">Kode Rekening</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('rek')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="rek" autofocus value="<?= (old('rek')) ? old('rek') : $item['rek']; ?>" id="rek" placeholder="Kode Rekening">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('rek'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="uraian">Uraian</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('uraian')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="uraian" autofocus value="<?= (old('uraian')) ? old('uraian') : $item['uraian']; ?>" id="uraian" placeholder="Uraian">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('uraian'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="anggaran">Anggaran</label>
                                    <input type="number" class="form-control <?= ($validasi->hasError('anggaran')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="anggaran" autofocus value="<?= (old('anggaran')) ? old('anggaran') : $item['anggaran']; ?>" id="anggaran" placeholder="anggaran">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('anggaran'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="sisa">Sisa Anggaran</label>
                                    <input type="number" class="form-control <?= ($validasi->hasError('sisa')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="sisa" autofocus value="<?= (old('sisa')) ? old('sisa') : $item['sisa']; ?>" id="sisa" placeholder="sisa">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('sisa'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="cair">Pencairan</label>
                                    <input type="number" class="form-control <?= ($validasi->hasError('cair')) ? 'is-invalid' : 'is-valid'; ?>
                                    " name="cair" autofocus value="<?= (old('cair')) ? old('cair') : $item['cair']; ?>" id="cair" placeholder="cair">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('cair'); ?>
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