<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewUser_access_menu">Tambah Pengguna</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Role id</th>
                            <th>Menu id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($user_access_menu as $a) : ?>
                            <tr>
                                <th><?= $a['id'] ?></th>
                                <td><?= $a['role_id'] ?></td>
                                <td><?= $a['menu_id'] ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updateUser_access_menu<?= $a['id'] ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteUser_access_menu<?= $a['id'] ?>"></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="updateUser_access_menu<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewUser_access_menuLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewUser_access_menuLabel">Update user_access_menu </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('menu/updateuser_access_menu'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label> Id </label><br>
                                                    <input type="text" readonly class="form-control form-control-user" id="id" name="id" value="<?php echo $a['id'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Menu </label><br>
                                                    <input type="text" class="form-control form-control-user" id="role_id" name="role_id" value="<?php echo $a['role_id'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Sort </label><br>
                                                    <input type="text" class="form-control form-control-user" id="menu_id" name="menu_id" value="<?php echo $a['menu_id'] ?>">
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
                            <!--delete pengguna-->
                            <div class="modal fade" id="deleteUser_access_menu<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewdeleteUser_access_menuLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewdeleteUser_access_menuLabel">Hapus Tahun Aktif</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $a['menu_id'] ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('menu/deleteuser_access_menu?id=') ?><?= $a['id'] ?>" class="btn btn-primary">Hapus</a>
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
<div class="modal fade" id="addNewUser_access_menu" tabindex="-1" role="dialog" aria-labelledby="addNewUser_access_menuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewUser_access_menuLabel">Tambah User Access Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form action="<?= base_url('menu/user_access_menu') ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Role id">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="Menu id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>