<div class="container">
    <div class="col-md-6">
        <form action="<?= base_url('return_supplier/tambah'); ?>" method="POST"> 
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputNama">Tanggal</label>
                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="inputNama" name="tgl_returnsuppl" required value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-6">
                <label for="inputManager">No. Return</label>
                <input type="text" class="form-control" id="inputManager" name="no_return_returnsuppl" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="jenis_kendaraan_returnsuppl">Jenis Kendaraan</label>
                <input type="text" class="form-control" id="jenis_kendaraan_returnsuppl" name="jenis_kendaraan_returnsuppl">
                </div>
                <div class="form-group col-md-6">
                <label for="no_polisi_returnsuppl">No. Polisi</label>
                <input type="text" class="form-control" id="no_polisi_returnsuppl" name="no_polisi_returnsuppl">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="nama_driver_returnsuppl">Nama Driver</label>
                <input type="text" class="form-control" id="nama_driver_returnsuppl" name="nama_driver_returnsuppl">
                </div>
                <div class="form-group col-md-6">
                <label for="nama_expedisi_returnsuppl">Nama Ekspedisi</label>
                <input type="text" class="form-control" id="nama_expedisi_returnsuppl" name="nama_expedisi_returnsuppl">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputPoin">Keterangan</label>
                <input type="text" class="form-control" id="inputPoin" name="keterangan_returnsuppl" required value="-">
                </div>
                <div class="form-group col-md-6">
                <label for="inputTeam">Kode</label>
                <input type="text" class="form-control" id="inputTeam" name="kode_returnsuppl" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputPeringkat">Barang</label>
                <input type="text" class="form-control" id="inputPeringkat" name="barang_returnsuppl" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputPeringkat2">Gudang Asal</label>
                <input type="text" class="form-control" id="inputPeringkat2" name="gudang_asal_returnsuppl" required>
                </div>
            </div>
                 
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputLeader">Supplier Tujuan</label>
                <select class="form-control" id="inputLeader" name="supplier_tujuan_returnsuppl" required></select>
                </div>
                <div class="form-group col-md-6">
                <label for="inputDistri">Jumlah</label>
                <input type="text" class="form-control" id="inputDistri" name="qty_returnsuppl" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="<?= base_url('return_supplier');?>" class="btn btn-success">Kembali</a>
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

    fetch('<?= base_url('return_supplier/getLatestNoReturn'); ?>')
        .then(response => response.json())
        .then((result) => {
            $('input[name=no_return_returnsuppl]').val(result);
        });

    fetch('<?= base_url('supplier/getAllSupplier'); ?>')
        .then(response => response.json())
        .then((result) => {
            let data = `<option value="">Pilih supplier</option>`;
            result.forEach(function(e) {
                data += `<option value="${e.nama}">${e.nama}</option>`;
            });

            $('select[name=supplier_tujuan_returnsuppl]').html(data);
        });
</script>