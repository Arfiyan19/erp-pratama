<html>
	<head>
        <title>Pencarian data dengan lookup modal bootstrap</title>
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
								$kode_id=$i['kode'];
								$nama=$i['name'];
								$kota=$i['kota'];
								$telepon=$i['telepon'];
								$tgl_lahir=date('d/m/Y');
								$jabatan=$i['jabatan'];
								$promoter=$i['promoter'];
								$gudangt=$i['gudang'];
								$alamat=$i['alamat'];
					
						?>
                                    <tr class="pilih" data-kota="<?php echo $kota; ?>" data-nama="<?php echo $nama; ?>" data-alamat="<?php echo $alamat; ?>" data-telepon="<?php echo $telepon; ?>" data-tgl_lahir="<?php echo $tgl_lahir; ?>" data-kodeid="<?php echo $kode_id ?>" data-gudangt="<?php echo $gudangt ?>">
                                        <td><?php echo $kode_id; ?></td>
                                        <td><?php echo $nama; ?></td>
										<td><?php echo $jabatan; ?></td>
										<td><?php echo $promoter; ?></td>
										<td><?php echo $gudangt; ?></td>
                                        <td><?php echo $alamat; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                           
                        </table>  
                    </div>
                </div>
            </div>
        </div>
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
    var t = $("#tkirim").DataTable({searching: false, paging: false, info: false, ordering: false});
	var b = $("#tbarang").DataTable({searching: false, paging: false, info: false, ordering: false});
	var counter = 0;
	var counterb = 0;
	var selektor = 0 ;
	var selektorb = 0;
    var kodebarangdipilih = '';
    var defaultkodeedit = '';
	var pose = 0;

    function drawrowb(){
        b.row.add(
            [ 
            //data-toggle="modal" data-target="#myModal1"			
            '<a href="javascript:void(0);" data-barang-kode-delete="" data-c="'+counterb+'" class="remCF remCF'+counterb+' rows btn btn-danger"><i class="fas fa-trash"></i></a>', 
            '<input type="text" class="form-control kode-input" id="kode'+counterb+'" 		name="kode[]" onclick="get_barang(this.value, '+counterb+')"  required>', 
            '<input type="text" class="form-control" id="namabrg'+counterb+'" 	name="nama[]" required readonly>', 
            '<input type="text" class="form-control" id="gudang'+counterb+'" 	name="gudang_asal[]" required readonly>', 
            '<input type="text" class="form-control" id="gudang1'+counterb+'" 	name="gudang_tujuan[]" required>'
            ]).draw( false );
        //console.log('<input type="text" name="kode[]" id="kode'+counter+'"  class="form-control form-control-sm" data-toggle="modal" data-target="#myModal1"  />');
        counterb ++;
    }
    function drawrowt(){
        t.row.add(
            [ 
            //   '<a href="javascript:void(0);" class="remCF btn btn-danger rows"><i class="fas fa-trash"></i></a>', 
            '<input type="text" class="form-control" id="qty_karton'+counter+'" 			name="qty_karton[]" required onkeyup="sumKarton(' + counter + ')">',
            '<input type="text" class="form-control" id="qty_karton_rsk'+counter+'" 		name="qty_karton_rsk[]" required required onkeyup="sumKartonRusak(' + counter + ')"> ',                  
            '<input type="text" class="form-control" id="qty_perkarton'+counter+'" 		name="qty_perkarton[]" required onkeyup="sumKarton(' + counter + ')"> ',                  
            '<input type="text" class="form-control" id="qty_perkarton_rsk'+counter+'" 	name="qty_perkarton_rsk[]" required required onkeyup="sumKartonRusak(' + counter + ')"> ',                   
            '<input type="text" class="form-control" id="total'+counter+'" 				name="total[]" required onkeyup="sumSubtotal(' + counter + ')">',               
            '<input type="text" class="form-control" id="total_rsk'+counter+'" 			name="total_rsk[]" required>',                 
            '<input type="text" class="form-control" id="qty'+counter+'" 					name="stok[]" readonly >',                 
            '<input type="text" class="form-control" id="qty_rsk'+counter+'" 				name="stok_rsk[]" readonly>',
            '<input type="text" class="form-control" id="harga_jual'+counter+'" 			name="harga_jual[]" onkeyup="sumSubtotal(' + counter + ')" readonly>',
            '<input type="text" class="form-control" id="subtotal'+counter+'" 			name="subtotal[]" readonly>',
            ]).draw( false );
        //console.log('<input type="text" name="kode[]" id="kode'+counter+'"  class="form-control form-control-sm" data-toggle="modal" data-target="#myModal1"  />');
        counter ++;
    }
    
    $(".addCF").click(function(){
        console.log('exip');
        drawrowb();
        drawrowt();
        
    });
    $('#tbarang').on('keydown', ".kode-input", function (evt) {
        evt.preventDefault();
        return false;
    });
    $("#tbarang_wrapper").on('click','.remCF',function(){
        var kodebarang = $(this).attr('data-barang-kode-delete');
        if(kodebarang != ''){
            $("[data-kode='"+kodebarang+"']").attr('data-on', 0);
            $("[data-kode='"+kodebarang+"']").find(".bdg-pin").addClass("d-none");
        }
        var pose = $(this).attr('data-barang-kode-delete');
        if(pose != ''){
            $("[data-posee='"+pose+"']").attr('data-on', 0);
            $("[data-posee='"+pose+"']").find(".bdg-pin").addClass("d-none");
        }
        b.row( b.row($(this).parent().parent()).index() ).remove().draw();
        t.row( b.row($(this).parent().parent()).index() ).remove().draw();
        selektorb -- ;
        selektor -- ;
        sumAllSubtotal();
        console.log('drain selektor' + selektorb);
    });
    $("#tbarang_wrapper").on('click','.remCFE',function(){
        var th = $(this).parent().parent();
        console.log(b.row(th).index());

        var pose = $(this).attr('data-barang-kode-delete');
        if(pose != ''){
            $("[data-posee='"+pose+"']").attr('data-on', 0);
            $("[data-posee='"+pose+"']").find(".bdg-pin").addClass("d-none");
        }
        var kodebarang = $(this).attr('data-barang-kode-delete');
        if(kodebarang != ''){
            $("[data-kode='"+kodebarang+"']").attr('data-on', 0);
            $("[data-kode='"+kodebarang+"']").find(".bdg-pin").addClass("d-none");
        }
        b.row( b.row($(this).parent().parent()).index() ).remove().draw();
        t.row( b.row($(this).parent().parent()).index() ).remove().draw();
        selektorb -- ;
        selektor -- ;
        sumAllSubtotal();
        console.log('drain selektor e');
    });

    
  })
