<div class="container">    
    <div class="row my-3">
        <div class="col">
            <a href="<?= base_url('pengiriman2'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col" id="alert-space">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="weekending" class="input-group-text">Kepada :</label>
                </div>
                <input type="hidden" name="kode_id" id="kode_id" />
                <input type="text" name="kepada" id="nama" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
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
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="security" class="input-group-text">No. Telepon :</label>
                </div>
                <input type="text" name="no_telepon" id="telepon" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="taggal" class="input-group-text">Tanggal :</label>
                </div>
                <input type="text" name="tanggal" id="tgl_lahir" class="form-control form-control-sm">
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
    </div>

    <table class="table table-bordered mt-2" width="100%" cellspacing="0">
        <thead>
            <tr style="text-align:center;">
                <th>Kode</th>
                <th>Nama Barang</th>
				<th>Gudang Asal</th>
                <th>Gudang Tujuan</th>
            </tr>
        </thead>
		<tbody>      
            <tr>
                <td style="text-align:center;">
                    <input type="text" class="form-control" id="kode" name="kode" data-toggle="modal" data-target="#myModal1" required>
                </td>
                <td>
                    <input type="text" class="form-control" id="namabrg" name="nama" required>
                </td>
                <td>
                    <input type="text" class="form-control" id="gudang" name="gudang_asal" value="<?= $this->session->userdata('gudang'); ?>" readonly>
                </td>
                <td style="text-align:center;">
                    <input type="text" class="form-control" id="gudang1" name="gudang_tujuan" value="Head Office" readonly>
                </td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-bordered" width="100%" cellspacing="0">
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
            </tr>
        </thead>
		<tbody>      
            <tr>
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
            </tr>
        </tbody>
    </table>
    
    <!-- Footer Pengiriman -->
    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="weekending" class="input-group-text">Nama Expedisi :</label>
                </div>
                <input type="text" name="nama_expedisi"  class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="taggal" class="input-group-text">Total QTY :</label>
                </div>
                <input type="text" name="total_qty"   class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="ongkir" class="input-group-text">Ongkir/Kg :</label>
                </div>
                <input type="text" name="berat_ongkir"  class="form-control form-control-sm col-lg-2">
				<div class="input-group-prepend">
                    <label for="ongkir" class="input-group-text">Kg</label>
                </div>
				<input type="text" name="ongkir"  class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                        <label for="no_do" class="input-group-text">Total Ongkir :</label>
                </div>
                <input type="text" name="total_ongkir"  class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="pembayaran" class="input-group-text">Pembayaran :</label>
                </div>
                <select name="pembayaran"  class="form-control">
                    <option value="">JNE</option>
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
                <input type="text" name="jenis_kendaraan"  class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="security" class="input-group-text">No. Polisi :</label>
                </div>
                <input type="text" name="no_polisi"  class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="driver" class="input-group-text">Nama Driver :</label>
                </div>
                <input type="text" name="driver"  class="form-control form-control-sm">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary my-3" onclick="saveData()">Proses</button>
	
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
                                $gudang=$i['gudang'];
                                $alamat=$i['alamat'];
                            ?>
                            <tr class="pilih" data-kota="<?php echo $kota; ?>" data-nama="<?php echo $nama; ?>" data-alamat="<?php echo $alamat; ?>" data-telepon="<?php echo $telepon; ?>" data-tgl_lahir="<?php echo $tgl_lahir; ?>" data-kodeid="<?php echo $kode_id ?>">
                                <td><?php echo $kode_id; ?></td>
                                <td><?php echo $nama; ?></td>
                                <td><?php echo $jabatan; ?></td>
                                <td><?php echo $promoter; ?></td>
                                <td><?php echo $gudang; ?></td>
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
                           </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;				   
                            foreach($data2->result_array() as $i):
                                $kode=$i['kode'];
                                $namabrg=$i['nama'];
                                $qty=$i['unitbagus'];
                                $qtyr=$i['unitrusak'];
                            ?>
                            <tr class="pilih1" data-kode="<?php echo $kode; ?>" data-nama="<?php echo $namabrg; ?>" data-qty="<?php echo $qty; ?>" data-qtyr="<?php echo $qtyr; ?>">
                                <td><?php echo $kode; ?></td>
                                <td><?php echo $namabrg; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url().'js/jquery-1.11.2.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'bootstrap/js/bootstrap.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'datatables/jquery.dataTables.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'datatables/dataTables.bootstrap.js'?>" type="text/javascript"></script>

