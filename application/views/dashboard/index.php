<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <?php

        $total_thaktif = $this->db->get_where('tahun_aktif')->num_rows();
        $this->db->select_sum('tahun_aktif');
        // var_dump($total_thaktif);
        // die;
        ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <?php if ($_SESSION["role_id"] == "1") { ?><a href="<?= base_url('santri'); ?>"><?php } ?>
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data (Santi)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahsantri; ?> Santri</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pembayaran'); ?>">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Santri Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_thaktif) ?></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('spp_bulanan'); ?>">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pembayaran (spp)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahsppbulanan; ?> Data</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <?php if ($_SESSION["role_id"] == "1") { ?><a href="<?= base_url('user'); ?>"><?php } ?>
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahuser; ?> Akun</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kas Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($kas_msk['uang_masuk']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pembayaran'); ?>">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pembayaran spp</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($juml_spp['jumlah']) ?></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pembayaran'); ?>">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kas Keluar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($kas_klr['uang_keluar']) ?></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pembayaran'); ?>">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pembayaran Lainya</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($pem_lainya['total_tagihan']) ?></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
<div class="col-10 col-md-12">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Santri terajin Bayar Spp
                </div>
                <div class="card-body" style="height: 300px;overflow:scroll;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nis</th>
                                <th scope="col">Nama Santri</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qNya = "SELECT nis, nama_santri, SUM(jumlah) AS total  
                        FROM spp_bulanan  
                        GROUP BY nama_santri ORDER BY total DESC LIMIT 10";
                            $semua_data_keranjang = $this->db->query($qNya)->result_array();
                            ?>
                            <?php $no = 1;
                            foreach ($semua_data_keranjang as $rp) :

                            ?>
                                <tr>
                                    <th><?= $no ?></th>
                                    <td><?= $rp['nis'] ?></td>
                                    <td><?= $rp['nama_santri'] ?></td>
                                    <td><b>Rp. <?= number_format($rp['total']) ?></b></td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-lg-6 ">
            <div class="card">
                <div class="card-header">
                    Santri Termager Bayar Spp
                </div>
                <div class="card-body" style="height: 300px;overflow:scroll;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nis</th>
                                <th scope="col">Nama Santri</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qNya = "SELECT nis, nama_santri, SUM(jumlah) AS total  
                        FROM spp_bulanan  
                        GROUP BY nama_santri ORDER BY total ASC LIMIT 10";
                            $semua_data_keranjang = $this->db->query($qNya)->result_array();
                            ?>
                            <?php $no = 1;
                            foreach ($semua_data_keranjang as $rp) :

                            ?>
                                <tr>
                                    <th><?= $no ?></th>
                                    <td><?= $rp['nis'] ?></td>
                                    <td><?= $rp['nama_santri'] ?></td>
                                    <td><b>Rp. <?= number_format($rp['total']) ?></b></td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->