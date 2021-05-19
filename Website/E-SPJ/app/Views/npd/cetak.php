<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="/dist/css/font.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">

            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <div class="table-responsive">
                        <center>
                            <table>
                                <tr>
                                    <?php foreach ($instansi as $i) : ?>
                                        <th><img src="/dist/img/<?= $i['logo']; ?>" height="90" width="80"></th>
                                        <td><strong>
                                                <?= $i['nama']; ?><br>
                                                NOTA PENCAIRAN DANA<br>
                                                No : &nbsp;&nbsp;&nbsp;Tanggal :<br><br>
                                            </strong></td>
                                </tr>
                                <tr>
                                    <th><strong>Jenis NPD</strong></th>
                                    <td>: O Panjar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O Tanpa Panjar</strong></td>
                                </tr>
                                <tr>
                                    <th><strong>PPTK</strong></th>
                                    <td>: <?= session()->get('nama'); ?></td>
                                </tr>
                                <tr>
                                    <th><strong>Program</strong></th>
                                    <td>: <?= $sub['nama_prog']; ?></td>
                                </tr>
                                <tr>
                                    <th><strong>Kegiatan</strong></th>
                                    <td>: <?= $sub['nama_keg']; ?></td>
                                </tr>
                                <tr>
                                    <th><strong>Sub Kegiatan</strong></th>
                                    <td>: <?= $sub['nama_sub']; ?></td>
                                </tr>
                                <tr>
                                    <th><strong>No. DPA</strong></th>
                                    <td>: <?= $i['dpa']; ?></td>
                                </tr>
                                <tr>
                                    <th><strong>Tahun Anggaran</strong></th>
                                    <td>: <?= $i['tahun']; ?></td>
                                </tr>
                            </table>
                        </center>
                    </div><br>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>Kode Rekening</center>
                                </th>
                                <th>
                                    <center>Uraian</center>
                                </th>
                                <th>
                                    <center>Anggaran</center>
                                </th>
                                <th>
                                    <center>Sisa Anggaran</center>
                                </th>
                                <th>
                                    <center>Pencairan</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item as $I) : ?>
                                <tr>
                                    <td>
                                        <center><?= $no++; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $I['rek']; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $I['uraian']; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $I['anggaran']; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $I['sisa']; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $I['cair']; ?></center>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3">
                                    <center>Jumlah</center>
                                </td>
                                <td>
                                    <center><?= $sum['anggaran']; ?></center>
                                </td>
                                <td>
                                    <center><?= $sum['sisa']; ?></center>
                                </td>
                                <td>
                                    <center><?= $sum['cair']; ?></center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead"></p>
                    <div class="table-responsive">
                        <center>
                            <tr>Disetujui oleh,</tr><br>
                            <tr>Pengguna Anggaran</tr><br><br><br><br><br>

                            <tr><b><u><?= $i['pimpinan']; ?></u></b></tr><br>
                            <tr>NIP.<?= $i['nip']; ?></tr>
                        </center>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead"></p>
                    <div class="table-responsive">
                        <center>
                            <table>
                                <tr>Disiapkan oleh,</tr><br>
                                <tr>Pejabat Pelaksana Teknis Kegiatan</tr><br><br><br><br><br>

                                <tr><b><u><?= session()->get('nama'); ?></u></b></tr><br>
                                <tr>NIP.<?= session()->get('nip'); ?></tr>
                            </table>
                        </center>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php endforeach; ?>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
    window.addEventListener("load", window.print());
</script>
</body>

</html>