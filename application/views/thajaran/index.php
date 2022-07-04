<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewAdmin">Tambah Tahun Ajaran</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID tahun</th>
                            <th>Tahun ajaran</th>
                            <th>Besar spp</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tahun_ajaran as $t) :
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $t->id_tahun ?></td>
                                <td><?php echo $t->tahun_ajaran ?></td>
                                <td><?php echo $t->besar_spp ?></td>
                                <td><?php echo $t->Status ?></td>
                                <td>
                                    <a class="btn badge bg-success"><i data-feather="edit" width="20" class="mb-1" data-bs-toggle="modal" data-bs-target="#updatethajaran<?php echo $t->id_tahun ?>"></i>Edit</a>
                                    <a class=" btn badge bg-danger"><i data-feather="trash-2" width="20" class="mb-1" data-bs-toggle="modal" data-bs-target="#hapus_buku<?php echo $t->id_tahun ?>"></i>Hapus</a>
                                </td>
                            </tr>
                            <!--update donatur-->
                            <div class="modal fade" id="updateAjaran<?= $t->id_tahun ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Update Tahun Ajaran </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('th_ajaran/update'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" name="id_tahun" value="<?php echo $t->id_tahun ?>">
                                                    <input type="text" class="form-control form-control-user" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $t->tahun_ajaran ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" id="besar_spp" name="besar_spp" value="<?php echo $t->besar_spp ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status :</label><br>
                                                    &nbsp<input type="radio" name="Status" id="ON" class="with-gap" value="ON" <?php if ($t->Status == 'ON') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?> />
                                                    <label for="ON" class="m-l-20">ON</label>
                                                    <input type="radio" name="Status" id="OFF" class="with-gap" value="OFF" <?php if ($t->Status == 'OFF') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> />
                                                    <label for="OFF" class="m-l-20">OFF</label>
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
                            <div class="modal fade" id="deleteAjaran<?= $t->id_tahun ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Tahun Ajaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus Tahun Ajaran <?= $t->tahun_ajaran ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('th_ajaran/deleteAjaran?id_tahun=') ?><?= $t->id_tahun ?>" class="btn btn-primary">Hapus</a>
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
                <h5 class="modal-title" id="addNewAdminLabel">Tambah Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('th_ajaran/tambah_aksi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="id_tahun" name="id_tahun" placeholder="Masukan id_tahun" value="<?= set_value('id_tahun'); ?>" hidden>
                        <?= form_error('id_tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="tahun_ajaran" name="tahun_ajaran" placeholder="Masukan tahun_ajaran" value="<?= set_value('tahun_ajaran'); ?>">
                        <?= form_error('tahun_ajaran', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="besar_spp" name="besar_spp" placeholder="Masukan besar_spp" value="<?= set_value('besar_spp'); ?>">
                        <?= form_error('besar_spp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Status :</label><br>
                        &nbsp<input type="radio" name="Status" id="ON" class="with-gap" value="ON">
                        <label for="ON" class="m-l-20">ON</label>
                        <input type="radio" name="Status" id="OFF" class="with-gap" value="OFF">
                        <label for="OFF" class="m-l-20">OFF</label>
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