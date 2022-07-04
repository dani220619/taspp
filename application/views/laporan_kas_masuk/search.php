<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php
    $date1 = date_create($this->session->flashdata('tglawal'));
    $date2 = date_create($this->session->flashdata('tglakhir'));
    ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?> : <?= date_format($date1, "d-m-Y") ?> / <?= date_format($date2, "d-m-Y") ?> </h1>
    <form class="form-inline" action="<?= base_url('laporan_kas_masuk/search') ?>" method="post">
        <div class="form-group mb-2">
            <input class="form-control" type="date" id="tanggal_awal" value="<?= $this->session->flashdata('tglawal') ?>" name="tanggal_awal">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input class="form-control" type="date" id="tanggal_akhir" value="<?= $this->session->flashdata('tglakhir') ?>" name="tanggal_akhir">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Search</button>
    </form>
    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-header">
                    Buku Kas Umum
                </div>
                <div class="card-body">
                    <a href="<?= base_url('laporan_kas_masuk/cetak?p=') ?>pdf&tglawal=<?= $this->session->flashdata('tglawal') ?>&tglakhir=<?= $this->session->flashdata('tglakhir') ?>" class=" btn btn-danger mb-4"><i class="fas fa-file-pdf"></i> Download pdf</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id kas</th>
                                    <th>Tipe Kas</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Saldo</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                        $no = 1;
                        $saldo = 0;
                        foreach ($kas_masuk as $d) : 
                            $date = date_create($d['tgl_transaksi']);
                            if ($d['keterangan'] == 0) {
                                $nominal = $d['nominal'];
                                $saldo = $saldo + $d['nominal'];
                            } 
                                ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d['id_kas'] ?></td>
                                <td><?= $d['tipe_kas'] ?></td>
                                <td><?= $d['tgl_transaksi'] ?></td>
                                <td><?= $d['keterangan'] ?></td>
                                <td>Rp. <?= number_format($d['nominal']) ?></b></td>
                                <td><b style="text-align:right;">Rp <?= number_format($saldo, 0, ',', '.') ?></b></td>
                                
                            </tr>
                                <?php $no++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
