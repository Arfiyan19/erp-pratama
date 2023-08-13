<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

</ol>
<div style="margin-left:5px">

<div class="">
<?php if($this->session->flashdata('flash2')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Produk <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>

<?php if($this->session->flashdata('flash')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">Data Produk <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>
<!-- <div class="btn-group"> -->
<div class="row mt-3">
        <div class="col-lg-4">
            <form action="" method="get">
                <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                        <label for="weekending" class="input-group-text">Kode :</label>
                    </div>
                    <input type="text" name="kode" id="kode" value="<?= isset($_GET['kode']) ? $_GET['kode'] : ''; ?>" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <label for="noinv" class="input-group-text">Barang :</label>
                    </div>
                    <input type="text" name="barang" id="barang" value="<?= isset($_GET['barang']) ? $_GET['barang'] : ''; ?>" class="form-control form-control-sm">
                </div>
                <!-- <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="namawin2mgr" class="input-group-text">Nama Win2 Mgr :</label>
                    </div>
                    <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm">
                    <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm">
                </div> -->
                <!-- <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="security" class="input-group-text">Akun Security :</label>
                    </div>
                    <input type="text" name="security" id="security" class="form-control form-control-sm">
                    <input type="text" name="security" id="security" class="form-control form-control-sm">
                </div> -->
                <a href="<?= base_url('barang2'); ?>" class="btn btn-danger" >Reset</a>
                <button type="submit" class="btn btn-secondary" >Cari</button>
            </form>
        </div>
        <div class="col-lg-2">
        <form action="<?= base_url('barang2'); ?>" method="post">
            <input type="hidden" name="show" value="true">
            <!-- <button type="submit" class="btn btn-primary">Show All </button> -->
        </form>
        </div>
        <div class="col-lg-4">
            <form action="" method="post">
                <div class="d-flex">
                <div class="input-group input-group-sm">
                    <!-- <div class="input-group-prepend">
                        <label for="manager" class="input-group-text">Manager :</label>
                    </div> -->
                    <!-- <input type="text" name="manager" id="manager" class="form-control form-control-sm"> -->
                    <!-- <select name="asmen" id="manager" class="form-control form-control-sm">
                            <option value="">Pilihan #1</option>
                            <option value="">Pilihan #2</option>
                            <option value="">Pilihan #3</option>
                        </select> -->
                </div>
                    <!-- <div class="form-check form-check-inline">
                        <input type="checkbox" name="koreksi" id="koreksi" class="form-check-input">
                        <label class="form-check-label">Koreksi</label>
                    </div> -->
                </div>
                <div class="input-group input-group-sm">
                    <!-- <div class="input-group-prepend">
                        <label for="manager" class="input-group-text">Manager :</label>
                    </div> -->
                    <!-- <input type="text" name="manager" id="manager" class="form-control form-control-sm"> -->
                    <!-- <select name="asmen" id="manager" class="form-control form-control-sm">
                            <option value="">Pilihan #1</option>
                            <option value="">Pilihan #2</option>
                            <option value="">Pilihan #3</option>
                        </select> -->
                </div>
                <!-- <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="id" class="input-group-text">ID :</label>
                    </div>
                    <input type="text" name="id" id="id" class="form-control form-control-sm">
                </div> -->
            </form>
        </div>
        <div class="col-lg-2">
        <!-- <form action="" method="post">
        <button type="submit" class="btn btn-primary">Filter</button>
        </form> -->
        </div>
    </div>
    
<!-- <a href="<?= base_url('barang/laporan_pdf');?>" class="btn btn-danger mb-2">Export PDF</a> -->

<hr>

<!-- </div> -->
<div class="">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr >
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>QTY Masuk</th>
                <th>QTY Keluar</th>
                <th>Saldo Barang</th>
                <th>Harga Setoran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produk as $item): ?>
                <tr>
                    <td><?= $item['kode'] ?></td>
                    <td><?= $item['nama'] ?></td>
                    <td>-</td>
                    <td><?= $item['total'] ?></td>
                    <td>-</td>
                    <td><?= $item['total'] ?></td>
                    <td>Rp <?= number_format($item['hargasetoran'], 0, ',', '.') ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Untuk Footer Bawah -->
    </div>
</div>