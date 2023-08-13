<div class="container">
    <?php if($this->session->flashdata('flash2')) :?>
    <div class="row mt-3">
        <div class="col md-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">Return Supplier <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
            <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>    
    </div>
    <?php endif;?>

    <?php if($this->session->flashdata('flash')) :?>
    <div class="row mt-3">
        <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">Return Supplier <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
            <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>    
    </div>
    <?php endif;?>

    <div class="row mb-2">
        <div class="col-lg-6">
            <form action="" method="post">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label for="weekending" class="input-group-text">Tanggal Awal :</label>
                    </div>
                    <input type="date" name="weekending" id="weekending" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="noinv" class="input-group-text">Tanggal Akhir :</label>
                    </div>
                    <input type="date" name="noinv" id="noinv" class="form-control form-control-sm">
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <form action="" method="post">
                <div class="input-group input-group-sm mb-1">
                    <label for="jabatan" class="btn btn-primary">Cari</label>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <a href="<?= base_url('return_supplier/tambah');?>" class="btn btn-info mb-2">Tambah Data</a>

            <table class="table table-responsive table-striped table-bordered table-hover table-sm" cellspacing="0">
                <thead> 
                    <tr style="text-align:center">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>No. Return</th>
                        <th>Keterangan</th>
                        <th>Kode</th>
                        <th>Barang</th>
                        <th>Gudang Asal</th>
                        <th>Supplier Tujuan</th>
                        <th>Gudang Jumlah </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($return_supplier as $ret): ?>
                    <tr>
                        <td style="text-align:center">
                            <?php echo $i;?>
                        </td>
                        <td>
                            <?php echo $ret['tanggal'] ?>
                        </td>
                        <td>
                            <?php echo $ret['no_return'] ?>
                        </td>
                        <td>
                            <?php echo $ret['keterangan'] ?>
                        </td>
                        <td>
                            <?php echo $ret['kode'] ?>
                        </td>
                        <td>
                            <?php echo $ret['barang'] ?>
                        </td>
                        <td>
                            <?php echo $ret['gudang_asal'] ?>
                        </td>
                        <td>
                            <?php echo $ret['supplier_tujuan'] ?>
                        </td>
                        <td>
                            <?php echo $ret['jumlah'] ?>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="<?= base_url('return_supplier/edit/') . $ret['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                &nbsp;
                                <a href="<?= base_url('return_supplier/hapus/') . $ret['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++;?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
