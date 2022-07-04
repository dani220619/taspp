<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Buku Kas Masuk PP Al Munawwir Komplek L.xls");

$date1 = date_create($this->session->flashdata('tglawal'));
$date2 = date_create($this->session->flashdata('tglakhir'));

?>
<table class="table table-hover">
    <thead>
        <tr>
            <th colspan=7 height="20px">BUKU KAS UMUM</th>
        </tr>
        <tr>
            <th colspan=7 height="20px">Pondok Pesantren Al Munawwir Komplek L Yogyakarta</th>
        </tr>
        <tr>
            <th colspan=7 height="20px">Periode Bulan : <?= date_format($date1, " F Y") ?> - <?= date_format($date2, "F Y")  ?></th>
        </tr>


        <tr>
                                    <th>No</th>
                                    <th>Id kas</th>
                                    <th>Tipe Kas</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Saldo</th>
                                    
                                </tr>
    </thead>
    <tbody>
    <?php
                        $no = 1;
                        $saldo = 0;
                        foreach ($kas_masuk as $d) : 
                            $date = date_create($d['tgl_transaksi']);

                            if ($d['keterangan'] == 0) {
                                $nominal = $d['nominal'];
                                $saldo = $saldo + $d['nominal'];
                            } 
                                ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d['id_kas'] ?></td>
                                <td><?= $d['tipe_kas'] ?></td>
                                <td><?= $d['tgl_transaksi'] ?></td>
                                <td><?= $d['keterangan'] ?></td>
                                <td>Rp. <?= number_format($d['nominal']) ?></b></td>
                                <td><b style="text-align:right;">Rp <?= number_format($saldo, 0, ',', '.') ?></b></td>
                                
                            </tr>
        <?php $no++;
        endforeach ?>
    </tbody>
</table>