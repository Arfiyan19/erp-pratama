<div class="content-wrapper col-12">
    <section class="content-header ml mt-2 auto">

        <?php if ($this->session->flashdata('flash2')) : ?>
            <div class="row mt-3">
                <div class="col md-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Penyesuaian Persediaan <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="row mt-3">
                <div class="col md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">Data Penyesuaian Persediaan <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- <h1>Stok Akhir</h1> -->
        <div class="row mt-3 mb-2">
            <div class="col-lg-4">
                <form action="" method="post">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label for="weekending" class="input-group-text">Cari Kode Barang:</label>
                        </div>
                        <!-- <select name="" id="" class="form-control">
                    <option value="">Weekending Up</option>
                </select> -->
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mt-1 mb-1">

                    </div>

                </form>
            </div>
            <div class="col-lg-4">
                <form action="" method="post">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label for="weekending" class="input-group-text">Tgl Awal:</label>
                        </div>
                        <input type="date" class="form-control">

                    </div>
                    <div class="input-group input-group-sm mt-1 mb-1">
                        <div class="input-group-prepend">
                            <label for="noinv" class="input-group-text">Tgl Akhir :</label>
                        </div>
                        <input type="date" class="form-control">
                    </div>

                </form>
            </div>
            <div class="col-lg-4">
                <div class="input-group input-group-sm mt-1 mb-1">
                    <div class="">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?= base_url('Adjust_stok/tambah'); ?>" class="btn btn-info mb-2">Tambah Data</a>
        <div class="table-responsive">
            <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

                <thead>
                    <tr style="text-align:center">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>No. Faktur</th>
                        <th>Keterangan</th>
                        <th>Gudang Asal</th>
                        <th>Gudang Tujuan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dataAdjust as $ret) : ?>
                        <tr>
                            <td style="text-align:center">
                                <?php echo $i; ?>
                            </td>
                            <td>
                                <?php echo $ret['tgl'] ?>
                            </td>
                            <td width="">
                                <?php echo $ret['no_penyesuaian'] ?>
                            </td>
                            <td width="">
                                <?php echo $ret['keterangan'] ?>
                            </td>
                            <td width="">
                                <?php echo $ret['gudang_asal'] ?>
                            </td>
                            <td width="">
                                <?php echo $ret['gudang_tujuan'] ?>
                            </td>
                            <td width="">
                                <?php echo $ret['qty'] ?>
                            </td>
                            <td style="text-align:center">
                                <a href="<?php echo base_url(); ?>Adjust_stok/edit/<?= $ret['id']; ?>" class="btn btn-success" style=""><i class="fa fa-edit"></i></i></a>
                                <a href="<?= base_url(); ?>Adjust_stok/hapus/<?= $ret['id']; ?>" class="btn btn-danger " style="" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
</div>