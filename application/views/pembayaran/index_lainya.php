<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message13') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewAdmin">Tambah Pembayaran Lainya</a>

            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Bulanan</th>
                            <th>Nis</th>
                            <th>Nama Santri</th>
                            <th>Jenis Pembayaran</th>
                            <th>Tahun Ajaran
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pembayaran_lainya as $t) :
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $t->id_pem_lainya ?></td>
                                <td><?php echo $t->nis ?></td>
                                <td><?php echo $t->nama_santri ?></td>
                                <td><?php echo $t->jenis_pembayaran ?> </td>
                                <td><?php echo $t->tahun_ajaran ?></td>
                                <td>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteAjaran<?= $t->id_pem_lainya ?>"></a>
                                </td>
                            </tr>
                            <!-- update donatur-->

                            <!--delete donatur-->
                            <div class="modal fade" id="deleteAjaran<?= $t->id_pem_lainya ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Pembayaran Lainya</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus Pembayaran Lainya <?= $t->id_pem_lainya ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('pembayaran/delete_pem_lainya?id_pem_lainya=') ?><?= $t->id_pem_lainya ?>" class="btn btn-primary">Hapus</a>
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
<div class="modal fade" id="addNewAdmin" tabindex="-1" role="dialog" aria-labelledby="addNewAdmin" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewAdmin">Tambah Pembayaran Lainya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('pembayaran/tambah_pem_lainya'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" hidden="" id="id_pem_lainya" name="id_pem_lainya" placeholder="Masukan " value="<?= set_value('id_pem_bulan'); ?>">
                        <?= form_error('id_pem_bulan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <?php foreach ($santri as $u) { ?>
                        <input name="id" class="form-control" type="text" value="<?= $bendahara['id_bendahara']; ?>" hidden>
                    <?php } ?>
                    <div class="form-group">

                        <select class="bootstrap-select strings" title="Pilih Santri" name="nis[]" id="nis" data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple required>
                            <?php
                            foreach ($this->db->query('SELECT a.nis, a.nama_santri FROM santri a')->result() as $sis) { /*$this->m_transaksi->tampil_datatahun()->result() */
                            ?>
                                <option value="<?php echo $sis->nis ?>"> <?php echo $sis->nis . ' | ' . $sis->nama_santri . '' ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select id="tahun_ajaran" name="tahun_ajaran" class="form-control">
                            <option>Pilih Tahun Ajaran</option>
                            <?php
                            foreach ($this->db->query('SELECT a.id_tahun, a.tahun_ajaran FROM tahun_ajaran a where Status="ON"')->result() as $sis) { /*$this->m_transaksi->tampil_datatahun()->result() */
                            ?>

                                <option value="<?php echo $sis->tahun_ajaran ?>"> <?php echo $sis->tahun_ajaran  ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pembayaran</label>
                        <select id="jenis_pembayaran" name="jenis_pembayaran" class="form-control">
                            <option>Pilih Jenis Pembayaran</option>
                            <?php
                            foreach ($this->db->query('SELECT * from jenis_pembayaran')->result() as $sis) { /*$this->m_transaksi->tampil_datatahun()->result() */
                            ?>

                                <option value="<?php echo $sis->jenis_pembayaran ?>"> <?php echo $sis->jenis_pembayaran ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total Tagihan</label>
                        <input type="text" class="form-control form-control-user" id="total_tagihan" name="total_tagihan" placeholder="Masukan Total Tagihan" value="<?= set_value('total_tagihan'); ?>">
                        <?= form_error('total_tagihan', '<small class="text-danger pl-3">', '</small>'); ?>
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