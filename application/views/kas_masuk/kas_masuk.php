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
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
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

                                $saldo = $saldo + $d->uang_masuk;

                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $d->id_kas ?></td>
                                    <td><?= $d->tgl_transaksi ?></td>
                                    <td><?= $d->keterangan ?></td>
                                    <td><b>Rp. <?= number_format($d->uang_masuk) ?></b></td>
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
                                                <form class="user" method="post" action="<?= base_url('kas/update_kasmasuk'); ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="id_kas">Id Kas</label><br>
                                                        <input type="hidden" name="id_kas" value="<?php echo $d->id_kas ?>">
                                                        <input type="text" class="form-control form-control-user" id="id_kas" name="id_kas" value="<?php echo $d->id_kas ?>" readonly="">
                                                    </div>
                                                    <input type="hidden" name="jenis_kas" value="<?php echo $d->jenis_kas ?>">
                                                    <div class="form-group">
                                                        <label for="tgl_transaksi">Tanggal</label><br>
                                                        <input type="date" class="form-control form-control-user" id="tgl_transaksi" name="tgl_transaksi" value="<?php echo $d->tgl_transaksi ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label><br>
                                                        <input type="text" class="form-control form-control-user" id="keterangan" name="keterangan" value="<?php echo $d->keterangan ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="uang_masuk">Nominal</label><br>
                                                        <input type="text" class="form-control form-control-user" id="uang_masuk" name="uang_masuk" value="<?php echo $d->uang_masuk ?>">
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
                                                <p>Anda yakin ingin menghapus <?= $d->keterangan ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="<?= base_url('kas/deletekasmasuk?id_kas=') ?><?= $d->id_kas ?>" class="btn btn-primary">Hapus</a>
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
                    <form class="kas" method="post" action="<?= base_url('kas/tambah_kasmasuk'); ?>" enctype="multipart/form-data">
                        <input name="tgl_transaksi" class="form-control" type="text" value="<?php echo $tgl_transaksi; ?>" hidden>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control form-control-user" id="keterangan" name="keterangan" placeholder="Masukan keterangan" value="<?= set_value('keterangan'); ?>">
                            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" class="form-control form-control-user" id="uang_masuk" name="uang_masuk" placeholder="Masukan Nominal" value="<?= set_value('uang_masuk'); ?>">
                            <?= form_error('uang_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
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