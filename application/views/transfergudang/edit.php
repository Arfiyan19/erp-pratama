<div class="container">
    <div class="col-md-12">
        <input type="hidden" name="id" class="form-control" value="<?= $tf_gudang['id']; ?>">

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="tgl_tfgdg">Tanggal</label>
                <input type="hidden" name="error_edit" id="error_edit">
                <input type="hidden" class="form-control" id="id_tfgdg" name="id_tfgdg" value="<?= $tf_gudang['id']; ?>">
                <input type="date" class="form-control" data-date-format="yyyy-mm-dd" id="tgl_tfgdg" name="tgl_tfgdg" value="<?= $tf_gudang['tgl']; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="no_transfer_tfgdg">No. Transfer</label>
                <input type="text" class="form-control" id="no_transfer_tfgdg" name="no_transfer_tfgdg" value="<?= $tf_gudang['no_transfer']; ?>">
            </div>

            <div class="form-group col-md-3">
                <label for="keterangan_tfgdg">Keterangan</label>
                <input type="text" class="form-control" id="keterangan_tfgdg" name="keterangan_tfgdg" value="<?= $tf_gudang['keterangan']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableEditData" style="width:75%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center;">
                            <th>#</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody id="customFields">
                        <?php foreach ($tf_gudang_detail as $key => $detail) : ?>
                            <tr>
                                <td>
                                    <?php if ($key == 0) { ?>
                                        <a href="javascript:void(0);" class="addCF rows"><i class="fas fa-plus"></i></a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" class="remCF rows"><i class="fas fa-trash"></i></a>
                                    <?php } ?>
                                </td>
                                <td style="text-align:center;">
                                    <input type="text" class="form-control" id="kode_tfgdg_<?= $key ?>" value="<?= $detail->kode ?>" name="kode_tfgdg" required onclick="handlerModalKode('<?= $key ?>')">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="barang_tfgdg_<?= $key ?>" value="<?= $detail->barang ?>" name="barang_tfgdg" required>
                                </td>
                                <td style="text-align:center;">
                                    <input type="text" class="form-control" id="qty_tfgdg_<?= $key ?>" value="<?= $detail->qty ?>" name="qty_tfgdg" required>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="gudang_asal_tfgdg">Gudang Asal</label>
                <select class="form-control" id="gudang_asal_tfgdg" name="gudang_asal_tfgdg" required>
                    <option value="">Pilih gudang</option>
                    <?php foreach ($all_gudang as $gdg) : ?>
                        <?php if ($tf_gudang['gudang_asal'] == $gdg['nama']) : ?>
                            <option value="<?= $gdg['nama']; ?>" selected><?= $gdg['nama']; ?></option>
                        <?php else : ?>
                            <option value="<?= $gdg['nama']; ?>"><?= $gdg['nama']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="gudang_tujuan_tfgdg">Gudang Tujuan</label>
                <select class="form-control" id="gudang_tujuan_tfgdg" name="gudang_tujuan_tfgdg" required>
                    <option value="">Pilih gudang</option>
                    <?php foreach ($all_gudang as $gdg) : ?>
                        <?php if ($tf_gudang['gudang_tujuan'] == $gdg['nama']) : ?>
                            <option value="<?= $gdg['nama']; ?>" selected><?= $gdg['nama']; ?></option>
                        <?php else : ?>
                            <option value="<?= $gdg['nama']; ?>"><?= $gdg['nama']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <button type="button" class="btn btn-primary" onclick="handleSubmitEditData()">Edit Data</button>
        <a href="<?= base_url('transfer_gudang'); ?>" class="btn btn-success">Kembali</a>
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
    $('input[name=tgl_tfgdg]').datepicker('datepicker');

    const handlerModalKode = (counter) => {
        $('#modalKode').modal('show');
        $(".pilih").attr('data-counter', counter);
    }

    $('.pilih').on('click', function() {

        let counter = $(this).attr('data-counter');

        $(`#kode_tfgdg_${counter}`).val($(this).attr('data-kode'));
        $(`#barang_tfgdg_${counter}`).val($(this).attr('data-nama'));
        $('#modalKode').modal('hide');
    });

    $(".addCF").click(function() {

        let countData = $("#tableEditData tbody tr").length;

        $("#customFields").append(`
            <tr>         
                <td>
                    <a href="javascript:void(0);" class="remCF rows"><i class="fas fa-trash"></i></a>
                </td>
                <td style="text-align:center;">
                    <input type="text" class="form-control" id="kode_tfgdg_${countData}" name="kode_tfgdg" required onclick="handlerModalKode('${countData}')">
                </td>
                <td>
                    <input type="text" class="form-control" id="barang_tfgdg_${countData}" name="barang_tfgdg" required>
                </td>
                <td style="text-align:center;">
                    <input type="text" class="form-control" id="qty_tfgdg_${countData}" name="qty_tfgdg" required>
                </td>
            </tr>
        `);
    });
    $("#customFields").on('click', '.remCF', function() {
        $(this).parent().parent().remove();
        $("#tableEditData tbody tr").each(function(i, v) {
            let kode = $(this).find("td:eq(1) input[name='kode_tfgdg']")
            let barang = $(this).find("td:eq(2) input[name='barang_tfgdg']")
            let qty = $(this).find("td:eq(3) input[name='qty_tfgdg']")

            kode.attr('id', `kode_tfgdg_${i}`)
            kode.attr('onclick', `handlerModalKode("${i}")`)
            barang.attr('id', `barang_tfgdg_${i}`)
            qty.attr('id', `qty_tfgdg_${i}`)
        });
    });

    const handleSubmitEditData = () => {


        let arrKode = [];
        let arrBarang = []
        let arrQty = [];
        let finalDetailData = []


        if ($("#gudang_asal_tfgdg").val() == "") {
            alert('Gudang asal tidak boleh kosong!')
            $("#error_edit").val("1");
            return false;
        } else if ($("#gudang_tujuan_tfgdg").val() == "") {
            alert('Gudang tujuan tidak boleh kosong!')
            $("#error_edit").val("1");
            return false;
        } else {
            $("#tableEditData tbody tr").each(function(i, v) {
                let kode = $(this).find("td:eq(1) input[name='kode_tfgdg']")
                let barang = $(this).find("td:eq(2) input[name='barang_tfgdg']")
                let qty = $(this).find("td:eq(3) input[name='qty_tfgdg']")

                if (kode.val() == "") {
                    alert('Kode tidak boleh kosong!')
                    $("#error_edit").val("1");
                    return false;
                } else if (barang.val() == "") {
                    alert('Barang tidak boleh kosong!')
                    $("#error_edit").val("1");
                    return false;
                } else if (qty.val() == "") {
                    alert('Qty tidak boleh kosong!')
                    $("#error_edit").val("1");
                    return false;
                } else {
                    $("#error_edit").val("0");
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



        if ($("#error_edit").val() != 0) {
            return false;
        } else {
            if (arrKode != null) {
                for (let index = 0; index < arrKode.length; index++) {
                    finalDetailData.push({
                        kode: arrKode[index],
                        barang: arrBarang[index],
                        qty: arrQty[index],
                    });
                }
            }

            const datas = {
                id: $("#id_tfgdg").val(),
                tgl: $("#tgl_tfgdg").val(),
                no_transfer: $("#no_transfer_tfgdg").val(),
                keterangan: $("#keterangan_tfgdg").val(),
                gudang_asal: $("#gudang_asal_tfgdg").val(),
                gudang_tujuan: $("#gudang_tujuan_tfgdg").val(),
                detailData: finalDetailData
            }

            $.ajax({
                url: "<?= base_url('transfer_gudang/edit'); ?>",
                type: "POST",
                data: datas,
                dataType: "JSON",
                success: function(response) {
                    if (response) {
                        location.href = "<?= base_url('transfer_gudang') ?>"
                    } else {
                        alert('edit data gagal');
                    }
                }
            })
        }


    }
</script>