<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif ?>
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newsubmenu">Add New Submenu</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Url</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($submenu as $sm) : ?>
                            <tr>
                                <th><?= $no++ ?> </th>
                                <th><?= $sm['id'] ?></th>
                                <td><?= $sm['title'] ?></td>
                                <td><?= $sm['menu'] ?></td>
                                <td><?= $sm['url'] ?></td>
                                <td><?= $sm['icon'] ?></td>
                                <td><?= $sm['is_active'] ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updateSubmenu<?= $sm['id'] ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteSubmenu<?= $sm['id'] ?>"></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="updateSubmenu<?= $sm['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewMenuLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewMenuLabel">Update Submenu </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('menu/updateSubmenu'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label> Id </label><br>
                                                    <input type="text" readonly class="form-control form-control-user" id="id" name="id" value="<?php echo $sm['id'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Title </label><br>
                                                    <input type="text" class="form-control form-control-user" id="title" name="title" value="<?php echo $sm['title'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Menu </label><br>
                                                    <select name="menu_id" id="menu_id" class="form-control">
                                                        <?php foreach ($menu as $m) : ?>
                                                            <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label> Url </label><br>
                                                    <input type="text" class="form-control form-control-user" id="url" name="url" value="<?php echo $sm['url'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label> Icon </label><br>
                                                    <input type="text" class="form-control form-control-user" id="icon" name="icon" value="<?php echo $sm['icon'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" checked value="1" id="is_active" name="is_active">
                                                        <label class="form-check-label" for="is_active">
                                                            Active?
                                                        </label>
                                                    </div>
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
                            <div class="modal fade" id="deleteSubmenu<?= $sm['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewdeleteSubmenuLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewdeleteSubmenuLabel">Hapus Submenu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $sm['title'] ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('menu/deleteSubmenu?id=') ?><?= $sm['id'] ?>" class="btn btn-primary">Hapus</a>
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

<div class="modal fade" id="newsubmenu" tabindex="-1" role="dialog" aria-labelledby="newsubmenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newsubmenuLabel">Add new menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu') ?>" method="post">
                <div class="p-5">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="submenu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked value="1" id="is_active" name="is_active">
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Submenu</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus???
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>