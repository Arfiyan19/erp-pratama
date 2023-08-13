<div class="container">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="tgl_rtrngdg">Tanggal</label>
                <input type="hidden" name="error" id="error">
                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_rtrngdg" name="tgl_rtrngdg" required autocomplete="off" value="<?= date('Y-m-d'); ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="no_return_rtrngdg">No. Retur</label>
                <input type="text" class="form-control" id="no_return_rtrngdg" name="no_return_rtrngdg" required disabled>
            </div>

            <div class="form-group col-md-3">
                <label for="keterangan_rtrngdg">Keterangan</label>
                <input type="text" class="form-control" id="keterangan_rtrngdg" name="keterangan_rtrngdg" required value="-">
            </div>
        </div>
        <div class="form-row">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableAddData" style="width:75%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center;">
                            <th>#</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="customFields">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" class="addCF rows"><i class="fas fa-plus"></i></a>
                            </td>
                            <td style="text-align:center;">
                                <input type="text" class="form-control" id="kode_rtrngdg_0" name="kode_rtrngdg" required onclick="handlerModalKode('0')">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="barang_rtrngdg_0" name="barang_rtrngdg" required>
                            </td>
                            <td style="text-align:center;">
                                <input type="text" class="form-control" id="qty_rtrngdg_0" name="qty_rtrngdg" required>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="gudang_asal_rtrngdg">Gudang Asal</label>
                <select class="form-control" id="gudang_asal_rtrngdg" name="gudang_asal_rtrngdg" required>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="gudang_tujuan_rtrngdg">Gudang Tujuan</label>
                <select class="form-control" id="gudang_tujuan_rtrngdg" name="gudang_tujuan_rtrngdg" required>
                </select>
            </div>
        </div>

        <button type="button" class="btn btn-primary" onclick="handleSubmitNewData()">Tambah Data</button>
        <a href="<?= base_url('return_gudang'); ?>" class="btn btn-success">Kembali</a>
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
                        if ($databrg != null) :
                            foreach ($databrg->result_array() as $i) :
                                $id = $i['id'];
                                $kode = $i['kode'];
                                $nama = $i['nama'];
                                $gudang = $i['gudang'];
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
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'assets/vendor/bootstrap/js/bootstrap.js' ?>"></script>

<script>
    $('input[name=tgl_rtrngdg]').datepicker('datepicker');

    const handlerModalKode = (counter) => {
        $('#modalKode').modal('show');
        $(".pilih").attr('data-counter', counter);
    }

    $('.pilih').on('click', function() {
        let counter = $(this).attr('data-counter');

        $(`#kode_rtrngdg_${counter}`).val($(this).attr('data-kode'));
        $(`#barang_rtrngdg_${counter}`).val($(this).attr('data-nama'));
        $('#modalKode').modal('hide');
    });

    fetch('<?= base_url('return_gudang/getLatestNoTf'); ?>')
        .then(response => response.json())
        .then((result) => {
            $('input[name=no_return_rtrngdg]').val(result);
        });

    fetch('<?= base_url('barang/all_gudang'); ?>')
        .then(response => response.json())
        .then((result) => {
            let data = `<option value="">Pilih gudang</option>`;
            result.forEach(function(e) {
                if (e.nama == sessionStorage.getItem('gudang')) {
                    data += '';
                } else {
                    data += `<option value="${e.nama}">${e.nama}</option>`;
                }
            });

            $('select[name=gudang_asal_rtrngdg]').html(data);
            $('select[name=gudang_tujuan_rtrngdg]').html(data);
        });

    $(".addCF").click(function() {

        let countData = $("#tableAddData tbody tr").length;

        $("#customFields").append(`
        <tr>         
          <td>
            <a href="javascript:void(0);" class="remCF rows"><i class="fas fa-trash"></i></a>
          </td>
          <td style="text-align:center;">
            <input type="text" class="form-control" id="kode_rtrngdg_${countData}" name="kode_rtrngdg" required onclick="handlerModalKode('${countData}')">
          </td>
          <td>
            <input type="text" class="form-control" id="barang_rtrngdg_${countData}" name="barang_rtrngdg" required>
          </td>
          <td style="text-align:center;">
            <input type="text" class="form-control" id="qty_rtrngdg_${countData}" name="qty_rtrngdg" required>
          </td>
        </tr>
      `);
    });
    $("#customFields").on('click', '.remCF', function() {
        $(this).parent().parent().remove();
        $("#tableAddData tbody tr").each(function(i, v) {
            let kode = $(this).find("td:eq(1) input[name='kode_rtrngdg']")
            let barang = $(this).find("td:eq(2) input[name='barang_rtrngdg']")
            let qty = $(this).find("td:eq(3) input[name='qty_rtrngdg']")

            kode.attr('id', `kode_rtrngdg${i}`)
            kode.attr('onclick', `handlerModalKode("${i}")`)
            barang.attr('id', `barang_rtrngdg${i}`)
            qty.attr('id', `qty_rtrngdg${i}`)
        });
    });

    const handleSubmitNewData = () => {


        let arrKode = [];
        let arrBarang = []
        let arrQty = [];
        let finalDetailData = []

        if ($("#gudang_asal_rtrngdg").val() == "") {
            alert('Gudang asal tidak boleh kosong!')
            $("#error").val("1");
            return false;
        } else if ($("#gudang_tujuan_rtrngdg").val() == "") {
            alert('Gudang tujuan tidak boleh kosong!')
            $("#error").val("1");
            return false;
        } else {
            $("#tableAddData tbody tr").each(function(i, v) {
                let kode = $(this).find("td:eq(1) input[name='kode_rtrngdg']")
                let barang = $(this).find("td:eq(2) input[name='barang_rtrngdg']")
                let qty = $(this).find("td:eq(3) input[name='qty_rtrngdg']")

                if (kode.val() == "") {
                    alert('Kode tidak boleh kosong!')
                    $("#error").val("1");
                    return false;
                } else if (barang.val() == "") {
                    alert('Barang tidak boleh kosong!')
                    $("#error").val("1");
                    return false;
                } else if (qty.val() == "") {
                    alert('Jumlah tidak boleh kosong!')
                    $("#error").val("1");
                    return false;
                } else {
                    $("#error").val("0");
                    kode.map(function() {
                        arrKode.push($(this).val());
                    }).get();

                    barang.map(function() {
                        arrBarang.push($(this).val());
                    }).get();

                    qty.map(function() {
                        arrQty.push($(this).val());
                    }).get();
                }
            });
        }



        if ($("#error").val() != 0) {
            return false;
        } else {
            if (arrKode != null) {
                for (let index = 0; index < arrKode.length; index++) {
                    finalDetailData.push({
                        kode: arrKode[index],
                        barang: arrBarang[index],
                        jumlah: arrQty[index],
                    });
                }
            }

            const datas = {
                tgl: $("#tgl_rtrngdg").val(),
                no_return: $("#no_return_rtrngdg").val(),
                keterangan: $("#keterangan_rtrngdg").val(),
                gudang_asal: $("#gudang_asal_rtrngdg").val(),
                gudang_tujuan: $("#gudang_tujuan_rtrngdg").val(),
                detailData: finalDetailData
            }

            $.ajax({
                url: "<?= base_url('return_gudang/tambah'); ?>",
                type: "POST",
                data: datas,
                dataType: "JSON",
                success: function(response) {
                    if (response) {
                        location.href = "<?= base_url('return_gudang') ?>"
                    } else {
                        alert('tambah data gagal');
                    }
                }
            })
        }
    }
</script>