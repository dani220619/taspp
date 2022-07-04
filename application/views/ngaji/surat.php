<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message10') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewAdmin">Tambah Surat</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Surat</th>
                            <th>Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($surat as $t) :
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $t->id_surat ?></td>
                                <td><?php echo $t->nama_surat ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updatepengampu<?= $t->id_surat ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deletepengampu<?= $t->id_surat ?>"></a>
                                </td>
                            </tr>
                            <!--update donatur-->
                            <div class="modal fade" id="updatepengampu<?= $t->id_surat ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Update Surat </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('ngaji/update_surat'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" name="id_surat" value="<?php echo $t->id_surat ?>">
                                                    <input type="text" class="form-control form-control-user" id="nama_surat" name="nama_surat" value="<?php echo $t->nama_surat ?>">
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
                            <div class="modal fade" id="deletepengampu<?= $t->id_surat ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Surat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus Surat <?= $t->nama_surat ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('ngaji/deletesurat?id_surat=') ?><?= $t->id_surat ?>" class="btn btn-primary">Hapus</a>
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
                <h5 class="modal-title" id="addNewAdminLabel">Tambah Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('ngaji/tambah_surat'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="id_surat" name="id_surat" placeholder="Masukan pengampu" value="<?= set_value('id_surat'); ?>" hidden>
                        <?= form_error('id_surat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama_surat" name="nama_surat" placeholder="Masukan nama surat" value="<?= set_value('nama_surat'); ?>">
                        <?= form_error('nama_surat', '<small class="text-danger pl-3">', '</small>'); ?>
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