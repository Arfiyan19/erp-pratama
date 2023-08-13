<style>
    .container-bottom {
        padding-top: 2px;
        transform: translateY(585px);
        transition: 0.3s ease;
    }

    .expand {
        transform: translateY(0px);
    }
</style>

<div class="container-fluid">
    <?php if ($this->session->flashdata('flash2')) : ?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert"><strong><?= $this->session->flashdata('flash'); ?> </strong>
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- <h5 class="text-bold">Manager P & L</h5> -->

    <form action="" method="get">
        <div class="row mt-3 mb-2">
            <div class="col-lg-4">
                <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                        <label for="idMitra" class="input-group-text">ID Mitra :</label>
                    </div>
                    <select id="idMitra" class="form-control form-control-sm">
                        <option value=""><?= $user->kode ?></option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                        <label for="name" class="input-group-text">Name :</label>
                    </div>
                    <select id="name" class="form-control form-control-sm">
                        <option value=""><?= $user->name ?></option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                        <label for="weekending" class="input-group-text">Cari Faktur :</label>
                    </div>
                    <input type="text" name="faktur" id="weekending" class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label for="jabatan" class="input-group-text">Tgl Awal :</label>
                    </div>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" value="<?php echo date('Y-m-d'); ?>" id="" class="form-control">
                </div>
                <!-- <div class="d-flex mt-1"> -->
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="jabatan" class="input-group-text">Tgl Akhir :</label>
                    </div>
                    <input type="date" name="tgl_sampai" id="tgl_sampai" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" id="" class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <button class="btn mt-3 btn-secondary">Cari</button>
            </div>
        </div>
    </form>
    <hr>

    <button class="btn btn-success" data-target="#modalTambah" data-toggle="modal">
        <i class="fa fa-plus"></i> Tambah Data
    </button>
    <h2><? echo  '<a>kj</a>' ?></h2>
    <?php


    // $this->load->view('manager2/table');
    ?>

    <div class="table-responsive">
        <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">
            <thead>
                <tr>
                    <th>-</th>
                    <th>No. Inv</th>
                    <th>Tanggal</th>
                    <th>Nominal Total</th>
                    <th>Aksi</th>
                    <th>Validasi</th>
                </tr>
            </thead>
            <?php foreach ($datas as $data) : ?>
                <tbody>
                    <tr>
                        <!-- <td><input type="checkbox" name="" id=""></td> -->
                        <td>-</td>
                        <td><?= $data['no_invoice'] ?></td>
                        <td><?= $data['tgl'] ?></td>
                        <td><?= number_format($data['nominal_total'], 2, ',', '.') ?></td>
                        <td>
                            <?php if ($data['validasi'] == 'N') { ?>
                                <button data-id="<?= $data['id'] ?>" class="btn btn-warning edit">Edit</button>
                                <button data-id="<?= $data['id'] ?>" class="btn btn-danger hapus">Hapus</button>
                            <?php } ?>
                            <button data-id="<?= $data['id'] ?>" class="btn btn-success priview">Preview</button>
                        </td>
                        <td><?= $data['validasi'] ?></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Modal Tambah-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahlabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahlabel">Form Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('manager2/tambahDataPenjualanManager'); ?>" method="POST">
                    <div class="modal-body ">
                        <div id="kodeappend">
                            <div>
                                <button type="button" class="btn btn-success mb-3" id="addKode"><i class="fa fa-plus"></i> tambah baru</button>
                            </div>
                            <div class="row">
                                <div class="form-row col-md-2">
                                    <label for="kode">Kode Barang</label>
                                    <select name="kode[]" id="kode0" data-lokasi="0" class="form-control" data-kode-before="" required>
                                        <option value="" selected>Pilih kode barang</option>
                                        <?php foreach ($barang as $kode_brg) : ?>
                                            <option value="<?= $kode_brg['kode']; ?>" data-p="0"><?= $kode_brg['kode'] . ' - ' . $kode_brg['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-row col-md-2">
                                    <label for="fc">FC</label>
                                    <input type="text" name="fc[]" id="fc0" class="form-control">
                                </div>
                                <div class="form-row col-md-2">
                                    <label for="stok">Stok</label>
                                    <input type="text" name="stok[]" id="stok0" class="form-control" readonly>
                                </div>
                                <div class="form-row col-md-2">
                                    <label for="qty">Qty Terjual</label>
                                    <input type="number" min="1" data-lokasi="0" name="qty[]" id="qty0" class="form-control">
                                </div>
                                <div class="form-row col-md-2">
                                    <label for="harga_setor">Harga Setor</label>
                                    <input type="text" name="harga_setor[]" id="harga_setor0" class="form-control" readonly>
                                </div>
                                <div class="form-row col-md-2">
                                    <label for="total_item">Total Item</label>
                                    <input type="text" name="total_item[]" id="total_item0" class="form-control" readonly>
                                </div>
                                <!-- <div class="form-row col-md-1">
                                <button class="btn mt-4 btn-danger" id="del"><i class="fa fa-trash"></i></button>
                            </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mr-auto">
                            <h5>Total Penjualan : <span id="total_penjualan">0</span></h5>
                            <input type="hidden" name="total_penjualan" value="0">
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditlabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditlabel">Form Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('manager2/editDataPenjualanManager'); ?>" method="POST">
                    <div class="modal-body ">
                        <input type="hidden" name="id" value="">
                        <div id="kodeeditappend">
                            <div>
                                <button type="button" class="btn btn-success mb-3" id="addKode"><i class="fa fa-plus"></i> tambah baru</button>
                            </div>
                            <div class="edit">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mr-auto">
                            <h5>Total Penjualan : <span id="total_penjualan">0</span></h5>
                            <input type="hidden" name="total_penjualan" value="0">
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal priview-->
    <div class="modal fade" id="modalpriview" tabindex="-1" aria-labelledby="modalPriviewlabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPriviewlabel">Priview Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.datepicker').datepicker();
        let selectedtambah = [];
        let selectededit = [];

        function sumtotal(cr) {
            var current = cr == 'edit' ? '#modalEdit' : '#modalTambah';
            var subtotal = $(current + ' input[name="total_item[]"]');
            var total = 0;

            $(subtotal).each(function() {
                total += parseFloat(this.value)
            });
            if (!isNaN(total)) {
                $(current + ' #total_penjualan').html(new Intl.NumberFormat("id-ID").format(total));
                $(current + ' input[name="total_penjualan"]').val(total);
            }
        }

        $('#addKode').on('click', function(e) {
            e.preventDefault();
            count = $('#kodeappend .row').length;
            $('#kodeappend').append(`
    <div class="row mt-2">
        <div class="form-row col-md-2">
            <label for="kode">Kode</label>
            <select name="kode[]" data-lokasi="` + (count) + `" id="kode` + (count) + `" data-kode-before="" class="form-control" required>
            <option value="" selected>Pilih kode barang</option>
            <?php foreach ($barang as $kode_brg) : ?>
                <option value="<?= $kode_brg['kode']; ?>" data-p="` + (count) + `"><?= $kode_brg['kode'] . ' - ' . $kode_brg['nama']; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="form-row col-md-2">
            <label for="fc">FC</label>
            <input type="text" name="fc[]" id="fc` + (count) + `" class="form-control">
        </div>
        <div class="form-row col-md-2">
            <label for="stok">Stok</label>
            <input type="text" name="stok[]" id="stok` + (count) + `" class="form-control" readonly>
        </div>
        <div class="form-row col-md-2">
            <label for="qty">Qty Terjual</label>
            <input type="number" min="1" data-lokasi="` + (count) + `" name="qty[]" id="qty` + (count) + `" class="form-control">
        </div>
        <div class="form-row col-md-2">
            <label for="harga_setor">Harga Setor</label>
            <input type="text" name="harga_setor[]" id="harga_setor` + (count) + `" class="form-control" readonly>
        </div>
        <div class="form-row col-md-2">
            <label for="total_item">Total Item</label>
            <input type="text" name="total_item[]" id="total_item` + (count) + `" class="form-control" readonly>
        </div>
        <a href="javascript:;" data-kode="" id="btn_delete_row` + (count) + `" class="btn mt-4 btn-danger btn-delete-row">X</a >
    </div>
    `)
            for (var index in selectedtambah) {
                $("#kodeappend select[name='kode[]']")
                    .find('option[value="' + selectedtambah[index] + '"]:not(:selected)')
                    .prop("disabled", true);
            }
        })

        $('#modalEdit #addKode').on('click', function(e) {
            e.preventDefault();
            count = $('#kodeeditappend .edit .row').length;
            $('#kodeeditappend .edit ').append(`
    <div class="row mt-2">
        <div class="form-row col-md-2">
            <label for="kode">Kode</label>
            <select name="kode[]" data-lokasi="` + (count) + `" id="kode` + (count) + `" data-kode-before="" class="form-control" required>
            <option option value="">Pilih kode barang</option>
            <?php foreach ($barang as $kode_brg) : ?>
                <option value="<?= $kode_brg['kode']; ?>" data-p="` + (count) + `"><?= $kode_brg['kode'] . ' - ' . $kode_brg['nama']; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="form-row col-md-2">
            <label for="fc">FC</label>
            <input type="text" name="fc[]" id="fc` + (count) + `" class="form-control">
        </div>
        <div class="form-row col-md-2">
            <label for="stok">Stok</label>
            <input type="text" name="stok[]" id="stok` + (count) + `" class="form-control" readonly>
        </div>
        <div class="form-row col-md-2">
            <label for="qty">Qty Terjual</label>
            <input type="number" min="1" data-lokasi="` + (count) + `" name="qty[]" id="qty` + (count) + `" class="form-control">
        </div>
        <div class="form-row col-md-2">
            <label for="harga_setor">Harga Setor</label>
            <input type="text" name="harga_setor[]" id="harga_setor` + (count) + `" class="form-control" readonly>
        </div>
        <div class="form-row col-md-2">
            <label for="total_item">Total Item</label>
            <input type="text" name="total_item[]" id="total_item` + (count) + `" class="form-control" readonly>
        </div>
        <a href="javascript:;" data-kode="" id="btn_delete_rowedit` + (count) + `" class="btn mt-4 btn-danger btn-delete-row">X</a >
    </div>
    `)
            // disableUsedOptions('edit');
            for (var index in selectededit) {
                $("#kodeeditappend select[name='kode[]']")
                    .find('option[value="' + selectededit[index] + '"]:not(:selected)')
                    .prop("disabled", true);
            }
        })

        $(document).on('change', '#tgl_mulai', function(e) {
            var tm = document.getElementById("tgl_mulai");
            var ts = document.getElementById("tgl_sampai");
            if (tm.value != '') {
                ts.value = tm.value;
                ts.setAttribute('min', tm.value);
                ts.removeAttribute('disabled');
            } else {
                ts.setAttribute('disabled');
            }
        })

        $('#kodeappend').on('click', '.btn-delete-row', function() {
            $('#addKode').prop('disabled', false);

            var kode = $(this).attr('data-kode');
            var index = selectedtambah.indexOf(kode);
            if (index !== -1) {
                selectedtambah.splice(index, 1);
            }
            $("#kodeappend select[name='kode[]']").find('option[value="' + kode + '"]').prop('disabled', false);

            $(this).parent().remove();
            sumtotal('tambah');
        });

        $('#kodeeditappend').on('click', '.btn-delete-row', function() {
            $('#kodeeditappend #addKode').prop('disabled', false);

            var kode = $(this).attr('data-kode');
            var index = selectededit.indexOf(kode);
            if (index !== -1) {
                selectededit.splice(index, 1);
            }
            $("#kodeeditappend .edit select[name='kode[]']").find('option[value="' + kode + '"]').prop('disabled', false);


            $(this).parent().remove();
            sumtotal('edit');
        });

        $('#kodeappend').on('change', 'select[name="kode[]"]', function() {
            let kodebarang = $(this).val();
            let kb = $(this).attr('data-kode-before');
            $(this).attr('data-kode-before', kodebarang);

            let lokasi = $(this).attr('data-lokasi');
            let fetchUrl = "manager2/barang/" + kodebarang;

            $.ajax({
                url: "<?= base_url(); ?>" + fetchUrl,
                success: function(result) {
                    let results = JSON.parse(result);
                    let data = "";

                    $('#stok' + lokasi).val(results[0].total);
                    $('#harga_setor' + lokasi).val(results[0].hargasetoran);
                    if (lokasi != 0) {
                        $('#btn_delete_row' + lokasi).attr('data-kode', kodebarang);
                    }
                }
            });
            if (kodebarang != '') {
                selectedtambah.push(kodebarang);
                $("#kodeappend select[name='kode[]']").prop('disabled', false);
                for (var index in selectedtambah) {
                    $("#kodeappend select[name='kode[]']")
                        .find('option[value="' + selectedtambah[index] + '"]:not(:selected)')
                        .prop("disabled", true);
                }
                var index = selectedtambah.indexOf(kb);
                if (index !== -1) {
                    selectedtambah.splice(index, 1);
                }
                $("#kodeappend select[name='kode[]']").find('option[value="' + kb + '"]').prop('disabled', false);
            } else {
                var index = selectedtambah.indexOf(kb);
                if (index !== -1) {
                    selectedtambah.splice(index, 1);
                }
                $("#kodeappend select[name='kode[]']").find('option[value="' + kb + '"]').prop('disabled', false);

            }
            sumtotal('tambah');
        });

        $('#kodeeditappend').on('change', 'select[name="kode[]"]', function() {
            let kodebarang = $(this).val();
            let kb = $(this).attr('data-kode-before');
            $(this).attr('data-kode-before', kodebarang);
            let lokasi = $(this).attr('data-lokasi');
            if (lokasi != 0) {
                $('#btn_delete_rowedit' + lokasi).attr('data-kode', kodebarang);
            }
            if (kodebarang != '') {
                let fetchUrl = "manager2/barang/" + kodebarang;

                $.ajax({
                    url: "<?= base_url(); ?>" + fetchUrl,
                    success: function(result) {
                        let results = JSON.parse(result);
                        let data = "";

                        $('#modalEdit #stok' + lokasi).val(results[0].total);
                        $('#modalEdit #harga_setor' + lokasi).val(results[0].hargasetoran);
                    }
                });
                selectededit.push(kodebarang);
                $("#kodeeditappend .edit select[name='kode[]']").prop('disabled', false);
                for (var index in selectededit) {
                    $("#kodeeditappend .edit select[name='kode[]']")
                        .find('option[value="' + selectededit[index] + '"]:not(:selected)')
                        .prop("disabled", true);
                }
                var index = selectededit.indexOf(kb);
                if (index !== -1) {
                    selectededit.splice(index, 1);
                }
                $("#kodeeditappend .edit select[name='kode[]']").find('option[value="' + kb + '"]').prop('disabled', false);
            } else {
                var index = selectededit.indexOf(kb);
                if (index !== -1) {
                    selectededit.splice(index, 1);
                }
                $("#kodeeditappend .edit select[name='kode[]']").find('option[value="' + kb + '"]').prop('disabled', false);

            }
            // disableUsedOptions('edit');
            sumtotal('edit');

        });

        $('#mytable').on('click', '.edit', function() {
            let id = $(this).attr('data-id');
            let fetchUrl = "manager2/editwm/" + id;

            $.ajax({
                url: "<?= base_url(); ?>" + fetchUrl,
                success: function(result) {
                    var data = JSON.parse(result);
                    var konten = ``;
                    $('#modalEdit input[name="id"]').val(id);

                    $.each(data.weekly_manager2_barang, function(key, value) {
                        konten += `
            <div class="row">
                <div class="form-row col-md-2">
                    <label for="kode">Kode Barang</label>
                    <select name="kode[]" id="kode` + (key) + `" data-lokasi="` + (key) + `" data-kode-before="` + (value.kode) + `" class="form-control" data-kode-before="" required>
                    <option value="">Pilih kode barang</option>
                    <?php foreach ($barang as $kode_brg) : ?>
                        <option value="<?= $kode_brg['kode']; ?>"  data-p="` + (key) + `" ` + (value.kode == "<?= $kode_brg['kode'] ?>" ? 'selected' : '') + `><?= $kode_brg['kode'] . ' - ' . $kode_brg['nama']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-row col-md-2">
                    <label for="fc">FC</label>
                    <input type="text" name="fc[]" id="fc` + (key) + `" value="` + (value.fc) + `" class="form-control">
                </div>
                <div class="form-row col-md-2">
                    <label for="stok">Stok</label>
                    <input type="text" name="stok[]" id="stok` + (key) + `" value="` + (value.stok) + `" class="form-control" readonly>
                </div>
                <div class="form-row col-md-2">
                    <label for="qty">Qty Terjual</label>
                    <input type="number" min="1" data-lokasi="` + (key) + `" value="` + (value.qty_terjual) + `" name="qty[]" id="qty` + (key) + `" class="form-control">
                </div>
                <div class="form-row col-md-2">
                    <label for="harga_setor">Harga Setor</label>
                    <input type="text" name="harga_setor[]" id="harga_setor` + (key) + `" value="` + (value.harga_setor) + `" class="form-control" readonly>
                </div>
                <div class="form-row col-md-2">
                    <label for="total_item">Total Item</label>
                    <input type="text" name="total_item[]" id="total_item` + (key) + `" value="` + (value.total_item) + `" class="form-control" readonly>
                </div>`;
                        if (key != 0) {
                            konten += `
                <a href="javascript:;" id="btn_delete_rowedit` + (key) + `" class="btn mt-4 btn-danger btn-delete-row" data-kode="` + (value.kode) + `">X</a >`;
                        }
                        konten += `
                </div>    
                `;
                        selectededit.push(value.kode);

                    });
                    $('#modalEdit .modal-body .edit').html(konten);
                    for (var index in selectededit) {
                        $("#kodeeditappend .edit select[name='kode[]']")
                            .find('option[value="' + selectededit[index] + '"]:not(:selected)')
                            .prop("disabled", true);
                    }


                    $('#modalEdit .modal-footer #total_penjualan').html(new Intl.NumberFormat("id-ID").format(data.weekly_manager2[0].nominal_total));
                    $('#modalEdit .modal-footer input[name="total_penjualan"]').val(data.weekly_manager2[0].nominal_total);

                    $('#modalEdit').modal('show');
                }

            });
        })

        $('#mytable').on('click', '.priview', function() {
            let id = $(this).attr('data-id');
            let fetchUrl = "manager2/priview/" + id;

            $.ajax({
                url: "<?= base_url(); ?>" + fetchUrl,
                success: function(result) {
                    var data = JSON.parse(result);
                    var konten = ``;

                    if (data.weekly_manager2[0].validasi == 'V') {
                        konten += `
            <label>No Invoice Manager PL: <b>` + (data.weekly_manager2[0].no_invoice_manager) + `</b></label><br>
            `
                    }
                    konten += `
            <label>No Invoice : <b>` + (data.weekly_manager2[0].no_invoice) + `</b></label><br>
            <label>Tanggal : <b>` + (data.weekly_manager2[0].tgl) + `</b></label><br>
            <label>Nominal Total : <b>` + (new Intl.NumberFormat("id-ID").format(data.weekly_manager2[0].nominal_total)) + `</b></label><br>
            <label>Validasi : <b>` + (data.weekly_manager2[0].validasi == 'V' ? 'V (sudah tervalidasi)' : 'N (belum tervalidasi)') + `</b></label>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>FC</th>
                        <th>Stok</th>
                        <th>Qty Terjual</th>
                        <th>Harga Setor</th>
                        <th>Total Item</th>
                    <tr>
                <thead>
                <tbody>`;
                    $.each(data.weekly_manager2_barang, function(key, value) {
                        konten += `
                    <tr>
                        <td>` + (value.kode + ' - ' + value.nama) + `</td>
                        <td>` + (value.fc) + `</td>
                        <td>` + (value.stok) + `</td>
                        <td>` + (value.qty_terjual) + `</td>
                        <td>` + (new Intl.NumberFormat("id-ID").format(value.harga_setor)) + `</td>
                        <td>` + (new Intl.NumberFormat("id-ID").format(value.total_item)) + `</td>
                    </tr>
                    `;
                    })
                    konten += `
                </tbody>
                </table>
            </div>
        `;

                    $('#modalpriview .modal-body').html(konten);
                    $('#modalpriview').modal('show');

                }
            });
        });
        $('#mytable').on('click', '.hapus', function() {
            let id = $(this).attr('data-id');
            let fetchUrl = "<?= base_url(); ?>";

            let text = "Apakah anda yakin untuk menghapus ? ";
            if (confirm(text) == true) {
                location.href = fetchUrl + "manager2/hapus/" + id;
            }

        });

        $('#kodeappend').on('input', 'input[name="qty[]"]', function() {
            let lokasi = $(this).attr('data-lokasi');
            let qty = $(this).val();
            let hargaSetor = $('#harga_setor' + lokasi).val();

            var hitung = parseFloat(qty) * parseFloat(hargaSetor);
            if (!isNaN(hitung)) {
                $('#total_item' + lokasi).val(hitung);
                sumtotal('tambah');
            }

        });

        $('#kodeeditappend').on('input', 'input[name="qty[]"]', function() {
            let lokasi = $(this).attr('data-lokasi');
            let qty = $(this).val();
            let hargaSetor = $('#modalEdit #harga_setor' + lokasi).val();

            var hitung = parseFloat(qty) * parseFloat(hargaSetor);
            if (!isNaN(hitung)) {
                $('#modalEdit #total_item' + lokasi).val(hitung);
                sumtotal('edit');
            }

        });
    </script>

    <style>
        option:disabled {
            color: red;
        }
    </style>