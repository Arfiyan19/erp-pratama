

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
    <?php if($this->session->flashdata('flash2')) :?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Karyawan <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>    
    </div>
<?php endif;?>

<?php if($this->session->flashdata('flash')) :?>
    <div class="row mt-3">
        <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">Data Karyawan <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
            <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>

<!-- <h5 class="text-bold">Manager P & L</h5> -->

<div class="row mt-3 mb-2">
    <div class="col-lg-4">
        <form action="" method="post">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="weekending" class="input-group-text">Cari Faktur :</label>
                </div>
                <input type="text" name="weekending" id="weekending" class="form-control">
            </div>
            
        </form>
    </div>
    <div class="col-lg-4">
        <form action="<?= base_url('Manager2/search') ?>" method="get">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="jabatan" class="input-group-text">Tgl Awal :</label>
                </div>
                <input type="date" name="start_date" id="" class="form-control">
            </div>
            <!-- <div class="d-flex mt-1"> -->
                <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="jabatan" class="input-group-text">Tgl Akhir :</label>
                </div>
                <input type="date" name="end_date" id="" class="form-control">
            </div>
            <button for="jabatan" class="btn mt-3 btn-secondary">Cari</button>
        </form>
    </div>
    <div class="col-lg-4">
            <div class="input-group input-group-sm">
                <div class="">
                </div>
                <!-- <input type="date" name="" id="" class="form-control"> -->
            </div>
            <!-- <div class="d-flex mt-1"> -->
                <div class="input-group input-group-sm mt-1">
                <div class="">
                    <button for="jabatan" class="btn btn-danger">Hapus</buttton>
                </div>
                <!-- <input type="date" name="" id="" class="form-control"> -->
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <button for="jabatan" class="btn btn-warning">Koreksi</button>
                </div>
                <select name="" id="" class="form-control">
                    <option value="">Penjualan</option>
                    <option value="">Pembayaran</option>
                </select>
            </div>
    </div>
</div>



<div class="table-responsive">
    <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
        <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

            <thead>
                <th>
                    <td>-</td>
                    <td>No. Inv</td>
                    <td>Tanggal</td>
                    <td>Nominal Total</td>
                    <td>Status tutup Buku</td>
                    <td>Aksi</td>
                </th>
            </thead>
            <?php foreach($datas as $data) : ?>
            <tbody>
                <th>
                    <td><input type="checkbox" name="" id=""></td>
                    <td><?= $data['no_invoice'] ?></td>
                    <td><?= $data['tgl'] ?></td>
                    <td><?= $data['hargasetoran'] ?></td>
                    <td><?= $data['tutup_buku'] ?></td>
                    <td>
                        <a href="<?= base_url('Manager2/edit/') ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= base_url('Manager2/hapus/') ?>" class="btn btn-danger">Hapus</a>
                        <a href="" class="btn btn-success">Preview</a>
                    </td>
                </th>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <!-- ./table-responsive -->
    <a href="<?= base_url('manager2');?>" class="btn btn-primary">Kembali</a>
</div>

<!-- ./container-fluid -->
</div>
