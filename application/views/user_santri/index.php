<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src=" assets/img/santri/<?= $santri['image'] ?>"default.png" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <font size="5%"><b>
                            <p class="card-title">Selamat Datang </p>
                        </b></font>
                    <h5 class="card-title"><?= $santri['nama_santri'] ?></h5>
                    <p class="card-text"><?= $santri['tanggal_lahir'] ?></p>
                    <p class="card-text"><?= $santri['angkatan'] ?></p>
                    <td>
                        <?php echo anchor('user_santri/detail_santri/' . $santri['nis'], '<input type=reset class="btn btn-info" value=\'Pembayaran\'>'); ?>
                    </td>

                </div>
            </div>
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
    </div>
</div>
<!-- End of Main Content -->