</script>
        <script type="text/javascript">

        function sumKarton(lokasi) {
	
            console.log('pilih barang kunci dan selektor =' + lokasi);

            var qty_karton  	= document.getElementById("qty_karton" + lokasi).value;	
            var qty_perkarton 	= document.getElementById("qty_perkarton" + lokasi).value;	
            var jumlah		 	= document.getElementById("total" + lokasi);	
            
            var total = parseInt(qty_karton) * parseInt(qty_perkarton);
            if (!isNaN(total)) {
                //$("#total'+ lokasi'" ).val(total);
                jumlah.value = total;
            }
            sumSubtotal(lokasi)
        }  

        function sumKartonRusak(lokasi) {
            
            console.log('pilih barang kunci dan selektor =' + lokasi);
            
                    var qty_karton  	= document.getElementById("qty_karton_rsk" + lokasi).value;	
                    var qty_perkarton 	= document.getElementById("qty_perkarton_rsk" + lokasi).value;	
                    var jumlah		 	= document.getElementById("total_rsk" + lokasi);	
                    
                    var total = parseInt(qty_karton) * parseInt(qty_perkarton);
                    if (!isNaN(total)) {
                        //$("#total'+ lokasi'" ).val(total);
                        jumlah.value = total;
                    }
        } 
            
        function sumSubtotale(lokasi) {

            console.log('pilih barang kunci dan selektor =' + lokasi);
            
            var stok  	    = document.getElementById("totale" + lokasi).value;	
            var harga_jual 	= document.getElementById("harga_juale" + lokasi).value;	
            var result 	    = document.getElementById("subtotale" + lokasi);

            var total = parseInt(stok) * parseInt(harga_jual);

            if (!isNaN(total)) {
                
                result.value = parseFloat(total);
                sumAllSubtotal();
            }
        }

        function sumSubtotal(lokasi) {

            console.log('pilih barang kunci dan selektor =' + lokasi);
            
            var stok  	    = document.getElementById("total" + lokasi).value;	
            var harga_jual 	= document.getElementById("harga_jual" + lokasi).value;	
            var result 	    = document.getElementById("subtotal" + lokasi);

            var total = parseInt(stok) * parseInt(harga_jual);

            if (!isNaN(total)) {
                
                result.value = parseFloat(total);
                sumAllSubtotal();
            }
        }

        function sumAllSubtotal() {
            
            console.log('sum all subtotal');

            var subtotal    = $('input[name="subtotal[]"]');
            var pengiriman  = document.getElementById("total_pengiriman");
            var total       = 0;
            
            $(subtotal).each(function () {
                total += parseFloat(this.value)
            });

            if (!isNaN(total)) {
                pengiriman.value = parseFloat(total);
            }
        }
