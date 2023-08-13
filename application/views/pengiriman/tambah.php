<script>
console.log('start');
</script>
<div class="container">
    <?php if($this->session->flashdata('flash2')) :?>
    <div class="row mt-3">
        <div class="col md-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Pengiriman <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
            <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>    
    </div>
    <?php endif;?>

    <div class="row mt-2">
        <div class="col">
            <a href="<?= base_url('pengiriman'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col" id="alert-space">
        </div>    
    </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="weekending" class="input-group-text">Mitra :</label>
                    </div>
                    <!-- <input type="hidden" name="kode_id" id="kode_id" class="form-control form-control-sm" /> -->
                    <input type="text" name="kode_id" id="kode_id" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="nama" class="input-group-text">Kepada :</label>
                    </div>
                    <input type="text" name="kepada" id="nama" class="form-control form-control-sm" required>
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="alamat"  class="input-group-text">Alamat :</label>
                    </div>
                    <input type="text" name="alamat" id="alamat" class="form-control form-control-sm" required>
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="namawin2mgr" class="input-group-text">Kota/Kec :</label>
                    </div>
                    <input type="text" name="kota" id="kota" class="form-control form-control-sm" required>
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="security" class="input-group-text">No. Telepon :</label>
                    </div>
                    <input type="text" name="no_telepon" id="telepon" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="taggal" class="input-group-text">Tanggal :</label>
                    </div>
                    <input type="date" name="tanggal" value="<?= date('Y-m-d')?>" id="tgl_lahir" class="form-control form-control-sm" required>
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="no_do" class="input-group-text">No. DO :</label>
                    </div>
                    <input type="text" name="no_do" id="no_do" class="form-control form-control-sm" readonly required />
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="manager_gudang" class="input-group-text">Manager Gudang :</label>
                    </div>
                    <input type="text" name="manager_gudang" id="manager_gudang" required class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="no_kontainer" class="input-group-text">No. Kontainer :</label>
                    </div>
                    <input type="text" name="no_kontainer" required id="no_kontainer" class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="no_segel" class="input-group-text">No. Segel :</label>
                    </div>
                    <input type="text" name="no_segel" required id="no_segel" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="setupjurnal" class="input-group-text">Set Up Jurnal :</label>
                    </div>
                    <select class="form-control" id="setupjurnal" required name="setupjurnal">
                        <?php foreach($setup_jurnal as $k => $v){ ?>
                            <option selected value="<?= $v['kode_jurnal']?>" ><?= $v['kode_jurnal']?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="jenis_t" class="input-group-text">Jenis Transaksi</label>
                    </div>
                    <select class="form-control" id="jenis_t" required name="jenis_transaksi">
                        <option value="cash" selected >Cash</option>
                        <option value="kredit" >Kredit</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="tanggaljt" class="input-group-text">Tanggal J/T :</label>
                    </div>
                    <input type="date" name="tanggaljt" required  id="tanggaljt" value="<?= date('Y-m-d')?>" min="<?= date('Y-m-d')?>" class="form-control form-control-sm">
                </div>
            </div> 
        </div>
        <hr>
        <a href="javascript:void(0);" class="mb-2 addCF btn btn-success rows"><i class="fas fa-plus"></i> Tambah Barang</a>
		<div class="table-responsive">
            <table id="tbarang" class="table table-bordered my-2" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align:center;">
                        <th>Aksi</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Gudang Asal</th>
                        <th>Gudang Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <!--tr>
                        <td style="text-align:center;">
                        <input type="text" class="form-control" id="kode" name="kode" data-toggle="modal" data-target="#myModal1" required>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="namabrg" name="nama" required>
                        </td>
                        
                        <td>
                        <input type="text" class="form-control" id="gudang" name="gudang_asal" required>
                        </td>
                        <td style="text-align:center;">
                            <input type="text" class="form-control" id="gudang1" name="gudang_tujuan" required>
                        </td>
                    </tr-->
                </tbody>
            </table>
        </div>
        <!-- <hr>
        <a href="javascript:void(0);" class="mb-2 addCF btn btn-success btn-sm rows"><i class="fas fa-plus"></i> Kemasan</a> -->
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
                <tbody>
                    <!--tr>
                        <td style="text-align:center;">
                            <input type="text" class="form-control" id="qty_karton" name="qty_karton" required>
                        </td>
                        <td style="text-align:center;">
                            <input type="text" class="form-control" id="qty_karton_rsk" name="qty_karton_rsk" required>
                        </td>
                        <td style="text-align:center;">
                        <input type="text" class="form-control" id="qty_perkarton" name="qty_perkarton" required>
                        </td>
                        <td style="text-align:center;">
                        <input type="text" class="form-control" id="qty_perkarton_rsk" name="qty_perkarton_rsk" required>
                        </td>
                        <td style="text-align:center;">
                            <input type="text" class="form-control" id="total" name="total" required>
                        </td>
                        <td style="text-align:center;">
                            <input type="text" class="form-control" id="total_rsk" name="total_rsk" required>
                        </td>
                        <td style="text-align:center;">
                            <input type="text" class="form-control" id="qty" name="stok" readonly>
                        </td>
                        <td style="text-align:center;">
                            <input type="text" class="form-control" id="qty_rsk" name="stok_rsk" readonly>
                        </td>
                    </tr-->
                </tbody>
            </table>
        </div>   
        <hr> 
    
        <!-- Footer Pengiriman -->
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label for="weekending" class="input-group-text">Nama Expedisi :</label>
                    </div>
                    <input required type="text" id="nama_expedisi" name="nama_expedisi"  class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="taggal" class="input-group-text">Total QTY :</label>
                    </div>
                    <input type="text" id="total_qty" name="total_qty" required class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="ongkir" class="input-group-text">Ongkir/Kg :</label>
                    </div>
                    <input type="text" id="berat_ongkir" name="berat_ongkir"  required class="form-control form-control-sm col-lg-2">
                    <div class="input-group-prepend">
                        <label for="ongkir" class="input-group-text">Kg</label>
                    </div>
                    <input type="text" id="ongkir" name="ongkir"  required class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="total_ongkir" class="input-group-text">Total Ongkir :</label>
                    </div>
                    <input type="text" id="total_ongkir" required name="total_ongkir"  class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="pembayaran" class="input-group-text">Pembayaran :</label>
                    </div>
                    <select id="pembayaran" name="pembayaran" required class="form-control">
                        <option selected value="">JNE</option>
                        <option value="">JNt</option>
                        <option value="">Si Cepat</option>
                    </select>
                </div> 
            </div>
            <div class="col-lg-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label for="jenis_kendaraan" class="input-group-text">Jenis Kendaraan :</label>
                    </div>
                    <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" required class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="security" class="input-group-text">No. Polisi :</label>
                    </div>
                    <input type="text" id="no_polisi" name="no_polisi"  required class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="driver" class="input-group-text">Nama Driver :</label>
                    </div>
                    <input type="text" id="driver" name="driver" required class="form-control form-control-sm">
                </div>
                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="total_pengiriman" class="input-group-text">Total Pengiriman :</label>
                    </div>
                    <input type="text" id="total_pengiriman" required  readonly name="total_pengiriman"  class="form-control form-control-sm">
                </div>

            </div>
        </div>
		<button type="button" class="btn btn-primary my-3" onclick="saveData()">Proses</button>

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
                        <tbody>
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
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>

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
                        <tbody>
                            <?php 
        					$no = 1;				   
        					foreach($data2->result_array() as $i):
        						$kode=$i['kode'];
        						$namabrg=$i['nama'];
        						$gudang=$i['gudang'];
        						$qty=$i['unitbagus'];
        						$qtyr=$i['unitrusak'];
        						$harga_jual=floatval($i['setelahpajak']);
        				    ?>
                            
                            <tr class="pilih1" data-on="0" data-harga_jual="<?= $harga_jual?>" data-kode="<?php echo $kode; ?>" data-nama="<?php echo $namabrg; ?>" data-gudang="<?php echo $gudang; ?>" data-qty="<?php echo $qty; ?>" data-qtyr="<?php echo $qtyr; ?>">
                                <td><?php echo $kode; ?> <span class="badge badge-success d-none bdg-pin">telah ditambahkan</span></td>
                                <td><?php echo $namabrg; ?></td>
                                <td><?php echo $gudang; ?></td>
                            </tr>
                            <?php endforeach; ?>        
                        </tbody>
                    </table>  
                </div>
            </div>	
        </div>
    </div>
</div>

<!--script src="<?php echo base_url('asset/jquery.min.js');?>"></script>
<script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.js'?>"></script-->
   
<script>
    var t = $("#tkirim").DataTable({searching: false, paging: false, info: false});
	var b = $("#tbarang").DataTable({searching: false, paging: false, info: false});
	var counter = 0 ;
	var selektor = 0 ;
	var counterb = 0 ;
	var selektorb = 0;
	var kodebarangdipilih = '';
    getLatestNoDO();
	console.log('start');
	var erpus;
    $(document).ready(function() {

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

        $(document).on('click', '.pilih1', function (e) {
			// console.log($(this).attr('data-kode'));
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
                $('.remCF'+selektorb).attr('data-barang-kode-delete', $(this).attr('data-kode'));

                harga = document.getElementById("harga");	
                //  + selektorb console.log("harga" + selektorb + '=' = harga.value);
                document.getElementById("kode" + selektorb).value = $(this).attr('data-kode'); 
                
                $('#myModal1').modal('hide');
                
                document.getElementById("namabrg" + selektorb).value = $(this).attr('data-nama');
                $('#myModal1').modal('hide');
                
                document.getElementById("gudang" + selektorb).value = $(this).attr('data-gudang');
                $('#myModal1').modal('hide');
                
                document.getElementById("qty" + selektorb).value = $(this).attr('data-qty');
                $('#myModal1').modal('hide');
                
                document.getElementById("qty_rsk" + selektorb).value = $(this).attr('data-qtyr');
                $('#myModal1').modal('hide');
                
                document.getElementById("harga_jual" + selektorb).value = $(this).attr('data-harga_jual');
                $('#myModal1').modal('hide');

            }
        });

        $("#qty_karton2, #qty_perkarton2").keyup(function() {
            var qty_karton  = $("#qty_karton").val();
            var qty_perkarton = $("#qty_perkarton").val();
            
			
			 var total = parseInt(qty_karton) * parseInt(qty_perkarton);
             if (!isNaN(total)) {
             $("#total").val(total);
             }
        });

        $("#qty_karton_rsk, #qty_perkarton_rsk").keyup(function() {
            var qty_karton_rsk  = $("#qty_karton_rsk").val();
            var qty_perkarton_rsk = $("#qty_perkarton_rsk").val();
            
			
			 var total_rsk = parseInt(qty_karton_rsk) * parseInt(qty_perkarton_rsk);
             if (!isNaN(total_rsk)) {
             $("#total_rsk").val(total_rsk);
             }
        });

    });
	console.log('selektor to do' + selektor);
    function getLatestNoDO() {
        $.get({
            url: '<?= base_url('pengiriman/getLatestNoDO'); ?>',
            dataType: 'json',
            success: function(result) {
                $('input[name=no_do]').val(result);
            }
        });
    }

    function drawrowb(){
        b.row.add(
			[ 
			//data-toggle="modal" data-target="#myModal1"			
			'<a href="javascript:void(0);"  data-barang-kode-delete="" data-c="'+counterb+'" class="remCF remCF'+counterb+' rows btn btn-danger"><i class="fas fa-trash"></i></a>', 
			'<input type="text" class="form-control kode-input" id="kode'+counterb+'" 		name="kode[]" onclick="get_barang(this.value,' + counterb + ')"  required>', 
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
              '<input type="text" class="form-control" id="qty'+counter+'" 					name="stok[]" readonly required >',                 
              '<input type="text" class="form-control" id="qty_rsk'+counter+'" 				name="stok_rsk[]" readonly required>',
              '<input type="text" class="form-control" id="harga_jual'+counter+'" 			name="harga_jual[]" onkeyup="sumSubtotal(' + counter + ')" readonly required>',
              '<input type="text" class="form-control" id="subtotal'+counter+'" 			name="subtotal[]" readonly required>',
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
        b.row( ':eq('+$(this).attr('data-c')+')' ).remove().draw();
        t.row( ':eq('+$(this).attr('data-c')+')' ).remove().draw();
        selektorb -- ;
        selektor -- ;
        sumAllSubtotal();
        console.log('drain selektor' + selektorb);
    });
    // $("#tkirim").on('click','.remCF',function(){
    //     $(this).parent().parent().remove();
    //     t.row(':last').remove().draw();
    //     selektor -- ;
    // });
  
  //  data-toggle="modal" data-target="#myModal1" 
  console.log('selektor add 1 row' + selektor);

</script>
<script>
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
            url: '<?= base_url('pengiriman/tambahDataPengiriman'); ?>',
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result['errors']) {
                    let alert_danger = '<div class="alert alert-danger alert-dismissible fade show alert-success" role="alert">' + result['errors']   + '</div>';

                    $('#alert-space').html(alert_danger);
                } else {
                    $('input[name=kode_id]').val('');
                    $('input[name=kepada]').val('');
                    $('input[name=alamat]').val('');
                    $('input[name=kota]').val('');
                    $('input[name=no_telepon]').val('');
                    $('input[name=tanggal]').val('');
                    $('input[name=manager_gudang]').val('');
                    $('input[name=no_kontainer]').val('');
                    $('input[name=no_segel]').val(''); 
                    $("input[name='kode[]']").val('');
                    $("input[name='nama[]']").val('');
                    $("input[name='gudang_asal[]']").val('');
                    $("input[name='gudang_tujuan[]']").val('');
                    $("input[name='qty_karton[]']").val('');
                    $("input[name='qty_karton_rsk[]']").val(''); 
                    $("input[name='qty_perkarton[]']").val('');
                    $("input[name='qty_perkarton_rsk[]']").val('');
                    $("input[name='total[]']").val('');
                    $("input[name='total_rsk[]']").val('');     
                    $("input[name='stok[]']").val('');
                    $("input[name='stok_rsk[]']").val('');
                    $('input[name=nama_expedisi]').val('');
                    $('input[name=berat_ongkir]').val('');
                    $('input[name=ongkir]').val('');
                    $('input[name=jenis_kendaraan]').val('');
                    $('input[name=no_polisi]').val('');
                    $('input[name=driver]').val('');
                    $('input[name=total_qty]').val('');
                    $('input[name=total_ongkir]').val('');
                    $('select[name=pembayaran]').val('');
                    $('input[name=total_pengiriman]').val('');
                    getLatestNoDO();
                    $('#alert-space').html(alert_success);
                    setTimeout(() => $('.alert-success').alert('close'), 5000);
                }
            }
        });
    }  
	// $(".addBARANG").click(function(){
	//   console.log('exip barang');
	//     b.row.add(
	// 		[ <!--a href="javascript:void(0);" class="remCF rows"><i class="fas fa-trash"></i></a--> 
	// 		//data-toggle="modal" data-target="#myModal1"			
	// 		'<a href="javascript:void(0);" class="remCF rows btn btn-danger"><i class="fas fa-trash"></i></a>', 
	// 		'<input type="text" class="form-control" id="kode'+counterb+'" 		name="kode[]" onclick="get_barang(this.value,' + counterb + ')"  required>', 
	// 		'<input type="text" class="form-control" id="namabrg'+counterb+'" 	name="nama[]" required>', 
	// 		'<input type="text" class="form-control" id="gudang'+counterb+'" 	name="gudang_asal[]" required>', 
	// 		'<input type="text" class="form-control" id="gudang1'+counterb+'" 	name="gudang_tujuan[]" required>'
	// 		]).draw( false );
	// 	//console.log('<input type="text" name="kode[]" id="kode'+counter+'"  class="form-control form-control-sm" data-toggle="modal" data-target="#myModal1"  />');
	// 	counterb ++;
	// });
    // $('#tbarang_wrapper').dataTable({searching: false, paging: false, info: false});
    // $("#tbarang_wrapper").on('click','.remCF',function(){
    //     // console.log('awdasd');
    //     $(this).parent().parent().remove();
    //     b.row(':last').remove().draw();
    //     selektorb -- ;
    //     console.log('drain selektor' + selektorb);
    // });
  
   $('.addCF').click();
   $('.addBARANG').click();
   
   function barangtambah(lokasi) {
				harga = document.getElementById("harga");	
			//  + selektorb console.log("harga" + selektorb + '=' = harga.value);
            document.getElementById("kode" + lokasi).value = $(this).attr('data-kode'); 
			
            $('#myModal1').modal('hide');
    		
    		document.getElementById("namabrg" + lokasi).value = $(this).attr('data-nama');
            $('#myModal1').modal('hide');
    		
    		document.getElementById("gudang" + lokasi).value = $(this).attr('data-gudang');
            $('#myModal1').modal('hide');
    		
    		document.getElementById("qty" + lokasi).value = $(this).attr('data-qty');
            $('#myModal1').modal('hide');
            
            document.getElementById("qty_rsk" + lokasi).value = $(this).attr('data-qtyr');
            $('#myModal1').modal('hide');
    };
	
	function get_barang(kunci, lokasi) {
		$('#myModal1').modal('show');
		selektorb = lokasi;
        kodebarangdipilih = kunci;
	};
</script>



