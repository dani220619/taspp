<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewSantri">Tambah Santri</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Foto</th>
                            <th>Nama Santri</th>
                            <th>email</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Ayah</th>
                            <th>Ibu</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($santri as $d) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d->nis ?></td>
                                <td><img src=" assets/img/santri/<?= $d->image ?>" width="50" height="50">
                                </td>
                                <td><?= $d->nama_santri ?></td>
                                <td><?= $d->email ?></td>
                                <td><?= $d->tanggal_lahir ?></td>
                                <td><?= $d->jenis_kelamin ?></td>
                                <td><?= $d->alamat ?></td>
                                <td><?= $d->no_hp ?></td>
                                <td><?= $d->ayah ?></td>
                                <td><?= $d->ibu ?></td>
                                <td><?= date('d F Y', $d->date_created)  ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updatesantri<?= $d->nis ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteDonatur<?= $d->nis ?>"></a>
                                </td>
                            </tr>
                            <!--update Santri-->
                            <div class="modal fade" id="updatesantri<?= $d->nis ?>" tabindex="-1" role="dialog" aria-labelledby="addNewsantriLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewsantriLabel">Update Santri </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('santri/update'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label> NIS </label><br>
                                                    <input type="number" class="form-control form-control-user" name="nis" value="<?php echo $d->nis ?>" readonly="">
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label> Nama Santri</label><br>
                                                    <input type="text" class="form-control form-control-user" id="nama_santri" name="nama_santri" value="<?php echo $d->nama_santri ?>">
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    &nbsp<label>Unggah foto</label><br>
                                                    &nbsp<input type="file" id="image" name="image">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label><br>
                                                    &nbsp<input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="with-gap" value="laki-laki" <?php if ($d->jenis_kelamin == 'laki-laki') {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        } ?> />
                                                    <label for="laki-laki" class="m-l-20">Laki Laki</label>
                                                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="with-gap" value="perempuan" <?php if ($d->jenis_kelamin == 'perempuan') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?> />
                                                    <label for="perempuan" class="m-l-20">Perempuan</label>
                                                </div>
                                                <div class="form-group">
                                                    <label> Alamat </label><br>
                                                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" value="<?php echo $d->alamat ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> No HP </label><br>
                                                    <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" value="<?php echo $d->no_hp ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Ayah</label><br>
                                                    <input type="text" class="form-control form-control-user" id="ayah" name="ayah" value="<?php echo $d->ayah ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Ibu</label><br>
                                                    <input type="text" class="form-control form-control-user" id="ibu" name="ibu" value="<?php echo $d->ibu ?>">
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
                            <div class="modal fade" id="deleteDonatur<?= $d->nis ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Santri</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $d->nama_santri ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('santri/deleteSantri?nis=') ?><?= $d->nis ?>" class="btn btn-primary">Hapus</a>
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
<!-- Modal -->
<div class="modal fade" id="addNewSantri" tabindex="-1" role="dialog" aria-labelledby="addNewSantriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSantriLabel">Tambah Santri Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="santri" method="post" action="<?= base_url('santri/tambah_aksi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nis">NIS</label><br>
                        <input type="text" class="form-control form-control-user" id="nis" name="nis" placeholder="Masukan NIS" value="<?= set_value('nis'); ?>" required>
                        <?= form_error('nis', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_santri">Nama Santri</label>
                        <input type="text" class="form-control form-control-user" id="nama_santri" name="nama_santri" placeholder="Masukan Nama Santri" value="<?= set_value('nama_santri'); ?>">
                        <?= form_error('nama_santri', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        &nbsp<label>Unggah foto</label><br>
                        &nbsp<input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukan email" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="laki-laki">Jenis Kelamin</label><br>
                        &nbsp<input type="radio" name="jenis_kelamin" id="laki-laki" class="with-gap" value="laki-laki">
                        <label for="laki-laki" class="m-l-20">Laki-Laki</label>
                        <input type="radio" name="jenis_kelamin" id="perempuan" class="with-gap" value="perempuan">
                        <label for="perempuan" class="m-l-20">perempuan</label>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-user" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= set_value('tanggal_lahir'); ?>">
                        <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukan password">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukan Alamat Santri" value="<?= set_value('alamat'); ?>">
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="no_hp_santri">No. HP Santri</label>
                        <input type="text" class="form-control form-control-user" id="no_hp_santri" name="no_hp" placeholder="Masukan Nomor Hp Santri" value="<?= set_value('no_hp'); ?>">
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="ayah">Ayah</label>
                        <input type="text" class="form-control form-control-user" id="ayah" name="ayah" placeholder="Masukan Nama Ayah" value="<?= set_value('ayah'); ?>">
                        <?= form_error('ayah', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="ibu">Ibu</label>
                        <input type="text" class="form-control form-control-user" id="ibu" name="ibu" placeholder="Masukan Nama" value="<?= set_value('ibu'); ?>">
                        <?= form_error('ibu', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group" hidden>
                        <input type="text" class="form-control form-control-user" id="role_id" name="role_id" value="3">
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