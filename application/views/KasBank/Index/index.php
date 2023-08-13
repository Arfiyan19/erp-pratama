<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <?php if ($this->session->flashdata('flash2')) : ?>
                <div class="row mt-3">
                    <div class="col md-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Kas Bank <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                            <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('flash')) : ?>
                <div class="row mt-3">
                    <div class="col md-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">Data Kas Bank <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                            <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('Kas_bank/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-bordered table-hover" id="tableDataKasBank">
                                    <thead>
                                        <tr class="bg-primary text-white text-center">
                                            <th>Tanggal</th>
                                            <th>Nomor</th>
                                            <th>Penerimaan</th>
                                            <th>Pengeluaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr class="bg-success text-white">
                                            <th class="text-right" colspan="2">Total</th>
                                            <th class="text-right" id="totPenerimaan"></th>
                                            <th class="text-right" id="totPengeluaran"></th>
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