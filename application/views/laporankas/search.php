<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php
    $date1 = date_create($this->session->flashdata('tglawal'));
    $date2 = date_create($this->session->flashdata('tglakhir'));
    ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?> : <?= date_format($date1, "d-m-Y") ?> / <?= date_format($date2, "d-m-Y") ?> </h1>
    <form class="form-inline" action="<?= base_url('laporankas/search') ?>" method="post">
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
                    <!-- <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#cetakLaporan"><i class="fas fa-print"></i> Cetak Buku Kas Umum</a> -->
                    <!-- <a href="<?= base_url('laporankas/cetak?p=') ?>excel&tglawal=<?= $this->session->flashdata('tglawal') ?>&tglakhir=<?= $this->session->flashdata('tglakhir') ?>" class=" btn btn-success mb-4"><i class="fas fa-file-excel"></i> Download Excel</a> -->
                    <a href="<?= base_url('laporankas/cetak?p=') ?>pdf&tglawal=<?= $this->session->flashdata('tglawal') ?>&tglakhir=<?= $this->session->flashdata('tglakhir') ?>" class=" btn btn-danger mb-4"><i class="fas fa-file-pdf"></i> Download pdf</a>
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Id Kas</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Kas Masuk</th>
                                    <th scope="col">Kas Keluar</th>
                                    <th scope="col">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $_saldo = 0;
                                foreach ($saldo_awal as $s) :
                                    if ($s['debit'] == 0) {
                                        $nominal = $s['kredit'];
                                        $_saldo = $_saldo - $nominal;
                                    } else {
                                        $nominal = $s['debit'];
                                        $_saldo = $_saldo + $nominal;
                                    }
                                endforeach;
                                ?>
                                <?php
                                if ($_saldo != 0) {
                                    $saldo = $_saldo;
                                } else {
                                    $saldo = 0;
                                }
                                $i = 1;
                                foreach ($jurnal as $d) :
                                    $date = date_create($d['tgl_transaksi']);
                                    if ($d['debit'] == 0) {
                                        $nominal = $d['kredit'];
                                        $saldo = $saldo - $nominal;
                                    } else {
                                        $nominal = $d['debit'];
                                        $saldo = $saldo + $nominal;
                                    }
                                ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= date_format($date, "d F Y") ?></td>
                                        <td><?= $d['id_kas'] ?></td>
                                        <?php if ($bendahara['role_id'] == 3 &&  substr($d['keterangan'], 0, 10) == 'Donasi A/n') { ?>
                                            <td><?= substr($d['keterangan'], 0, 10) ?> ****************</td>
                                        <?php } else { ?>
                                            <td><?= $d['keterangan'] ?></td>
                                        <?php } ?>
                                        <td style="text-align:right;">Rp <?= number_format($d['debit'], 0, ',', '.') ?></td>
                                        <td style="text-align:right;">Rp <?= number_format($d['kredit'], 0, ',', '.') ?></td>
                                        <td><b style="text-align:right;">Rp <?= number_format($saldo, 0, ',', '.') ?></b>
                                        </td>
                                    </tr>
                                <?php $i++;
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
