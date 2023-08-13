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

        </ol>
        <div style="margin-left:5px">

            <div class="">
                <?php if ($this->session->flashdata('flash2')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Mitra <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">Data Mitra <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <a href="<?= base_url('daftar/export'); ?>" class="btn btn-danger mb-3 mt-2">Export PDF</a>

                <div class="table-responsive">
                    <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Tgl_lahir</th>
                                <th>Jabatan</th>
                                <th>Promoter</th>
                                <th>Thn Gabung</th>
                                <th>Gudang</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($daftarmitra as $daf) : ?>
                                <tr>
                                    <td width="">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $daf['kode'] ?>
                                    </td>
                                    <td width="">
                                        <?php echo $daf['name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $daf['tgl_lahir'] ?>
                                    </td>
                                    <td>
                                        <?php echo $daf['jabatan'] ?>
                                    </td>
                                    <td>
                                        <?php echo $daf['promoter'] ?>
                                    </td>
                                    <td>
                                        <?php echo $daf['thn_gabung'] ?>
                                    </td>
                                    <td>
                                        <?php echo $daf['gudang'] ?>
                                    </td>
                                    <td class="">
                                        <?php echo $daf['alamat'] ?>
                                    </td>
                                    <td class="">
                                        <?php echo $daf['kota'] ?>
                                    </td>
                                    <td class="">
                                        <?php echo $daf['telepon'] ?>
                                    </td>
                                    <td class="">
                                        <?php echo $daf['email'] ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="<?php echo base_url(); ?>daftar/edit/<?= $daf['id']; ?>" class="btn btn-success" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
                                                <a href="<?= base_url(); ?>daftar/hapus/<?= $daf['id']; ?>" class="btn btn-danger mt-2" style="margin-left:35px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>