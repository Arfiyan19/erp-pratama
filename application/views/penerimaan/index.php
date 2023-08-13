<html>

<head>
    <title>Pencarian data dengan lookup modal bootstrap</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'bootstrap/css/bootstrap.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'datatables/dataTables.bootstrap.css' ?>" />
</head>

<body>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table id="lookup" style="width:750px" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 1;
                        foreach ($data->result_array() as $i) :
                            $nama = $i['nama'];
                            $alamat = $i['alamat'];
                        ?>
                            <tr class="pilih" data-nama="<?php echo $nama; ?>" data-alamat="<?php echo $alamat; ?>">
                                <td><?php echo $nama; ?></td>
                                <td><?php echo $alamat; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() . 'js/jquery-1.11.2.min.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'bootstrap/js/bootstrap.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'datatables/jquery.dataTables.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'datatables/dataTables.bootstrap.js' ?>" type="text/javascript"></script>
    <script>
        $(function() {
            $('#lookup').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
    <script type="text/javascript">
        //            jika dipilih, nim akan masuk ke input dan modal di tutup
        $(document).on('click', '.pilih', function(e) {
            document.getElementById("nama").value = $(this).attr('data-nama');
            $('#myModal').modal('hide');
            document.getElementById("alamat").value = $(this).attr('data-alamat');
            $('#myModal').modal('hide');
        });


        //            tabel lookup mahasiswa
        $(function() {
            $("#lookup").dataTable();
        });

        function dummy() {
            var nama = document.getElementById("nama").value;
            alert('Nama ' + nama + ' berhasil tersimpan');


            var alamat = document.getElementById("alamat").value;
            alert('Alamat ' + alamat + ' berhasil tersimpan');

        }
    </script>


</body>

</html>
<div class="content-wrapper col-12">
    <section class="content-header ml mt-2 auto">

        <form action="" method="post">
            <div class="row mt-3">
                <div class="col-4">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label for="weekending" class="input-group-text">Supplier :</label>
                        </div>
                        <input type="text" name="supplier" id="nama" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <div class="input-group-prepend">
                            <label for="alamat" class="input-group-text">No. Sj Supplier :</label>
                        </div>
                        <input type="text" name="no_sj" class="form-control form-control-sm">
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <div class="input-group-prepend">
                            <label for="namawin2mgr" class="input-group-text">Tgl</label>
                        </div>
                        <input type="text" name="tanggal" value="<?php echo date('d/m/Y'); ?>" class="form-control form-control-sm">
                        <span>&nbsp; sd &nbsp;</span>
                        <input type="text" name="tanggal_sampai" value="<?php echo date('d/m/Y'); ?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label for="weekending" class="input-group-text">No. LPB :</label>
                        </div>
                        <input type="text" name="no_lpb" value="<?php echo $kode1; ?>" class="form-control form-control-sm">
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <div class="input-group-prepend">
                            <label for="alamat" class="input-group-text">No. PO :</label>
                        </div>
                        <input type="text" name="no_po" class="form-control form-control-sm">
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <div class="input-group-prepend">
                            <label for="namawin2mgr" class="input-group-text">No. Kontainer :</label>
                        </div>
                        <input type="text" name="no_kontiner" class="form-control form-control-sm">
                        <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
                    </div>


                </div>
                <div class="col-4">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label for="weekending" class="input-group-text">No. Polisi :</label>
                        </div>
                        <input type="text" name="no_polisi" class="form-control form-control-sm">
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <div class="input-group-prepend">
                            <label for="alamat" class="input-group-text">Nama Driver :</label>
                        </div>
                        <input type="text" name="nama_supir" class="form-control form-control-sm">
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <div class="input-group-prepend">
                            <label for="namawin2mgr" class="input-group-text">No. Segel :</label>
                        </div>
                        <input type="text" name="no_segel" class="form-control form-control-sm">
                        <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-info mb-2 mt-2">Submit</button>
                    <a href="<?php echo base_url('penerimaan/tambah'); ?>" class="btn btn-primary mb-2 mt-2">Tambah Data</a>
                </div>
            </div>
        </form>




        </ol>
        <div style="margin-left:5px">

            <div class="">
                <?php if ($this->session->flashdata('flash2')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Penerimaan <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">Data Penerimaan <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr style="text-align:center;">
                                <th style="text-align:center;">No.</th>
                                <th>NO LPB</th>
                                <th>Nama Supplier</th>
                                <th>No SJ Supplier</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>

                        <?php
                        $no = 1;
                        $total_seluruh = 0;
                        foreach ($data1->result_array() as $i) :
                            $id = $i['id'];
                            $no_lpb = $i['no_lpb'];
                            $supplier = $i['supplier'];
                            $no_sj = $i['no_sj'];
                            $tanggal = $i['tanggal'];
                            $total = $i['total_harga'];
                            $total_seluruh += $total;
                        ?>
                            <tr>
                                <td style="text-align:center;">
                                    <?php echo $no++ ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php echo $no_lpb ?>
                                </td>
                                <td>
                                    <?php echo $supplier ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php echo $no_sj ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php echo number_format($total, 2, ',', '.'); ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php echo $tanggal ?>
                                </td>
                                <td style="text-align:center;">

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="<?= base_url(); ?>penerimaan/edit/<?= $id; ?>" class="btn btn-success mt-2" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
                                            <a href="<?= base_url(); ?>penerimaan/cetak/<?= $id; ?>" class="btn btn-success mt-2" style="margin-left:42px"><i class="fa fa-print"></i>Cetak</i></a>
                                            <a href="<?= base_url(); ?>penerimaan/hapus/<?= $id; ?>" class="btn btn-danger mt-2" style="margin-left:35px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align:center;" colspan="4">Total</th>
                                <th style="text-align:center;"><?php echo number_format($total_seluruh, 2, ',', '.'); ?></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>