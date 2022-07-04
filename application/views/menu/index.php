<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewMenu">Tambah Menu</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Menu</th>
                            <th>Sort</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($menu as $m) : ?>
                            <tr>
                                <th><?= $m['id'] ?></th>
                                <td><?= $m['menu'] ?></td>
                                <td><?= $m['sort'] ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updateMenu<?= $m['id'] ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteMenu<?= $m['id'] ?>"></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="updateMenu<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewMenuLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewMenuLabel">Update Menu </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('menu/updatemenu'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label> Id </label><br>
                                                    <input type="text" readonly class="form-control form-control-user" id="id" name="id" value="<?php echo $m['id'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Menu </label><br>
                                                    <input type="text" class="form-control form-control-user" id="menu" name="menu" value="<?php echo $m['menu'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Sort </label><br>
                                                    <input type="text" class="form-control form-control-user" id="sort" name="sort" value="<?php echo $m['sort'] ?>">
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
                            <div class="modal fade" id="deleteMenu<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewdeleteMenuLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewdeleteMenuLabel">Hapus Menu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $m['menu'] ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('menu/deleteMenu?id=') ?><?= $m['id'] ?>" class="btn btn-primary">Hapus</a>
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

<div class="modal fade" id="addNewMenu" tabindex="-1" role="dialog" aria-labelledby="addNewMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewMenuLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form action="<?= base_url('menu') ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="sort" name="sort" placeholder="sort">
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