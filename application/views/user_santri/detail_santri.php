<?php

$this->db->select('nis');
$this->db->from('santri');
// var_dump($santri);
// die;
?>
<div class="card-body">
    <div class="card shadow mb-4 border-bottom-success" id="infosantri" value="0">
        <!-- Card Header - Accordion -->
        <a href="#informasisantri" class="d-block bg-success border border-success card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-white">Informasi Santri</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="informasisantri">
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <?php foreach ($santri as $u) { ?>
                            <tr>
                                <td>Nis </td>
                                <td>: <?php echo $u->nis ?></td>
                            </tr>
                            <tr>
                                <td>Nama Santri</td>
                                <td>: <?php echo $u->nama_santri ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelmain</td>
                                <td>: <?php echo $u->jenis_kelamin ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <?php echo $u->alamat ?></td>
                            </tr>
                            <tr>
                                <td>NO HP</td>
                                <td>: <?php echo $u->no_hp ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>