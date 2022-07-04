<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message11') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewTahunaktif">Tambah Santri Aktif</a>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tahun_aktif as $t) :
                        ?>
                            <tr>
                                <td><?php echo $t->nis ?></td>
                                <td><?php echo $t->nama_santri ?></td>
                                <td>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteTahunaktif<?= $t->nis ?>"></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteTahunaktif<?= $t->nis ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewTahunaktifLabel">Hapus Santri Aktif</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus santri dengan nama <?= $t->nama_santri ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('th_aktif/deleteTahunaktif?nis=') ?><?= $t->nis ?>" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNewTahunaktif" tabindex="-1" role="dialog" aria-labelledby="addNewTahunaktifLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewTahunaktifLabel">Tambah Santri Aktif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('Th_aktif/tambah_aksi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" hidden="" id="id" name="id" placeholder="Masukan id" value="<?= set_value('id'); ?>">
                        <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-5">
                        <select class="bootstrap-select strings" title="Nis" name="nis[]" id="bulan" data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple required>
                            <?php
                            foreach ($this->db->query('SELECT santri.nis, santri.nama_santri FROM santri')->result() as $sis) { /*$this->m_transaksi->tampil_datatahun()->result() */
                            ?>
                                <option value="<?php echo $sis->nis ?>"> <?php echo $sis->nis . ' | ' . $sis->nama_santri . ''; ?> </option>
                            <?php } ?>
                        </select>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.bootstrap-select').selectpicker();
    });
</script>