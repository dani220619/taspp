<div class="card-body">
    <div class="card shadow mb-4 border-bottom-warning" id="tagihanbulanan" value="0">
        <!-- Card Header - Accordion -->
        <a href="#tagihanbulan" class="d-block bg-warning border border-warning card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-white">Tagihan Bulanan</h6>
        </a>
        <!-- Card Content - Collapse -->

        <div class="collapse show" id="tagihanbulan">

            <div class="table-responsive">
                <div class="card-body">
                    <table class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Tahun Ajaran</th>
                                <th>Jenis Pembayaran</th>
                                <th>Dibayar</th>
                                <th>Status Bayar</th>
                                <th>Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;

                            foreach ($pembayaran_bulanan as $u) {
                            ?>
                                <tr>
                                    <td><?php echo $id++ ?></td>
                                    <td><?php echo $u->tahun_ajaran ?></td>
                                    <td><?php echo $u->jenis_pembayaran ?></td>
                                    <td><b><?php echo 'Rp. ' . number_format($u->total_spp, 0, ',', '.'); ?></b></td>
                                    <td style="<?= ($u->status_bayar == 'Lunas' ? 'color: green' : 'color: red') ?>"><?php echo $u->status_bayar ?></td>
                                    <td>
                                        <?php
                                        if ($u->status_bayar != 'Lunas') {
                                            echo anchor('user_santri/spp_bulanan/' . $u->id_pem_bulan . '/' . $u->nis, '<input type=submit class="btn btn-warning" value=\'bayar\'>');
                                        }
                                        echo anchor('user_santri/cetak_spp_bulanan/' . $u->id_pem_bulan . '/' . $u->nis, 'Cetak', array('title' => 'Cetak kartu SPP', 'class' => 'btn btn-info'));
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>