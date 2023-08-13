<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="m-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mitra / Pelanggan:</label>
                            <select class="form-control mitra" name="mitra" id="mitra">
                                <option value="all">All Mitra</option>
                                <?php foreach ($clients as $key => $client) { ?>
                                    <option value="<?= $client->id ?>"><?= $client->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Usia Hutang : </label>
                            <select class="form-control" name="usiaHutang" id="usiaHutang">
                                <option value="" disabled selected>Pilih Usia Utang</option>
                                <option value="kurang30">Kurang Dari 30 Hari</option>
                                <option value="0">0 Hari</option>
                                <option value="lebih30">Lebih Dari 30 Hari</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tanggal Awal:</label>
                            <input type="date" class="form-control datepicker" name="tanggalawal" id="tanggalawal">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tanggal Akhir:</label>
                            <input type="date" class="form-control datepicker" name="tanggalakhir" id="tanggalakhir">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-right">
                            <button class="btn-block btn btn-success" onclick="handleFilterDataPiutang()"><i class="fas fa-filter"></i> Filter</button>
                            <button class="btn-block btn btn-warning" onclick="handleResetDataPiutang()">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover" id="index_datatable">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>Nama Perusahaan</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Tgl J/T</th>
                                            <th>Nominal Piutang</th>
                                            <th>Nominal Pembayaran</th>
                                            <th>Sisa Piutang</th>
                                            <th class="text-center">Usia Hutang</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr class="bg-success text-white">
                                            <th class="text-right" colspan="4">Total</th>
                                            <th class="text-right" id="totNominalPiutang"></th>
                                            <th class="text-right" id="totNominalPembayaran"></th>
                                            <th class="text-right" id="totSisaPiutang"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>