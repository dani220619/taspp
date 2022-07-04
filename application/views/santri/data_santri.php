<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message2') ?>
            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewSantri">Tambah Santri</a> -->
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama Santri</th>
                            <th>Kamar</th>
                            <th>Pengampu</th>
                            <th>Jenis</th>
                            <th>Surat/Juz</th>
                            <th>Wali Kelas</th>
                            <th>Kelas</th>
                            <th>Univ</th>
                            <th>Jurusan</th>
                            <th>Angkatan</th>
                            <th>Status</th>
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
                                <td><?= $d->nama_santri ?></td>
                                <td><?= $d->kamar ?></td>
                                <td><?= $d->pengampu ?></td>
                                <td><?= $d->jenis ?></td>
                                <td><?= $d->surat ?></td>
                                <td><?= $d->wali_kelas ?></td>
                                <td><?= $d->kelas ?></td>
                                <td><?= $d->univ ?></td>
                                <td><?= $d->jurusan ?></td>
                                <td><?= $d->angkatan ?></td>
                                <td><?= $d->status ?></td>

                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updatesantri<?= $d->nis ?>"></a>
                                    <!-- <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteDonatur<?= $d->nis ?>"></a> -->
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
                                            <form class="user" method="post" action="<?= base_url('santri/update_santri'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label> NIS </label><br>
                                                    <input type="number" class="form-control form-control-user" name="nis" value="<?php echo $d->nis ?>" readonly="">
                                                </div>

                                                <div class="form-group">
                                                    <label> Nama Santri</label><br>
                                                    <input type="text" class="form-control form-control-user" id="nama_santri" name="nama_santri" value="<?php echo $d->nama_santri ?>" readonly>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="kamar">kamar</label>
                                                    <input type="text" class="form-control form-control-user" id="kamar" name="kamar" placeholder="Masukan kamar Santri" value="<?php echo $d->kamar ?>"">
                                                    <?= form_error('kamar', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>

                                                <div class=" form-group">
                                                    <label> Pengampu</label><br>
                                                    <select id="tahun-ajaran" name="pengampu" class="form-control form-control-user" value="<?php echo $d->pengampu ?>">
                                                        <option value=""> Pilih </option>
                                                        <?php
                                                        foreach ($this->db->query('SELECT nama FROM pengampu')->result() as $p) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                                        ?>
                                                            <option value="<?php echo $p->nama ?>" <?= $p->nama == $d->pengampu ? "selected" : null ?>> <?php echo $p->nama . '' ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label> Jenis</label><br>
                                                    <select id="tahun-ajaran" name="jenis" class="form-control form-control-user" value="<?php echo $d->jenis ?>">
                                                        <option value=""> Pilih </option>
                                                        <?php
                                                        foreach ($this->db->query('SELECT jenis FROM jenis_ngaji')->result() as $p) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                                        ?>
                                                            <option value="<?php echo $p->jenis ?>" <?= $p->jenis == $d->jenis ? "selected" : null ?>> <?php echo $p->jenis . '' ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label> Surat/Juz</label><br>
                                                    <select id="tahun-ajaran" name="surat" class="form-control form-control-user" value="<?php echo $d->surat ?>">
                                                        <option value=""> Pilih </option>
                                                        <?php
                                                        foreach ($this->db->query('SELECT nama_surat FROM surat')->result() as $p) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                                        ?>
                                                            <option value="<?php echo $p->nama_surat ?>" <?= $p->nama_surat == $d->surat ? "selected" : null ?>> <?php echo $p->nama_surat . '' ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label> Wali Kelas</label><br>
                                                    <select id="tahun-ajaran" name="wali_kelas" class="form-control form-control-user" value="<?php echo $d->wali_kelas ?>">
                                                        <option value=""> Pilih </option>
                                                        <?php
                                                        foreach ($this->db->query('SELECT wali_kelas FROM wali_kelas')->result() as $p) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                                        ?>
                                                            <option value="<?php echo $p->wali_kelas ?>" <?= $p->wali_kelas == $d->wali_kelas ? "selected" : null ?>> <?php echo $p->wali_kelas . '' ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelas">Kelas</label>
                                                    <input type="text" class="form-control form-control-user" id="kelas" name="kelas" placeholder="Masukan kelas Santri" value="<?php echo $d->kelas ?>"">
                                                    <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="univ">Univ</label>
                                                    <input type="text" class="form-control form-control-user" id="univ" name="univ" placeholder="Masukan univ Santri" value="<?php echo $d->univ ?>"">
                                                    <?= form_error('univ', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="jurusan">Jurusan</label>
                                                    <input type="text" class="form-control form-control-user" id="jurusan" name="jurusan" placeholder="Masukan jurusan Santri" value="<?php echo $d->jurusan ?>"">
                                                    <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="angkatan">Angkatan</label>
                                                    <input type="text" class="form-control form-control-user" id="angkatan" name="angkatan" placeholder="Masukan angkatan Santri" value="<?php echo $d->angkatan ?>"">
                                                    <?= form_error('angkatan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="status">Status</label>
                                                    <input type="text" class="form-control form-control-user" id="status" name="status" placeholder="Masukan status Santri" value="<?php echo $d->status ?>"">
                                                    <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div class=" modal-footer">
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
                                            <a href="<?= base_url('santri/deletengaji?nis=') ?><?= $d->nis ?>" class="btn btn-primary">Hapus</a>
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