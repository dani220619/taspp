<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message12') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewAdmin">Tambah Jenis Pembayaran</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Jenis Pembayaran</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($jen_pembayaran as $t) :
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $t->id ?></td>
                                <td><?php echo $t->jenis_pembayaran ?></td>
                                <td><?= date('d F Y', $t->date_created)  ?></td>

                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updatejenpem<?= $t->id ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deletejenpem<?= $t->id ?>"></a>
                                </td>
                            </tr>
                            <!--update donatur-->
                            <div class="modal fade" id="updatejenpem<?= $t->id ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Update Jenis Pembayaran </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('jenis_pembayaran/update'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="id">Id</label><br>
                                                    <input type="hidden" name="id" value="<?php echo $t->id ?>">
                                                    <input type="text" class="form-control form-control-user" id="id" name="id" value="<?php echo $t->id ?>" readonly="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_pembayaran">Jenis Pembayaran</label><br>
                                                    <input type="text" class="form-control form-control-user" id="jenis_pembayaran" name="jenis_pembayaran" value="<?php echo $t->jenis_pembayaran ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--delete donatur-->
                            <div class="modal fade" id="deletejenpem<?= $t->id ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Jenis Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus Jenis Pembayaran Dengan Nama <?= $t->jenis_pembayaran ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('jenis_pembayaran/delete_jenis_pembayaran?id=') ?><?= $t->id ?>" class="btn btn-primary">Hapus</a>
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
<!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="addNewAdmin" tabindex="-1" role="dialog" aria-labelledby="addNewAdminLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewAdminLabel">Tambah Jenis Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('jenis_pembayaran/tambah_aksi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="id" name="id" placeholder="Masukan id" value="<?= set_value('id'); ?>" hidden>
                        <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="jenis_pembayaran" name="jenis_pembayaran" placeholder="Masukan Jenis Pembayaran" value="<?= set_value('jenis_pembayaran'); ?>">
                        <?= form_error('jenis_pembayaran', '<small class="text-danger pl-3">', '</small>'); ?>
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