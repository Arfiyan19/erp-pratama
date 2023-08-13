<div class="container">
    <div class="col-md-6">
        <form action="<?= base_url('return_supplier/edit'); ?>" method="POST">
            <input type="hidden" name="id_returnsuppl" class="form-control" value="<?= $return_supplier['id'];?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tgl_returnsuppl">Tanggal</label>
                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_returnsuppl" name="tgl_returnsuppl"  value="<?= $return_supplier['tanggal'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="no_return_returnsuppl">No. Return</label>
                    <input type="text" class="form-control" id="no_return_returnsuppl" name="no_return_returnsuppl" value="<?= $return_supplier['no_return'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="jenis_kendaraan_returnsuppl">Jenis Kendaraan</label>
                <input type="text" class="form-control" id="jenis_kendaraan_returnsuppl" name="jenis_kendaraan_returnsuppl" value="<?= $return_supplier['jenis_kendaraan']; ?>">
                </div>
                <div class="form-group col-md-6">
                <label for="no_polisi_returnsuppl">No. Polisi</label>
                <input type="text" class="form-control" id="no_polisi_returnsuppl" name="no_polisi_returnsuppl" value="<?= $return_supplier['no_polisi']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="nama_driver_returnsuppl">Nama Driver</label>
                <input type="text" class="form-control" id="nama_driver_returnsuppl" name="nama_driver_returnsuppl" value="<?= $return_supplier['nama_driver']; ?>">
                </div>
                <div class="form-group col-md-6">
                <label for="nama_expedisi_returnsuppl">Nama Ekspedisi</label>
                <input type="text" class="form-control" id="nama_expedisi_returnsuppl" name="nama_expedisi_returnsuppl" value="<?= $return_supplier['nama_expedisi']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="keterangan_returnsuppl">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan_returnsuppl" name="keterangan_returnsuppl" value="<?= $return_supplier['keterangan'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="kode_returnsuppl">Kode</label>
                    <input type="text" class="form-control" id="kode_returnsuppl" name="kode_returnsuppl" value="<?= $return_supplier['kode'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="barang_returnsuppl">Barang</label>
                    <input type="text" class="form-control" id="barang_returnsuppl" name="barang_returnsuppl" value="<?= $return_supplier['barang'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="gudang_asal_returnsuppl">Gudang Asal</label>
                    <input type="text" class="form-control" id="gudang_asal_returnsuppl" name="gudang_asal_returnsuppl" value="<?= $return_supplier['gudang_asal'];?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="supplier_tujuan_returnsuppl">Supplier Tujuan</label>
                    <select class="form-control" id="supplier_tujuan_returnsuppl" name="supplier_tujuan_returnsuppl" required>
                        <option value="">Pilih supplier</option>
                        <?php foreach( $all_supplier as $sup ): ?>
                        <?php if( $sup['nama'] == $return_supplier['supplier_tujuan']): ?>
                        <option value="<?= $return_supplier['supplier_tujuan']; ?>" selected><?= $return_supplier['supplier_tujuan']; ?></option>
                        <?php else: ?>
                        <option value="<?= $sup['nama']; ?>"><?= $sup['nama']; ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="qty_returnsuppl">Jumlah</label>
                    <input type="text" class="form-control" id="qty_returnsuppl" name="qty_returnsuppl" value="<?= $return_supplier['jumlah'];?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Edit Data</button>
            <a href="<?= base_url('return_supplier'); ?>" class="btn btn-success">Kembali</a>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKode" tabindex="-1" aria-labelledby="modalKodeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKodeLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover" cellspacing="2">
                    <thead>
                        <tr>
                           <th>Kode Barang</th>
                           <th>Nama Barang</th>
                           <th>Gudang</th>
                       </tr>
                   </thead>
                   <tbody>
                        <?php
                        if ($databrg != null):         
                        foreach($databrg->result_array() as $i):
                        $id=$i['id'];
                        $kode=$i['kode'];
                        $nama=$i['nama'];
                        $gudang=$i['gudang'];
                        ?>
                        <tr class="pilih" data-nama="<?php echo $nama; ?>" data-kode="<?php echo $kode; ?>" data-gudang="<?php echo $gudang; ?>" style="cursor: pointer;">
                            <td>
                                <?php echo $kode ?>
                            </td>
                            <td width="">
                                <?php echo $nama ?>
                            </td>
                            <td>
                                <?php echo $gudang ?>
                            </td>
                        </tr>
                        <?php endforeach; endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.js'?>"></script>
<script>
    $('input[name=tgl_returnsuppl]').datepicker('datepicker');
    $('input[name=kode_returnsuppl]').on('click', function() {
        $('#modalKode').modal('show');
    });

    $('.pilih').on('click', function() {
        $('input[name=kode_returnsuppl]').val($(this).attr('data-kode'));
        $('input[name=barang_returnsuppl]').val($(this).attr('data-nama'));
        $('input[name=gudang_asal_returnsuppl]').val($(this).attr('data-gudang'));
        $('#modalKode').modal('hide');
    });
</script>