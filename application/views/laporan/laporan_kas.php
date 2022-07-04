<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel <?= $title; ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.css'); ?>" />
                <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script> <!-- Load file jquery -->
                <form method="get" action="" class="form">
                    <div class="form-group">
                        <label>Filter Berdasarkan</label>
                        <select class="form-control" name="filter" id="filter" style="width: 50%">
                            <option value="">Pilih</option>
                            <?php if ($_SESSION["role_id"] == ("1" and "2")) { ?>
                                <option value="1">Kas Masuk</option>
                            <?php } ?>
                            <option value="2">Kas Keluar</option>
                            <?php if ($_SESSION["role_id"] == ("1" and "2")) { ?>
                                <option value="3">Kas Umum</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" id="form-kas_masuk">
                        <label>Dari Tanggal</label>
                        <input type="date" name="tanggal" class="form-control input-tanggal" style="width: 50%" />
                    </div>
                    <div class="form-group" id="form-kas_masuk2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="tanggal2" class="form-control input-tanggal2" style="width: 50%" />
                    </div>
                    <div class="form-group" id="form-kas_keluar">
                        <label>Dari Tanggal</label>
                        <input type="date" name="tanggal11" class="form-control input-tanggal" style="width: 50%" />
                    </div>
                    <div class="form-group" id="form-kas_keluar2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="tanggal12" class="form-control input-tanggal2" style="width: 50%" />
                    </div>
                    <div class="form-group" id="form-umum">
                        <label>Dari Tanggal</label>
                        <input type="date" name="tanggal111" class="form-control input-tanggal" style="width: 50%" />
                    </div>
                    <div class="form-group" id="form-umum2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="tanggal122" class="form-control input-tanggal2" style="width: 50%" />
                    </div>
                    <button class="btn btn-primary" type="submit">Tampilkan</button>
                    <a href="<?php echo base_url() . "laporan/laporan_kas"; ?>">Reset Filter</a>
                </form>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $ket; ?></h6>
        </div>
        <div class="card-body">
            <a href="<?php echo $url_cetak; ?>" class=" btn btn-danger mb-3"><i class="fas fa-file-pdf"></i>CETAK PDF</a>

            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center">
                        <tr>
                            <th style="text-align: center;">NO</th>
                            <th style="text-align: center;">ID Kas</th>
                            <th style="text-align: center;">Tanggal Transaksi</th>
                            <th style="text-align: center;">Keterangan</th>
                            <th style="text-align: center;">Jenis Kas</th>
                            <th style="text-align: center;">Uang Masuk</th>
                            <th style="text-align: center;">Uang Keluar</th>
                            <th style="text-align: center;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($kas_umum)) {
                            $no = 1;
                            $saldo = 0;
                            foreach ($kas_umum as $data) {
                                $saldo = $saldo + ($data->uang_masuk - $data->uang_keluar);
                        ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $no++ ?></td>
                                    <td style="text-align: center;"><?php echo $data->id_kas ?></td>
                                    <td style="text-align: center;"><?php echo $data->tgl_transaksi ?></td>
                                    <td style="text-align: center;"><?php echo $data->keterangan ?></td>
                                    <td style="text-align: center;"><?php echo $data->jenis_kas ?></td>
                                    <td><?php echo 'Rp. ' . number_format($data->uang_masuk, 0, ',', '.'); ?></td>
                                    <td><?php echo 'Rp. ' . number_format($data->uang_keluar, 0, ',', '.'); ?></td>
                                    <td><?php echo 'Rp. ' . number_format($saldo, 0, ',', '.'); ?></td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                    <script src="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
                    <script>
                        $(document).ready(function() { // Ketika halaman selesai di load
                            $('#form-kas_masuk, #form-kas_masuk2, #form-kas_keluar, #form-kas_keluar2, #form-umum, #form-umum2').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
                            $('#filter').change(function() { // Ketika user memilih filter
                                if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                                    $('#form-kas_keluar, #form-kas_keluar2, #form-umum, #form-umum2').hide();
                                    $('#form-kas_masuk').show(); // Tampilkan form tanggal
                                    $('#form-kas_masuk2').show(); // Tampilkan form tanggal
                                } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                                    $('#form-kas_masuk, #form-kas_masuk2, #form-bulan, #form-umum, #form-umum2').hide();
                                    $('#form-kas_keluar').show(); // Tampilkan form bulan dan tahun
                                    $('#form-kas_keluar2').show();
                                } else if ($(this).val() == '3') { // Jika filter nya 2 (per bulan)
                                    $('#form-kas_keluar, #form-kas_keluar2, #form-kas_masuk, #form-kas_masuk2, #form-nis').hide();
                                    $('#form-umum').show(); // Tampilkan form bulan dan tahun
                                    $('#form-umum2').show();
                                } else { // Jika filternya 3 (per tahun)
                                    $('#form-kas_masuk, #form-kas_masuk2, #form-kas_keluar, #form-kas_keluar2, #form-umum, #form-umum2').hide();
                                }
                                $('#form-kas_masuk input, #form-kas_keluar input, #form-umum input').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
                            })
                        })
                    </script>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->