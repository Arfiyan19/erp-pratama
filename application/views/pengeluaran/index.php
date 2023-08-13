<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

<!-- <ol class=""> -->
<!-- <h2>
    Menu Data Produk
    <div class="row mt-3">
    <div class="col-md-6">
        <form action="" method="post">
            <div class="input-group">
            <input type="text" name="keyword" id="" placeholder="Cari Data Produk..." class="form-control" autocomplete="off">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            </div>
        </form>
    </div>
</div>
</h2> -->

  

<!-- </ol> -->
<script>
        $(document).on('change', '#tanggal_mulai', function(e) {
            var tm = document.getElementById("tanggal_mulai");
            var ts = document.getElementById("tanggal_sampai");
            if(tm.value != ''){
                ts.value = tm.value;
                ts.setAttribute('min', tm.value);
                ts.removeAttribute('disabled');
            }
            else{
                ts.setAttribute('disabled');
            }
            console.log(tm.value);
        })
    </script>
<div style="margin-left:5px">

<div class="">

<form action="<?= base_url('pengeluaran/filter');?>" method="get">
    <div class="row">
        <div class="col-lg-4">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="tanggal_mulai" class="input-group-text">Tanggal Awal:</label>
                </div>
                <input type="date" name="tanggal" id="tanggal_mulai" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="tanggal_sampai" class="input-group-text">Taggal Akhir :</label>
                </div>
                <input type="date" name="tanggal_sampai" id="tanggal_sampai" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm">
                <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
            </div>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            <a href="<?= base_url('pengeluaran');?>" class="btn btn-danger btn-sm">Reset</a>
        </div>
    </div>
</form>
<hr>
<?php if($this->session->flashdata('flash2')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Pengeluaran <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>

<?php if($this->session->flashdata('flash')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">Data Pengeluaran <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>
<a href="<?= base_url('pengeluaran/tambah');?>" class="btn btn-info mb-2">Tambah Data</a>
<div class="table-responsive">
<!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable mb-4" cellspacing="0" width="" style="font-size: small;">

        <thead>
            <tr style="text-align:center;">
                <th style="text-align:center;">No.</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Bukti Transaksi</th>
                <th>Rekeneing</th>
                <th>Jumlah Total</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;?>
            <?php $total=0;?>
            <?php foreach ($pengeluaran as $pen): 
                $total += floatval($pen['total_pengeluaran']);
                ?>
            <tr>
                <td style="text-align:center;">
                    <?php echo $i;?>
                </td>
                <td style="text-align:center;">
                    <?php echo $pen['tgl'] ?>
                </td>
                <td>
                    <?php echo $pen['uraian'] ?>
                </td>
                <td style="text-align:center;">
                    <?php echo $pen['reff'] ?>
                </td>
                <td style="text-align:center;">
                    <?php echo $pen['rekening'] ?>
                </td>
                <td style="text-align:center;">
                    <?= number_format($pen['total_pengeluaran'], 2, ',', '.') ?>
                </td>
                <td style="text-align:center;">
                
                <div class="btn-group" >
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                    <a href="<?php echo base_url();?>pengeluaran/edit/<?= $pen['id'];?>" class="btn btn-success" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
                    <a href="<?= base_url();?>pengeluaran/hapus/<?= $pen['id'];?>" class="btn btn-danger mt-2" style="margin-left:35px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                    </div>
                </div>
                </td>
            </tr>
            <?php $i++;?>
            <?php endforeach; ?>
        </tbody>
        <tfoot id="tfooter">
            <tr>
                <th colspan="4"></th>
                <th><h5><b>Total</b></h5></th>
                <th><h5><b><?= number_format($total, 2, ',', '.') ?><b></h5></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    </div>
</div>