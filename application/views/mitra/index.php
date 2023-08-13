<html>
	<head>
        <title>Pencarian data dengan lookup modal bootstrap</title>
		 <link rel="stylesheet" href="<?php echo base_url().'bootstrap/css/bootstrap.css'?>"/>
        <link rel="stylesheet" href="<?php echo base_url().'datatables/dataTables.bootstrap.css'?>"/>
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
                                 <th>Kode</th>
								<th>Nama Mitra</th>
								<th>Jabatan</th>
								<th>Promoter</th>
								<th>Gudang</th>
								<th>Alamat</th>
                                </tr>
                            </thead>
                                <?php 
							$no = 1;				   
							foreach($data->result_array() as $i):
								$kode=$i['kode'];
								$nama=$i['name'];
								$kota=$i['kota'];
								$telepon=$i['telepon'];
								$tgl_lahir=$i['tgl_lahir'];
								$jabatan=$i['jabatan'];
								$promoter=$i['promoter'];
								$gudang=$i['gudang'];
								$alamat=$i['alamat'];
					
						?>
                                    <tr class="pilih" data-kota="<?php echo $kota; ?>" data-nama="<?php echo $nama; ?>" data-alamat="<?php echo $alamat; ?>" data-telepon="<?php echo $telepon; ?>" data-tgl_lahir="<?php echo $tgl_lahir; ?>" data-id="<?php echo $kode ?>">
                                        <td><?php echo $kode; ?></td>
                                        <td><?php echo $nama; ?></td>
										<td><?php echo $jabatan; ?></td>
										<td><?php echo $promoter; ?></td>
										<td><?php echo $gudang; ?></td>
                                        <td><?php echo $alamat; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                           
                        </table>  
                    </div>
                </div>
            </div>
        </div>
		<script src="<?php echo base_url().'js/jquery-1.11.2.min.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url().'bootstrap/js/bootstrap.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url().'datatables/jquery.dataTables.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url().'datatables/dataTables.bootstrap.js'?>" type="text/javascript"></script>
		<script>
  $(function () {
    $('#lookup').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
        <script type="text/javascript">

//            jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("nama").value = $(this).attr('data-nama');
                $('#myModal').modal('hide');
				document.getElementById("kota").value = $(this).attr('data-kota');
                $('#myModal').modal('hide');
				document.getElementById("alamat").value = $(this).attr('data-alamat');
                $('#myModal').modal('hide');
				document.getElementById("telepon").value = $(this).attr('data-telepon');
                $('#myModal').modal('hide');
				document.getElementById("tgl_lahir").value = $(this).attr('data-tgl_lahir');
                $('#myModal').modal('hide');
				document.getElementById("id").value = $(this).attr('data-id');
                $('#myModal').modal('hide');
            });
			

//            tabel lookup mahasiswa
            $(function () {
                $("#lookup").dataTable();
            });

            function dummy() {
                var nama = document.getElementById("nama").value;
                alert('Nama ' + nama + ' berhasil tersimpan');
				
				var kota = document.getElementById("kota").value;
                alert('Kota ' + kota + ' berhasil tersimpan');
				
				var alamat = document.getElementById("alamat").value;
                alert('Alamat ' + alamat + ' berhasil tersimpan');
				
				var telepon = document.getElementById("telepon").value;
                alert('Telepon ' + kota + ' berhasil tersimpan');
				
				var tgl_lahir = document.getElementById("tgl_lahir").value;
                alert('Tanggal Lahir ' + tgl_lahir + ' berhasil tersimpan');
				
				var id = document.getElementById("$id").value;
                alert('No DO ' + id + ' berhasil tersimpan');
            }
        </script>


</body>
</html>

<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

<div class="row mt-3">
        <div class="col-lg-4">
            <form action="<?= base_url('');?>" method="post">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label for="weekending" class="input-group-text">Kepada :</label>
                    </div>
                    <input type="text" name="nama" id="nama" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="alamat"  class="input-group-text">Alamat :</label>
                    </div>
                    <input type="text" name="alamat" id="alamat" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="namawin2mgr" class="input-group-text">Kota/Kec :</label>
                    </div>
                    <input type="text" name="kota" id="kota" class="form-control form-control-sm">
                    <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="security" class="input-group-text">No. Telepon :</label>
                    </div>
                    <input type="text" name="telepon" id="telepon" class="form-control form-control-sm">
                    <!-- <input type="text" name="security" id="security" class="form-control form-control-sm"> -->
                </div>
	
            </form>
        </div>

        <div class="col-lg-6">
            <form action="<?= base_url('');?>" method="post">
                <div class="d-flex">
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="taggal" class="input-group-text">Tanggal :</label>
                    </div>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm">
                </div>
                </div>
                <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                        <label for="no_do" class="input-group-text">No. DO :</label>
                    </div>
                    <input type="text" name="no_do" id="id" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                        <label for="manager_gudang" class="input-group-text">Manager Gudang :</label>
                    </div>
                    <input type="text" name="manager_gudang" id="manager_gudang" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                        <label for="no_kontainer" class="input-group-text">No. Kontainer :</label>
                    </div>
                    <input type="text" name="no_kontainer" id="no_kontainer" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                        <label for="no_segel" class="input-group-text">No. Segel :</label>
                    </div>
                    <input type="text" name="no_segel" id="no_segel" class="form-control form-control-sm">
                </div>
                </div>   
            </form>
        </div>

  

