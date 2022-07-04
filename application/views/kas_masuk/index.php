<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger close" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message5') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewKasmasuk">Tambah Kas Masuk</a>
            <a href="<?= base_url('laporan_kas_masuk/index') ?>" class="btn btn-success mb-3">Cetak Kas Masuk</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id kas</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $saldo = 0;
                        foreach ($kas_masuk as $d) :
                            $date = date_create($d->tgl_transaksi);
                            if ($d->keterangan == 0) {
                                $nominal = $d->nominal;
                                $saldo = $saldo + $d->nominal;
                            }
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d->id_kas ?></td>
                                <td><?= $d->tgl_transaksi ?></td>
                                <td><?= $d->keterangan ?></td>
                                <td><b>Rp. <?= number_format($d->nominal) ?></b></td>
                                <td><b style="text-align:right;">Rp <?= number_format($saldo, 0, ',', '.') ?></b></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updatekasmasuk<?= $d->id_kas ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deletekasmasuk<?= $d->id_kas ?>"></a>
                                </td>
                            </tr>
                            <!--update donatur-->
                            <div class="modal fade" id="updatekasmasuk<?= $d->id_kas ?>" tabindex="-1" role="dialog" aria-labelledby="addNewkasmasukLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewkasmasukLabel">Update Kas Masuk </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('kas_masuk/update'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="id_kas">Id Kas</label><br>
                                                    <input type="hidden" name="id_kas" value="<?php echo $d->id_kas ?>">
                                                    <input type="text" class="form-control form-control-user" id="id_kas" name="id_kas" value="<?php echo $d->id_kas ?>" readonly="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_kas">Tanggal</label><br>
                                                    <input type="date" class="form-control form-control-user" id="tgl_transaksi" name="tgl_transaksi" value="<?php echo $d->tgl_transaksi ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_kas">Keterangan</label><br>
                                                    <input type="text" class="form-control form-control-user" id="keterangan" name="keterangan" value="<?php echo $d->keterangan ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_kas">Nominal</label><br>
                                                    <input type="text" class="form-control form-control-user" id="nominal" name="nominal" value="<?php echo $d->nominal ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="tambah" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--delete donatur-->
                            <div class="modal fade" id="deletekasmasuk<?= $d->id_kas ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Kas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $d->id_kas ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('kas_masuk/deletekasmasuk?id_kas=') ?><?= $d->id_kas ?>" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $no++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewKasmasuk" tabindex="-1" role="dialog" aria-labelledby="addNewkasmasukLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewkasmasukLabel">Tambah Kas Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="kas_masuk" method="post" action="<?= base_url('kas_masuk/tambah_aksi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="tgl_transaksi">Tanggal</label>
                        <input type="date" class="form-control form-control-user" id="tgl_transaksi" name="tgl_transaksi" placeholder="Masukan Nama Tanggal" value="<?= set_value('tgl_transaksi'); ?>">
                        <?= form_error('tgl_transaksi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control form-control-user" id="keterangan" name="keterangan" placeholder="Masukan keterangan" value="<?= set_value('keterangan'); ?>">
                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukan Nominal" value="<?= set_value('nominal'); ?>">
                        <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>