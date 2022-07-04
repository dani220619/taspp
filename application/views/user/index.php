<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message3') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewUser">Tambah Admin</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Level</th>
                            <th>Status Akun</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($bendahara as $d) : ?>
                            <tr id="delete<?php $d->id_bendahara; ?>">
                                <th><?= $id ?></th>
                                <th><?= $d->id_bendahara ?></th>
                                <td><?= $d->name ?></td>
                                <td><?= $d->email ?></td>
                                <td><img src=" assets/img/profile/<?= $d->image ?>" width="50" height="50">
                                </td>
                                <td><?= $d->role_id ?></td>
                                <td><?= $d->is_active ?></td>
                                <td><?= date('d F Y', $d->date_created)  ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updateuser<?= $d->id_bendahara ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteuser<?= $d->id_bendahara ?>"></a>
                                </td>
                            </tr>
                            <!--update user-->
                            <div class="modal fade" id="updateuser<?= $d->id_bendahara ?>" tabindex="-1" role="dialog" aria-labelledby="addNewuserLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewuserLabel">Update User </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('user/update'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label>Id User</label>
                                                    <input type="hidden" name="id_bendahara" value="<?php echo $d->id_bendahara ?>">
                                                    <input type="text" class="form-control form-control-user" id="id_bendahara" name="id_bendahara" value="<?php echo $d->id_bendahara ?>" readonly="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="hidden" name="name" value="<?php echo $d->name ?>">
                                                    <input type="text" class="form-control form-control-user" id="name" name="name" value="<?php echo $d->name ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control form-control-user" id="email" name="email" value="<?php echo $d->email ?>">
                                                </div>
                                                <div class="form-group">
                                                    &nbsp<label>Unggah foto</label><br>
                                                    &nbsp<input type="file" id="image" name="image">
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label>Pilih level:</label>
                                                    <select name="user_role" class="form-control" style="margin-left: 10px;">
                                                        <?php
                                                        foreach ($this->m_admin->tampil_datalevel()->result() as $r) {
                                                        ?>
                                                            <option value="<?php echo $r->id ?>"> <?php echo $r->role ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label>Status akun :</label><br>
                                                    &nbsp<input type="radio" name="is_active" id="1" class="with-gap" value="1" <?php if ($d->is_active == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?> />
                                                    <label for="ON" class="m-l-20">ON</label>
                                                    <input type="radio" name="is_active" id="0" class="with-gap" value="0" <?php if ($d->is_active == '0') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> />
                                                    <label for="OFF" class="m-l-20">OFF</label>
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
                            <!--delete user-->
                            <div class="modal fade" id="deleteuser<?= $d->id_bendahara ?>" tabindex="-1" role="dialog" aria-labelledby="addNewuserLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewuserLabel">Hapus Donat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $d->name ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('user/deleteUser?id_bendahara=') ?><?= $d->id_bendahara ?>" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $id++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewUserLabel">Tambah Admin Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('user/addUser'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" autofocus placeholder="Nama lengkap" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukan email" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        &nbsp<label>Unggah foto</label><br>
                        &nbsp<input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukan password">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Pilih level:</label>
                        <select name="user_role" class="form-control" style="margin-left: 10px;">
                            <?php
                            foreach ($this->m_admin->tampil_datalevel()->result() as $u) {
                            ?>
                                <option value="<?php echo $u->id ?>"> <?php echo $u->role ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Status akun :</label><br>
                        &nbsp<input type="radio" name="is_active" id="1" class="with-gap" value="1">
                        <label for="ON" class="m-l-20">ON</label>
                        <input type="radio" name="is_active" id="0" class="with-gap" value="0">
                        <label for="OFF" class="m-l-20">OFF</label>
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="Tambah_user()" type="submit" name="tambah" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>