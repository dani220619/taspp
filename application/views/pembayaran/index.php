<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if ($_SESSION["role_id"] == "1") { ?>
                <a class="btn btn-primary mb-3" href="<?= base_url('th_aktif'); ?>">Add Tahun Aktif</a>
                <a class="btn btn-success mb-3" href="<?= base_url('th_ajaran'); ?>">Add Tahun Ajaran</a>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS/NISN</th>
                            <th>Nama Santri</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($santri as $u) {
                        ?>
                            <tr>
                                <td><?php echo $id++ ?></td>
                                <td><?php echo $u->nis ?></td>
                                <td><?php echo $u->nama_santri ?></td>
                                <td>
                                    <?php echo anchor('pembayaran/detail/' . $u->nis, '<input type=reset class="btn btn-info" value=\'Detail\'>'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->