//            jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("kode_id").value = $(this).attr('data-kodeid');
                $('#myModal').modal('hide');
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
				document.getElementById("kode_id").value = $(this).attr('data-kodeid');
                $('#myModal').modal('hide');
                document.getElementById("gudang1").value = $(this).attr('data-gudangt');
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

<!-- <form action="<?= base_url('pengiriman/edit/').$pengiriman['id']; ?>" method="post"> -->
<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

<div class="row mt-3">
        <div class="col" id="alert-space">
        </div>    
    </div>

<div class="row mt-3">
    <div class="col-lg-4">
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="weekending" class="input-group-text">Mitra :</label>
            </div>
            <!-- <input type="hidden" name="kode_id" id="kode_id" class="form-control form-control-sm" /> -->
            <input type="text" name="kode_id" id="kode_id" value="<?= $pengiriman['kode_id'];?>" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="nama" class="input-group-text">Kepada :</label>
            </div>
            <input type="hidden" name="id" value="<?= $pengiriman['id'];?>">
            <input type="text" name="kepada" id="nama" value="<?= $pengiriman['kepada'];?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="alamat"  class="input-group-text">Alamat :</label>
            </div>
            <input type="text" name="alamat"  value="<?= $pengiriman['alamat'];?>" id="alamat" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="namawin2mgr" class="input-group-text">Kota/Kec :</label>
            </div>
            <input type="text" name="kota" id="kota" value="<?= $pengiriman['kota'];?>" class="form-control form-control-sm">
            <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="security" class="input-group-text">No. Telepon :</label>
            </div>
            <input type="text" name="no_telepon" value="<?= $pengiriman['no_telepon'];?>" id="telepon" class="form-control form-control-sm">
            <!-- <input type="text" name="security" id="security" class="form-control form-control-sm"> -->
        </div>
    </div>
    <div class="col-lg-4">
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="taggal" class="input-group-text">Tanggal :</label>
            </div>
            <input type="text" name="tanggal" value="<?= $pengiriman['tanggal'];?>" id="tgl_lahir" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="no_do" class="input-group-text">No. DO :</label>
            </div>
            <input type="text" name="no_do" id="id" value="<?= $pengiriman['no_do'];?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="manager_gudang" class="input-group-text">Manager Gudang :</label>
            </div>
            <input type="text" name="manager_gudang" value="<?= $pengiriman['manager_gudang'];?>" id="manager_gudang" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="no_kontainer" class="input-group-text">No. Kontainer :</label>
            </div>
            <input type="text" name="no_kontainer" id="no_kontainer" value="<?= $pengiriman['no_kontainer'];?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="no_segel" class="input-group-text">No. Segel :</label>
            </div>
            <input type="text" name="no_segel" id="no_segel" value="<?= $pengiriman['no_segel'];?>" class="form-control form-control-sm">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="setupjurnal" class="input-group-text">Set Up Jurnal :</label>
            </div>
            <select class="form-control" id="setupjurnal" name="setupjurnal">
                <?php foreach($setup_jurnal as $k => $v){ ?>
                    <option value="<?= $v['kode_jurnal']?>" <?= $pengiriman['setup_jurnal'] == $v['kode_jurnal'] ? 'selected' : '';?>><?= $v['kode_jurnal']?></option>

                <?php } ?>
            </select>
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="jenis_t" class="input-group-text">Jenis Transaksi</label>
            </div>
            <select class="form-control" id="jenis_t" name="jenis_transaksi">
                <option value="cash" <?php $pengiriman['jenis_transaksi'] == 'cash' ? 'selected' : '';?>>Cash</option>
                <option value="kredit" <?php $pengiriman['jenis_transaksi'] == 'kredit' ? 'selected' : '';?>>Kredit</option>
            </select>
        </div>
        <div class="input-group input-group-sm mt-1">
            <div class="input-group-prepend">
                <label for="tanggaljt" class="input-group-text">Tanggal J/T :</label>
            </div>
            <input type="date" name="tanggaljt" value="<?= $pengiriman['tanggal_jt'];?>" id="tanggaljt" value="<?= date('Y-m-d')?>" min="<?= date('Y-m-d')?>" class="form-control form-control-sm">
        </div>
    </div> 
