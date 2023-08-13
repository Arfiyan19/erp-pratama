<div class="content-wrapper col-12 mb-4">

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
    <?php if($this->session->flashdata('flash2')) :?>
        <div class="row mt-3">
            <div class="col md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Pendapatan Lain <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>    
        </div>
    <?php endif;?>

    <?php if($this->session->flashdata('flash')) :?>
        <div class="row mt-3">
            <div class="col md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">Data Pendapatan Lain <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>    
        </div>
    <?php endif;?>

    <form action="<?= base_url('pendapatan/filter');?>" method="get">
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
                    <input type="date" name="tanggal_sampai" value="<?php echo date('Y-m-d'); ?>"  min="<?php echo date('Y-m-d'); ?>" id="tanggal_sampai" class="form-control form-control-sm">
                    <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
                </div>
            </div>
            <div class="col-lg-4">
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                <a href="<?= base_url('pendapatan');?>" class="btn btn-danger btn-sm">Reset</a>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= base_url('pendapatan/tambah');?>" class="btn btn-primary mb-2 mt-2">Tambah Data</a>
            <div class="table-responsive">
                <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">
                    <thead>
                        <tr style="text-align:center">
                            <th>No.</th>
                            <th>Tgl</th>
                            <th>No. Faktur</th>
                            <th>Nominal</th>
                            <th>Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        <?php $total=0;?>
                        <?php foreach ($pendapatanlain as $pen): 
                            
                            $total += (int) $pen['jumlah_total']?>
                        <tr>
                            <td style="text-align:center">
                                <?php echo $i;?>
                            </td>
                            <td>
                                <?php echo $pen['tgl'] ?>
                            </td>
                            <td>
                                <?php echo $pen['no_faktur'] ?>
                            </td>
                            <td>
                                <?php echo number_format($pen['jumlah_total'], 2, ',', '.') ?>
                            </td>
                            <td width="">
                                <?php echo $pen['rekening'] ?>
                            </td>
                            
                            <td style="text-align:center">
                            
                            <!-- <div class="btn-group" > -->
                                <!-- <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu"> -->
                                <a href="<?php echo base_url();?>pendapatan/edit/<?= $pen['id'];?>" class="btn btn-success" style=""><i class="fa fa-edit"></i>Edit</i></a>
                                <a href="<?= base_url();?>pendapatan/hapus/<?= $pen['id'];?>" class="btn btn-danger " style="" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                                <!-- </div> -->
                            <!-- </div> -->
                            </td>
                        </tr>
                        <?php $i++;?>
                        <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot id="tfooter">
                        <tr>
                            <th colspan="2"></th>
                            <th><h5><b>Total</b></h5></th>
                            <th><h5><b><?= number_format($total, 2, ',', '.') ?><b></h5></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>  
        </div>
    </div>
</div>