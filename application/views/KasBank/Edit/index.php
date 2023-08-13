<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title"><?= $title; ?></h3> -->
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor</label>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control" name="error" id="error" readonly>
                                            <input type="text" class="form-control" name="nomor_kas_bank" id="nomor_kas_bank" placeholder="AUTO" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control datepicker" name="tanggal" id="tanggal" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- load file nav tab list -->
                            <?php $this->load->view("KasBank/component/navTabList") ?>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="<?= base_url('Kas_bank') ?>" class="btn btn-dark">Kembali</a>
                            <button type="button" class="btn btn-success" onclick="handleSaveData()">Simpan</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- load modal -->
<?php $this->load->view("KasBank/component/modal/showData") ?>