</div> 

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
    </div>
<br>

<hr>
<a href="javascript:void(0);" class="mb-2 addCF btn btn-success rows"><i class="fas fa-plus"></i> Tambah Barang</a>
    <div class="table-responsive">
        <table id="tbarang" class="table table-bordered" width="100%" cellspacing="0">

            <thead>
                <tr style="text-align:center;">
                    <th>Aksi</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Gudang Asal</th>
                    <th>Gudang Tujuan</th>
                </tr>
            </thead>
            <?php foreach($barang as $k => $v){  ?>
                <tr>
                    <td style="text-align:center;">
                        <a href="javascript:void(0);" data-id="<?= $v['id'] ?>" data-c="<?= $k ?>" data-barang-kode-delete="<?= $v['kode'] ?>" class="remCFE remCFE<?= $v['kode'];?> rows btn btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                    <td style="text-align:center;">
                    <input type="text" class="form-control kodee kode-input" data-id="<?= $v['kode'] ?>" id="kodee<?= $v['kode'] ?>" value="<?= $v['kode'];?>" name="kode[]" required>
                    </td>
                    <td>
                    <input type="text" class="form-control" id="namabrge<?= $v['kode'] ?>" value="<?= $v['nama'];?>" name="nama[]" required readonly>
                    </td>
                    
                    <td>
                    <input type="text" class="form-control" id="gudange<?= $v['kode'] ?>" value="<?= $v['gudang_asal'];?>" name="gudang_asal[]" required readonly>
                    </td>
                    <td style="text-align:center;">
                        <input type="text" class="form-control" id="gudang1e<?= $v['kode'] ?>" value="<?= $v['gudang_tujuan'];?>" name="gudang_tujuan[]" required>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
    
    <div class="table-responsive">
        <table id="tkirim" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr style="text-align:center;">
                    <th>Jumlah Karton</th>
                    <th>Jumlah Karton (Rusak)</th>
                    <th>Isi Karton</th>
                    <th>Isi Karton (Rusak)</th>
                    <th>Total Qty</th>
                    <th>Total Qty (Rusak)</th>
                    <th>Stok</th>
                    <th>Stok (Rusak)</th>
                    <th>Harga Jual</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <?php foreach($barang as $k => $v){ 
                // var_dump($v);
                ?>
                <tr>
                    <td style="text-align:center;">
                        <input type="text" class="form-control" id="qty_kartone<?= $v['kode'] ?>" name="qty_karton[]" value="<?= $v['qty_karton']?>" required>
                    </td>
                    <td style="text-align:center;">
                        <input type="text" class="form-control" id="qty_karton_rske<?= $v['kode'] ?>" name="qty_karton_rsk[]" value="<?= $v['qty_karton_rusak']?>" required>
                    </td>
                    <td style="text-align:center;">
                        <input type="text" class="form-control" id="qty_perkartone<?= $v['kode'] ?>" name="qty_perkarton[]" value="<?= $v['qty_perkarton']?>" required>
                    </td>
                    <td style="text-align:center;">
                        <input type="text" class="form-control" id="qty_perkarton_rske<?= $v['kode'] ?>" name="qty_perkarton_rsk[]" value="<?= $v['qty_perkarton_rusak']?>" required>
                    </td>
                    <td style="text-align:center;">
                            <input type="text" class="form-control" id="totalee<?= $v['kode'] ?>" name="total[]" value="<?= $v['total']?>" onkeyup="sumSubtotale(<?= $k?>)"  required>
                    </td>
                    <td style="text-align:center;">
                            <input type="text" class="form-control" id="total_rske<?= $v['kode'] ?>" name="total_rsk[]" value="<?= $v['total_rusak']?>" required>
                    </td>
                    <td style="text-align:center;">
                            <input type="text" class="form-control" id="qtye<?= $v['kode'] ?>" name="stok[]" value="<?= $v['stok']; ?>" readonly>
                    </td>
                    <td style="text-align:center;">
                            <input type="text" class="form-control" id="qty_rske<?= $v['kode'] ?>" name="stok_rsk[]" value="<?= $v['stok_rusak']; ?>" readonly>
                    </td>
                    <td style="text-align:center;">
                            <input type="text" class="form-control" id="harga_juale<?= $v['kode'] ?>" name="harga_jual[]" value="<?= $v['harga_jual']; ?>" onkeyup="sumSubtotale(<?= $k?>)" readonly>
                    </td>
                    <td style="text-align:center;">
                            <input type="text" class="form-control" id="subtotale<?= $v['kode'] ?>" name="subtotal[]" value="<?= $v['subtotal']; ?>" readonly>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    
	<script type="text/javascript"> 
        function get_barang(kunci, lokasi) {
            $('#myModal1').modal('show');
            selektorb = lokasi;
            kodebarangdipilih = kunci;
            pose = kunci;
            console.log(pose, kodebarangdipilih);
        };
        $('.kodee').on('click', function(){
            $('#myModale1').modal('show');
            defaultkodeedit = $(this).attr('data-id')
            pose = $(this).val();
            kodebarangdipilih = pose;
            console.log(pose, kodebarangdipilih);
        })
</script>
    </div>
    <!-- Footer Pengiriman -->
    <div class="row mt-3">
        <div class="col-lg-4">
            
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label for="weekending" class="input-group-text">Nama Expedisi :</label>
                    </div>
                    <input type="text" name="nama_expedisi"  value="<?= $pengiriman['nama_expedisi']?>" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="taggal" class="input-group-text">Total QTY :</label>
                    </div>
                    <input type="text" name="total_qty" value="<?= $pengiriman['total_qty']?>"  class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="ongkir" class="input-group-text">Ongkir/Kg :</label>
                    </div>
                    <input type="text" id="berat_ongkir" name="berat_ongkir" value="<?= $pengiriman['berat_ongkir']?>"  class="form-control form-control-sm col-lg-2">
                    <div class="input-group-prepend">
                        <label for="ongkir" class="input-group-text">Kg</label>
                    </div>
                    <input type="text" id="ongkir" name="ongkir" value="<?= $pengiriman['ongkir']?>"  class="form-control form-control-sm">    
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="no_do" class="input-group-text">Total Ongkir :</label>
                    </div>
                    <input type="text" name="total_ongkir" value="<?= $pengiriman['total_ongkir']?>"  class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="pembayaran" class="input-group-text">Pembayaran :</label>
                    </div>
                    <select name="pembayaran"  class="form-control">
                        <option value="" value="<?= $pengiriman['pembayaran']  == '' ? 'selected' : ''; ?>" >JNE</option>
                        <option value="" value="<?= $pengiriman['pembayaran']  == '' ? 'selected' : 'JNt'; ?>" >JNt</option>
                        <option value="" value="<?= $pengiriman['pembayaran']  == '' ? 'selected' : 'Si Cepat'; ?>" >Si Cepat</option>
                    </select>
                </div>
                
          
        </div>
        <div class="col-lg-6">
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="jenis_kendaraan" class="input-group-text">Jenis Kendaraan :</label>
                </div>
                <input type="text" name="jenis_kendaraan"  value="<?= $pengiriman['jenis_kendaraan']?>" class="form-control form-control-sm">
                <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="security" class="input-group-text">No. Polisi :</label>
                </div>
                <input type="text" name="no_polisi"  value="<?= $pengiriman['no_polisi']?>" class="form-control form-control-sm">
                <!-- <input type="text" name="security" id="security" class="form-control form-control-sm"> -->
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="driver" class="input-group-text">Nama Driver :</label>
                </div>
                <input type="text" name="driver"  value="<?= $pengiriman['driver']?>" class="form-control form-control-sm">
                <!-- <input type="text" name="security" id="security" class="form-control form-control-sm"> -->
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="total_pengiriman" class="input-group-text">Total Pengiriman :</label>
                </div>
                <input type="text" id="total_pengiriman" readonly name="total_pengiriman" value="<?= $pengiriman['total_pengiriman']?>"  class="form-control form-control-sm">
            </div>
                
                 
           
        </div>
</div>
<br>
  <button type="button" onclick="saveData()" class="btn btn-primary mb-2 mt-2">Edit</button>
 <a href="<?= base_url('pengiriman');?>" class="btn btn-success">Kembali</a>
 <!-- </form> -->

	
		<html>
	<head>
        <title>Pencarian data dengan lookup modal bootstrap</title>
    </head>
<body>


	
        <!-- Modal -->
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel1"></h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table id="lookup1" style="width:750px" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                 <th>Kode</th>
								<th>Nama Barang</th>
								<th>Gudang</th>
                                </tr>
                            </thead>
                                <?php 
							$no = 1;	
                            $kodebaranglist = [];		   
							foreach($barang as $i):
                                $kodebaranglist[] = $i['kode'];
                            endforeach;			   
							foreach($data2->result_array() as $i):
								$kode=$i['kode'];
								$namabrg=$i['nama'];
								$gudang=$i['gudang'];
								$qty=$i['unitbagus'];
								$qtyr=$i['unitrusak'];
                                $harga_jual=floatval($i['setelahpajak']);
						     ?>
                                    <tr class="pilih1" data-on="<?= in_array($kode, $kodebaranglist) ? 1 : 0 ?>" data-harga_jual="<?php echo $harga_jual; ?>" data-kode="<?php echo $kode; ?>" data-nama="<?php echo $namabrg; ?>" data-gudang="<?php echo $gudang; ?>" data-qty="<?php echo $qty; ?>" data-qtyr="<?php echo $qtyr; ?>">
                                        <td><?php echo $kode; ?> <span class="badge badge-success <?= in_array($kode, $kodebaranglist) ? '' : 'd-none' ?> bdg-pin">telah ditambahkan</span></td>
                                        <td><?php echo $namabrg; ?></td>
                                        <td><?php echo $gudang; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                           
                        </table>  
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModale1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel1"></h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table id="lookup1" style="width:750px" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                 <th>Kode</th>
								<th>Nama Barang</th>
								<th>Gudang</th>
                                </tr>
                            </thead>
                                <?php 
							$no = 1;		
                            // $barang
                            $kodebaranglist = [];		   
							foreach($barang as $i):
                                $kodebaranglist[] = $i['kode'];
                            endforeach;
							foreach($data2->result_array() as $i):
								$kode=$i['kode'];
								$namabrg=$i['nama'];
								$gudang=$i['gudang'];
								$qty=$i['unitbagus'];
								$qtyr=$i['unitrusak'];
                                $harga_jual=floatval($i['setelahpajak']);
						     ?>
                                    <tr class="pilih2" data-posee="<?php echo $kode; ?>" data-on="<?= in_array($kode, $kodebaranglist) ? 1 : 0 ?>" data-harga_jual="<?php echo $harga_jual; ?>" data-kode="<?php echo $kode; ?>" data-nama="<?php echo $namabrg; ?>" data-gudang="<?php echo $gudang; ?>" data-qty="<?php echo $qty; ?>" data-qtyr="<?php echo $qtyr; ?>">
                                        <td><?php echo $kode; ?>  <span class="badge badge-success <?= in_array($kode, $kodebaranglist) ? '' : 'd-none' ?> bdg-pin">telah ditambahkan</span></td>
                                        <td><?php echo $namabrg; ?></td>
                                        <td><?php echo $gudang; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                           
                        </table>  
                    </div>
                </div>
		
				
            </div>
        </div>
		<script>
  $(function () {
    $('#lookup1').DataTable()
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
                $(document).on('click', '.pilih1', function (e) {
                    var pin = $(this).attr('data-on');
                    if(pin == 1){
                        alert("barang sudah ada dalam daftar");
                    }
                    else{
                        $(this).attr('data-on', 1);
                        $(this).find(".bdg-pin").removeClass("d-none");
                        if(kodebarangdipilih != ''){
                            $("[data-kode='"+kodebarangdipilih+"']").attr('data-on', 0);
                            $("[data-kode='"+kodebarangdipilih+"']").find(".bdg-pin").addClass("d-none");
                        }
                        var kd = $(this).attr('data-kode');
                        $("[data-posee='"+kd+"']").attr('data-on', 1);
                        $("[data-posee='"+kd+"']").find(".bdg-pin").removeClass("d-none");
                        if(pose != ''){
                            $("[data-posee='"+pose+"']").attr('data-on', 0);
                            $("[data-posee='"+pose+"']").find(".bdg-pin").addClass("d-none");
                        }
                        $('.remCF'+selektorb).attr('data-barang-kode-delete', $(this).attr('data-kode'));

                        document.getElementById("kode"+selektorb).value = $(this).attr('data-kode');
                        $('#myModal1').modal('hide');
                        
                        document.getElementById("namabrg"+selektorb).value = $(this).attr('data-nama');
                        $('#myModal1').modal('hide');
                        
                        document.getElementById("gudang"+selektorb).value = $(this).attr('data-gudang');
                        $('#myModal1').modal('hide');
                        
                        document.getElementById("qty"+selektorb).value = $(this).attr('data-qty');
                        $('#myModal1').modal('hide');
                        
                        document.getElementById("qty_rsk"+selektorb).value = $(this).attr('data-qtyr');
                        $('#myModal1').modal('hide');

                        document.getElementById("harga_jual"+selektorb).value = $(this).attr('data-harga_jual');
                        $('#myModal1').modal('hide');
                    
                }
            });
            $(document).on('click', '.pilih2', function (e) {
                var pin = $(this).attr('data-on');
                if(pin == 1){
                    alert("barang sudah ada dalam daftar");
                }
                else{
                    $(this).attr('data-on', 1);
                    $(this).find(".bdg-pin").removeClass("d-none");
                    if(pose != ''){
                        $("[data-posee='"+pose+"']").attr('data-on', 0);
                        $("[data-posee='"+pose+"']").find(".bdg-pin").addClass("d-none");
                    }
                    var kd = $(this).attr('data-kode');
                    
                    $("[data-kode='"+kd+"']").attr('data-on', 1);
                    $("[data-kode='"+kd+"']").find(".bdg-pin").removeClass("d-none");
                    if(kodebarangdipilih != ''){
                        console.log(kodebarangdipilih);
                        $("[data-kode='"+kodebarangdipilih+"']").attr('data-on', 0);
                        $("[data-kode='"+kodebarangdipilih+"']").find(".bdg-pin").addClass("d-none");
                        // console.log($("[data-kode='"+kodebarangdipilih+"']"));
                    }

                    $('.remCFE'+defaultkodeedit).attr('data-barang-kode-delete', $(this).attr('data-kode'));
                    // console.log(document.getElementById("kodee"+pose));
                    document.getElementById("kodee"+defaultkodeedit).value = $(this).attr('data-kode');
                    $('#myModale1').modal('hide');
                    
                    document.getElementById("namabrge"+defaultkodeedit).value = $(this).attr('data-nama');
                    $('#myModale1').modal('hide');
                    
                    document.getElementById("gudange"+defaultkodeedit).value = $(this).attr('data-gudang');
                    $('#myModale1').modal('hide');
                    
                    document.getElementById("qtye"+defaultkodeedit).value = $(this).attr('data-qty');
                    $('#myModale1').modal('hide');
                    
                    document.getElementById("qty_rske"+defaultkodeedit).value = $(this).attr('data-qtyr');
                    $('#myModale1').modal('hide');
                    
                    document.getElementById("harga_juale"+defaultkodeedit).value = $(this).attr('data-harga_jual');
                    $('#myModale1').modal('hide');
                }
            });
			

//            tabel lookup mahasiswa
            $(function () {
                $("#lookup").dataTable();
            });

            function dummy() {
                var kode = document.getElementById("kode").value;
                alert('Kode ' + kode + ' berhasil tersimpan');
				
				var namabrg = document.getElementById("namabrg").value;
                alert('Nama ' + namabrg + ' berhasil tersimpan');
				
				var gudang = document.getElementById("gudang").value;
                alert('Gudang ' + gudang + ' berhasil tersimpan');
				
				var gudang1 = document.getElementById("gudang1").value;
                alert('Gudang ' + gudang1 + ' berhasil tersimpan');
				
				var qty = document.getElementById("qty").value;
                alert('QTY ' + qty + ' berhasil tersimpan');
			
			
		
				
            }

    function saveData() {
        let databarang = [];
        
        $("input[name='nama[]']").each(function (i, val) {
            databarang.push({
                kode: $("input[name='kode[]']").eq(i).val(),
                nama: $("input[name='nama[]']").eq(i).val(),
                gudang_asal: $("input[name='gudang_asal[]']").eq(i).val(),
                gudang_tujuan: $("input[name='gudang_tujuan[]']").eq(i).val(),
                qty_karton: $("input[name='qty_karton[]']").eq(i).val(),
                qty_karton_rsk: $("input[name='qty_karton_rsk[]']").eq(i).val(),
                qty_perkarton: $("input[name='qty_perkarton[]']").eq(i).val(),
                qty_perkarton_rsk: $("input[name='qty_perkarton_rsk[]']").eq(i).val(),
                harga_jual: $("input[name='harga_jual[]']").eq(i).val(),
                subtotal: $("input[name='subtotal[]']").eq(i).val(),
                total: $("input[name='total[]']").eq(i).val(),
                total_rsk: $("input[name='total_rsk[]']").eq(i).val(),
                stok: $("input[name='stok[]']").eq(i).val(),
                stok_rsk: $("input[name='stok_rsk[]']").eq(i).val(),
            });
        });

        let data = {
            kode_id: $('input[name=kode_id]').val(),
            setupjurnal: $('select[name=setupjurnal]').val(),
            jenis_transaksi: $('select[name=jenis_transaksi]').val(),
            tanggaljt: $('input[name=tanggaljt]').val(),
            kepada: $('input[name=kepada]').val(),
            alamat: $('input[name=alamat]').val(),
            kota: $('input[name=kota]').val(),
            no_telepon: $('input[name=no_telepon]').val(),
            tanggal: $('input[name=tanggal]').val(),
            no_do: $('input[name=no_do]').val(),
            manager_gudang: $('input[name=manager_gudang]').val(),
            no_kontainer: $('input[name=no_kontainer]').val(),
            no_segel: $('input[name=no_segel]').val(), //$("input[name='total_harga[[]']"]").val("");    
            nama_expedisi: $('input[name=nama_expedisi]').val(),
            berat_ongkir: $('input[name=berat_ongkir]').val(),
            ongkir: $('input[name=ongkir]').val(),
            jenis_kendaraan: $('input[name=jenis_kendaraan]').val(),
            no_polisi: $('input[name=no_polisi]').val(),
            driver: $('input[name=driver]').val(),
            total_qty: $('input[name=total_qty]').val(),
            total_ongkir: $('input[name=total_ongkir]').val(),
            pembayaran: $('select[name=pembayaran]').val(),
            total_pengiriman: $('input[name=total_pengiriman]').val(),
            barang : databarang
        };
        console.log(data);
        let alert_success = '<div class="alert alert-success alert-dismissible fade show alert-success" role="alert">Data Pengiriman <strong>berhasil</strong> ditambahkan!<button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        $.ajax({
            type: "POST",
            url: '<?= base_url('pengiriman/update/'.$pengiriman['id']); ?>',
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result['errors']) {
                    let alert_danger = '<div class="alert alert-danger alert-dismissible fade show alert-success" role="alert">' + result['errors']   + '</div>';

                    $('#alert-space').html(alert_danger);
                } else {
                    location.reload();
                    getLatestNoDO();
                    $('#alert-space').html(alert_success);
                    setTimeout(() => $('.alert-success').alert('close'), 5000);
                }
            }
        });
    }      
    </script>


</body>
</html>