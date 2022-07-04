<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message10') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewAdmin">Tambah Jenis</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Jenis</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($jenis as $t) :
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $t->id_ngaji ?></td>
                                <td><?php echo $t->jenis ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updatepengampu<?= $t->id_ngaji ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deletepengampu<?= $t->id_ngaji ?>"></a>
                                </td>
                            </tr>
                            <!--update donatur-->
                            <div class="modal fade" id="updatepengampu<?= $t->id_ngaji ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Update Pengampu </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('ngaji/update_jenis'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" name="id_ngaji" value="<?php echo $t->id_ngaji ?>">
                                                    <input type="text" class="form-control form-control-user" id="jenis" name="jenis" value="<?php echo $t->jenis ?>">
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
                            <div class="modal fade" id="deletepengampu<?= $t->id_ngaji ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Jenis</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus Jenis <?= $t->jenis ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('ngaji/deletejenis?id_ngaji=') ?><?= $t->id_ngaji ?>" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
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
                <h5 class="modal-title" id="addNewAdminLabel">Tambah Jenis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('ngaji/tambah_jenis'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="id_ngaji" name="id_ngaji" placeholder="Masukan pengampu" value="<?= set_value('id_ngaji'); ?>" hidden>
                        <?= form_error('id_ngaji', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="jenis" name="jenis" placeholder="Masukan nama" value="<?= set_value('jenis'); ?>">
                        <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
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