</ol>
<div style="margin-left:5px">

<div class="">
<?php if($this->session->flashdata('flash2')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Pengiriman <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>

<?php if($this->session->flashdata('flash')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">Data Pengiriman <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>
<a href="<?= base_url('pengiriman/tambah');?>" class="btn btn-info mb-2">Tambah Data</a>
<div class="table-responsive">
<!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

        <thead>
            <tr style="text-align:center;">
                <th style="text-align:center;">No.</th>
                <th>No DO</th>
                <th>Mitra</th>
                <th>Tgl Pengiriman</th>
                <th>Tgl j.t</th>
                <th>Jenis Trans</th>
                <th>Set Up Jurnal</th>
                <th>Total Nominal</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>23123</td>
                <td>22-03-1002</td>
                <td>19-05-2002</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>
                    <button type="button" class="btn btn-success">Preview</button>
                </td>
            </tr>
        </tbody>
    </table>
    </div>

<!-- ============ MODAL ADD Kategori =============== -->
   <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
              <section class="content">
			<div class="row">
			  <div class="col-md-12">
			  <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <form role="form" method="post" action="<?php echo base_url().'pengiriman/tambah'?>">
              <div class="box-body">
                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputKode">ID</label>
                <input type="text" class="form-control" id="inputKode" name="kode_id" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputNama">Nama</label>
                <input type="text" class="form-control" id="inputNama" name="nama" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputQty">Qty Karton</label>
                <input type="text" class="form-control" id="inputQty" name="qty_karton" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputKarton">Qty Per Karton</label>
                <input type="text" class="form-control" id="inputKarton" name="qty_perkarton" required>
                </div>
            </div>

                <div class="form-group">
                <label for="inputEmail">Total</label>
                <input type="text" class="form-control" id="inputEmail" name="total" required>
                </div>
                
 
              </div>
              <!-- /.box-body -->

            
            
			</div>
			</div>
			</section>
              </div>
              <div class="modal-footer">
			  <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	
	   <?php 
        foreach($data1->result_array() as $i):
                    $id=$i['id'];
					$kode=$i['kode'];
					$nama=$i['nama'];
					$qty_karton=$i['qty_karton'];
					$qty_perkarton=$i['qty_perkarton'];
					$total=$i['total'];
        ?>
        <div class="modal fade" id="modal_edit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
              <section class="content">
			<div class="row">
			  <div class="col-md-10">
			  <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <form role="form" method="post" action="<?php echo base_url().'pengiriman/edit'?>">
              <div class="box-body">
			
			
			<div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputKode">ID</label>
                <input type="text" class="form-control" id="inputKode" name="kode" value="<?php echo $kode;?>" required>
				<input type="hidden" name="id" maxlength="11" class="form-control" value="<?php echo $id;?>" readonly>
                </div>
                <div class="form-group col-md-6">
                <label for="inputNama">Nama</label>
                <input type="text" class="form-control" id="inputNama" name="nama"  value="<?php echo $nama;?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputQty">Qty Karton</label>
                <input type="text" class="form-control" id="inputQty" name="qty_karton"  value="<?php echo $qty_karton;?>" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputKarton">Qty Per Karton</label>
                <input type="text" class="form-control" id="inputKarton" name="qty_perkarton"  value="<?php echo $qty_perkarton;?>" required>
                </div>
            </div>

                <div class="form-group">
                <label for="inputEmail">Total</label>
                <input type="text" class="form-control" id="inputEmail" name="total"  value="<?php echo $total;?>" required>
                </div>
 
              </div>
              <!-- /.box-body -->
			</div>
			</div>
			</section>
              </div>
              <div class="modal-footer">
			  <button type="submit" class="btn btn-info">Edit</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
          <?php endforeach;?>
    <!-- ============ MODAL EDIT BARANG =============== -->