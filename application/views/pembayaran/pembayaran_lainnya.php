<div class="card-body">
    <div class="card shadow mb-4 border-bottom-danger" id="tagihanlainya" value="0">
        <!-- Card Header - Accordion -->
        <a href="#tagihanlainnya" class="d-block bg-danger border border-danger card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-white">Tagihan Lainnya</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="tagihanlainnya">
            <div class="table-responsive">
                <div class="card-body">
                    <table class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Tahun Ajaran</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Tagihan</th>
                                <th>Opsi</th>
                                <th>Status Bayar</th>
                                <th>Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            foreach ($pembayaran_lainnya as $u) {
                            ?>
                                <tr>
                                    <td><?php echo $id++ ?></td>
                                    <td><?php echo $u->tahun_ajaran ?></td>
                                    <td><?php echo $u->jenis_pembayaran ?></td>
                                    <td><b>Rp. <?= number_format($u->total_tagihan) ?></b></td>
                                    <td><?php echo $u->metode_pembayaran ?></td>
                                    <td style="<?= ($u->status_bayar == '0' ? 'color: green' : 'color: red') ?>"><?php echo ($u->status_bayar == '0' ? 'Lunas' : ($u->status_bayar == '1' ? 'Pending' : 'Pending')) ?></td>
                                    <td>
                                        <!--<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#updatepemlainnya<?= $u->nis ?>">bayar</a>-->

                                        <?php if ($u->status_bayar != '0' && $u->status_bayar != '1') { ?>
                                            <a href="javascript:void(0);" class="btn btn-danger" onclick="showModal(<?= $u->id_pem_lainya ?>)">bayar</a>
                                        <?php }

                                        #untuk cek status transaksi
                                        if (($u->status_bayar == '1' || $u->status_bayar == '2') && $u->metode_pembayaran == 'Online') {

                                            echo '<a href="javascript:void(0)" onclick="cekStatusTransaksi(\'' . $u->id_pem_lainya . '\',\'' . $u->nis . '\',\'' . $u->order_id . '\')"><input type=reset class="btn btn-warning" value=\'Cek Transaksi\'></a>';

                                            echo anchor('pembayaran/hapus_pemlainya/' . $u->id_pem_lainya . '/' . $u->nis . '/' . $u->order_id, '<input type=reset class="btn btn-danger" value=\'Hapus\'>');
                                        } elseif ($u->status_bayar == '0') {
											echo anchor('pembayaran/cetak_kwitansi_pembayaran/' . $u->id_pem_lainya . '/' . $u->nis,'Cetak', array('title' => 'Cetak Kwitansi Pembayaran', 'class' => 'btn btn-info'));
										}
                                        ?>
                                    </td>
                                </tr>
                                <div class="modal fade" id="updatepemlainnya" tabindex="-1" role="dialog" aria-labelledby="addNewpemLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addNewpemLabel">Pembayaran Lainnya </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="p-5">
                                                <form id="form-pembayaran-lainnya" class="user" method="post" action="<?= base_url('pembayaran/update_bayar'); ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="hidden" id="id-pem-lainya" name="id_pem_lainya" value="">
                                                        <input type="hidden" id="nis" name="nis" value="">
                                                        <input name="tanggal_bayar" class="form-control" type="text" value="<?php echo $tgl_bayar; ?>" hidden>
                                                        <input name="id" class="form-control" type="text" value="<?= $bendahara['id_bendahara']; ?>" hidden>
                                                        <label> Total Bayar </label>
                                                        <input type="text" class="form-control form-control-user" id="total-tagihan" name="total_tagihan" value="" readonly>
                                                        <input type="hidden" name="result_type" id="result-type" value="">
                                                        <input type="hidden" name="result_data" id="result-data" value="">
                                                    </div>
                                                    <label>Jenis Pembayaran</label>
                                                    <input type="text" id="jenis-pembayaran" class="form-control form-control-user" name="jenis_pembayaran" value="" readonly>
                                                    <div class="form-group col-14 ">
                                                        <label>Metode Pembayaran</label>
                                                        <select id="metode-pembayaran" class="form-control" name="metode_pembayaran" required>
                                                            <option value="">Pilih Metode Pembayaran</option>
                                                            <option value="Online">Online</option>
                                                            <?php if ($_SESSION["role_id"] == "1") { ?>
                                                                <option value="Manual">Bayar Ditempat</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select id="tahun-ajaran" name="tahun_ajaran" class="form-control" style="margin-left: 10px;" hidden>
                                                            <?php
                                                            foreach ($this->db->query('SELECT a.id_tahun, a.tahun_ajaran FROM tahun_ajaran a where Status="ON"')->result() as $sis) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                                            ?>
                                                                <option value="<?php echo $sis->tahun_ajaran ?>"> <?php echo $sis->id_tahun . ' | ' . $sis->tahun_ajaran . '' ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=""></script>
<script type="text/javascript">
    var _data = <?= json_encode($pembayaran_lainnya) ?>;

    function showModal(_idbayar) {
        //cari data berdasarkan _idbayar bukan nis
        var _caridata = $.grep(_data, function(element, index) {
            return element.id_pem_lainya == _idbayar;
        });
        //isi dengan json 
        $('#id-pem-lainya').val(_caridata[0].id_pem_lainya);
        $('#nis').val(_caridata[0].nis);
        $('#total-tagihan').val(_caridata[0].total_tagihan);
        $('#jenis-pembayaran').val(_caridata[0].jenis_pembayaran);
        $('#updatepemlainnya').modal('show');
    }

    function cekStatusTransaksi(_idbayar, _nis, _orderid) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>Snap_lainnya/cekStatusTransaksi/' + _idbayar + '/' + _nis + '/' + _orderid,
            data: {},
            cache: false,
            success: function(result) {
                alert(result);
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('status code: ' + jqXHR.status + ' errorThrown: ' + errorThrown + ' responseText: ' + jqXHR.responseText);
            }
        });
    }
    var _issubmit = false;
    $(document).ready(function() {
        $("#form-pembayaran-lainnya").submit(function(e) {
            e.preventDefault();
            if ($('#metode-pembayaran').val() == 'Online' && _issubmit === false) {
                _issubmit = true;
                var _idbayar = $('#id-pem-lainya').val();
                var _nis = $('#nis').val();
                var _namasantri = $('#nm_santri').val(); //ada di detail_santri.php
                var _total = $('#total-tagihan').val(); //text().split('|')[1].replace('Rp. ', '').replace('.', '');
                var _jnspembayaran = $('#jenis-pembayaran').val();
                //alert('a');exit;
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>Snap_lainnya/token',
                    data: {
                        id_bayar: _idbayar,
                        nis: _nis,
                        nama_santri: _namasantri,
                        total: _total,
                        jenis_pembayaran: _jnspembayaran
                    },
                    cache: false,
                    success: function(data) {
                        console.log('token = ' + data);
                        //alert(data);exit;
                        var resultType = document.getElementById('result-type');
                        var resultData = document.getElementById('result-data');

                        function changeResult(type, data) {
                            $("#result-type").val(type);
                            $("#result-data").val(JSON.stringify(data));
                        }
                        snap.pay(data, {
                            onSuccess: function(result) {
                                changeResult('success', result);
                                console.log(result.status_message);
                                console.log(result);
                                //alert('success');
                                $("#form-pembayaran-lainnya").submit();
                            },
                            onPending: function(result) {
                                changeResult('pending', result);
                                console.log(result.status_message);
                                //alert('pending');
                                $("#form-pembayaran-lainnya").submit();
                            },
                            onError: function(result) {
                                changeResult('error', result);
                                console.log(result.status_message);
                                //alert('error');
                                $("#form-pembayaran-lainnya").submit();
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('status code: ' + jqXHR.status + ' errorThrown: ' + errorThrown + ' responseText: ' + jqXHR.responseText);
                    }
                });
            } else {
                this.submit();
            }
        });
    });
</script>