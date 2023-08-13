<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="m-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Supplier:</label>
                            <select class="form-control supplier" name="supplier" id="supplier">
                                <option value="all">All Supplier</option>
                                <?php foreach ($suppliers as $key => $supplier) { ?>
                                    <option value="<?= $supplier->nama ?>"><?= $supplier->nama ?></option>
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
                            <button class="btn-block btn btn-success" onclick="handleFilterDataHutang()"><i class="fas fa-filter"></i> Filter</button>
                            <button class="btn-block btn btn-warning" onclick="handleResetDataHutang()">Reset</button>
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
                                            <th>Supplier</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Tgl J/T</th>
                                            <th>Nominal Utang</th>
                                            <th>Nominal Pembayaran</th>
                                            <th>Sisa Utang</th>
                                            <th class="text-center">Usia Hutang</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr class="bg-success text-white">
                                            <th class="text-right" colspan="4">Total</th>
                                            <th class="text-right" id="totNominalUtang"></th>
                                            <th class="text-right" id="totNominalPembayaran"></th>
                                            <th class="text-right" id="totSisaUtang"></th>
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