<script>
    getLatestNoDO();
    $(document).ready(function () {
        $("#lookup").dataTable();
        $('#lookup1').DataTable();

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
            document.getElementById("kode_id").value = $(this).attr('data-kodeid');
            $('#myModal').modal('hide');
        });

        $(document).on('click', '.pilih1', function (e) {
            document.getElementById("kode").value = $(this).attr('data-kode');
            $('#myModal1').modal('hide');

            document.getElementById("namabrg").value = $(this).attr('data-nama');
            $('#myModal1').modal('hide');

            document.getElementById("qty").value = $(this).attr('data-qty');
            $('#myModal1').modal('hide');

            document.getElementById("qty_rsk").value = $(this).attr('data-qtyr');
            $('#myModal1').modal('hide');
        });

        $("#qty_karton, #qty_perkarton").keyup(function() {
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

    function getLatestNoDO() {
        $.get({
            url: '<?= base_url('pengiriman/getLatestNoDO'); ?>',
            dataType: 'json',
            success: function(result) {
                $('input[name=no_do]').val(result);
            }
        });
    }

    function saveData() {
        const data = {
            kode_id: $('input[name=kode_id').val(),
            kepada: $('input[name=kepada').val(),
            alamat: $('input[name=alamat').val(),
            kota: $('input[name=kota').val(),
            no_telepon: $('input[name=no_telepon').val(),
            tanggal: $('input[name=tanggal').val(),
            no_do: $('input[name=no_do').val(),
            manager_gudang: $('input[name=manager_gudang').val(),
            no_kontainer: $('input[name=no_kontainer').val(),
            no_segel: $('input[name=no_segel').val(),
            kode: $('input[name=kode').val(),
            nama: $('input[name=nama').val(),
            gudang_asal: $('input[name=gudang_asal').val(),
            gudang_tujuan: $('input[name=gudang_tujuan').val(),
            qty_karton: $('input[name=qty_karton').val(),
            qty_karton_rsk: $('input[name=qty_karton_rsk').val(),
            qty_perkarton: $('input[name=qty_perkarton').val(),
            qty_perkarton_rsk: $('input[name=qty_perkarton_rsk').val(),
            total: $('input[name=total').val(),
            total_rsk: $('input[name=total_rsk').val(),
            stok: $('input[name=stok').val(),
            stok_rsk: $('input[name=stok_rsk').val(),
            nama_expedisi: $('input[name=nama_expedisi').val(),
            total_qty: $('input[name=total_qty').val(),
            berat_ongkir: $('input[name=berat_ongkir').val(),
            ongkir: $('input[name=ongkir').val(),
            total_ongkir: $('input[name=total_ongkir').val(),
            pembayaran: $('select[name=pembayaran').val(),
            jenis_kendaraan: $('input[name=jenis_kendaraan').val(),
            no_polisi: $('input[name=no_polisi').val(),
            driver: $('input[name=driver').val()
        };

        let alert_success = `
        <div class="alert alert-success alert-dismissible fade show alert-success" role="alert">Data Pengiriman <strong>berhasil</strong> ditambahkan!
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>`;

        $.ajax({
            type: "POST",
            url: '<?= base_url('pengiriman2/tambahDataPengiriman'); ?>',
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result['errors']) {
                    let alert_danger = `
                    <div class="alert alert-danger alert-dismissible fade show alert-success" role="alert">
                        ${result['errors']}
                    </div>`;

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
                    $('input[name=kode]').val('');
                    $('input[name=nama]').val('');
                    $('input[name=qty_karton]').val('');
                    $('input[name=qty_karton_rsk]').val('');
                    $('input[name=qty_perkarton]').val('');
                    $('input[name=qty_perkarton_rsk]').val('');
                    $('input[name=total]').val('');
                    $('input[name=total_rsk]').val('');
                    $('input[name=stok]').val('');
                    $('input[name=stok_rsk]').val('');
                    $('input[name=nama_expedisi]').val('');
                    $('input[name=berat_ongkir]').val('');
                    $('input[name=ongkir]').val('');
                    $('input[name=jenis_kendaraan]').val('');
                    $('input[name=no_polisi]').val('');
                    $('input[name=driver]').val('');
                    $('input[name=total_qty]').val('');
                    $('input[name=total_ongkir]').val('');
                    $('select[name=pembayaran]').val('');
                    getLatestNoDO();
                    $('#alert-space').html(alert_success);
                    setTimeout(() => $('.alert-success').alert('close'), 5000);
                }
            }
        });
    }
</script>
