<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
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
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card card-secondary">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <?php if (session()->get('id') != 2) { ?>
                                    <a class="btn btn-info btn-sm" href="/crprogram">Tambah</a>
                                <?php } ?>
                                <div class="card-tools">
                                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="/program" method="POST">
                                        <input type="search" class="form-control" name="keyword" placeholder="Cari data...">
                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped projects">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">
                                                No
                                            </th>
                                            <?php if (session()->get('id') == 1 || session()->get('id') == 2) { ?>
                                                <th>
                                                    <center>PPTK</center>
                                                </th>
                                            <?php } ?>
                                            <th>
                                                <center>Program</center>
                                            </th>
                                            <th>
                                                <center>Keterangan</center>
                                            </th>
                                            <?php if (session()->get('id') != 2) { ?>
                                                <th>
                                                    <center>Aksi</center>
                                                </th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($program as $p) : ?>
                                            <tr>
                                                <td>
                                                    <?= $no++; ?>
                                                </td>
                                                <?php if (session()->get('id') == 1 || session()->get('id') == 2) { ?>
                                                    <td>
                                                        <center><?= $p['pptk']; ?></center>
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <center><?= $p['nama_prog']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $p['keterangan_prog']; ?></center>
                                                </td>
                                                <?php if (session()->get('id') != 2) { ?>
                                                    <td class="project-actions text-right">
                                                        <center><a class="btn btn-info btn-sm" href="/edprogram/<?= $p['slug_prog']; ?>">
                                                                <i class="fas fa-pencil-alt">
                                                                </i>
                                                                Edit
                                                            </a>
                                                            <form action="/delprogram/<?= $p['id_program']; ?>" method="POST" class="d-inline">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash">
                                                                    </i>
                                                                    Delete</button>
                                                            </form>
                                                        </center>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <?= $pager->links('program', 'my_pagination'); ?>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>