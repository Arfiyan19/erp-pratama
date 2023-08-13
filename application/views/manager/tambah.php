

<style>
    .container-bottom {
        padding-top: 2px;
        transform: translateY(585px);
        transition: 0.3s ease;
    }

    .expand {
        transform: translateY(0px);
    }
</style>

<div class="container-fluid">
    <?php if($this->session->flashdata('flash2')) :?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Karyawan <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>    
    </div>
<?php endif;?>

<?php if($this->session->flashdata('flash')) :?>
    <div class="row mt-3">
        <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert"><?= $this->session->flashdata('flash');?>
            <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>

<h5 class="text-bold">Manager P & L</h5>

<div class="row mt-3 mb-2">
    <div class="col-lg-6">
        <form action="" method="post">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="weekending" class="input-group-text">Weekending :</label>
                </div>
                <input type="text" name="weekending" id="weekending" class="form-control form-control-sm datepicker" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y'); ?>" style="cursor: pointer;">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="noinv" class="input-group-text">No. Inv :</label>
                </div>
                <input type="text" name="noinv" readonly value="<?= $no_invoice ?>" id="noinv" class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="noinv" class="input-group-text">Mitra :</label>
                </div>
                <select class="form-control" name="kode_mitra">
                  <?php foreach($mitra as $k => $v){ ?>
                    <option value="<?= $v['kode']?>"><?= $v['kode'].' - '.$v['name'] ?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="pilmanager" class="input-group-text">Nama Manager :</label>
                </div>
                <input type="text" name="nm_manager" id="nm_manager" class="form-control form-control-sm">
                <input type="text" name="id_manager" id="id_manager" class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="security" class="input-group-text">Akun Security :</label>
                </div>
                <input type="text" name="akun_security" id="akun_security" class="form-control form-control-sm">
                <input type="text" name="id_security" id="id_security" class="form-control form-control-sm">
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <form action="" method="post">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="jabatan" class="input-group-text">Jabatan :</label>
                </div>

                <select class="form-control" name="jabatan" id="jabatan">
                 <option value="">-- Pilih --</option>
                 <?php foreach ($jabatan as $j) :?>
                    <option name="jabatan"><?= $j['name'];?></option>
                <?php endforeach;?>
                </select>
                    <!-- <option value="">Pilih jabatan</option>
                    <option value="Divisional Manager">Divisional Manager</option>
                    <option value="Branch Manager">Branch Manager</option>
                    <option value="Tenant Manager">Tenant Manager</option> -->
                    <!-- <option value=""></option> -->
                <!-- </select> -->
            </div>
            <!-- <div class="d-flex mt-1"> -->
                <div class="input-group input-group-sm mt-1">
                  <div class="input-group-prepend">
                    <label for="manager" class="input-group-text">Manager :</label>
                  </div>
                  <select name="manager" id="manager" class="form-control form-control-sm" style="border-top-right-radius: 3px; border-bottom-right-radius: 3px;">
                    <option value="">Pilih manager</option>
                    <!-- <option value=""></option> -->
                  </select>
                    <div class="form-check ml-2 mt-1">
                      <input class="form-check-input" type="checkbox" value="koreksi" id="koreksi" name="koreksi">
                      <label class="form-check-label" for="koreksi">
                        Koreksi
                      </label>
                    </div>
                </div>

                <div class="input-group input-group-sm mt-1">
                    <div class="input-group-prepend">
                        <label for="gudang" class="input-group-text">Gudang :</label>
                    </div>
                    <input type="text" name="gudang" id="gudang" class="form-control" readonly>
                </div>
            
                <!-- <div class="form-check form-check-inline">
                    <input type="checkbox" name="koreksi" id="koreksi" class="form-check-input">
                    <label class="form-check-label" for="koreksi">Koreksi</label>
                </div> -->
            <!-- </div> -->
        </form>
    </div>
</div>

<h5 class="text-bold mt-4">Penjualan</h5>
<button class="btn btn-primary mb-2" id="tambah-data">Tambah Data</button>
<a href="<?= base_url('manager/export');?>" class="btn btn-danger mb-2">Export PDF</a>

<div class="table-responsive">
    <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
        <table id="mytable" class="table table-striped table-bordered table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Kode Barang</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">QTY</th>
                    <th class="text-center">O/C</th>
                    <th class="text-center">Total O/C</th>
                    <th class="text-center">F/C</th>
                    <th class="text-center">Total F/C</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($weekly_manager2_barang) > 0){
                  
                  foreach($wm2hidden as $k => $v){ ?>
                    <input type="hidden" name="idweekly[]" value="<?= $v['id_weekly_manager2']?>">
                  <?php } ?>
                  <?php foreach($weekly_manager2_barang as $k => $v){ ?>
                    
                    <tr>
                      <td><?= $k+1 ?></td>
                      <td><?= $v['kode'] ?></td>
                      <td><?= $v['nama'] ?></td>
                      <td><?= $v['qty_terjual'] ?></td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                  </tr>
                 <?php }
                }else{ ?>
                  <tr>
                    <td class="text-center" colspan="9">Tidak ada data ditampilkan.</td>
                  </tr>
                <?php } ?>
              
            </tbody>
        </table>
    </div>
    <!-- ./table-responsive -->

</div>

<!-- ./container-fluid -->
<div class="container ml-2 mr-2 mt-3">
<h5 class="text-dark text-bold">Pengeluaran / Pemasukan</h5>
<div class="row">
            <div class="col-lg-4">
                <!-- <a href="" class="btn btn-primary btn-sm">Tambah</a> -->
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambahInOut">Tambah</button>
                <table class="table table-responsive text-center table-sm text-dark mt-2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="show_data_inout">
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <table class="table table-responsive text-center table-sm text-dark" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Total Qty</th>
                            <td id="ttlqty"></td>
                        </tr>
                        <tr>
                            <th>Total O/C</th>
                            <td id="ttlotc"></td>
                        </tr>
                        <tr>
                            <th>PPN</th>
                            <td id="ppn"></td>
                        </tr>
                        <tr>
                            <th>Penjualan Kotor</th>
                            <td id="pjlkotor"></td>
                        </tr>
                        <tr>
                            <th>Hutang Dagang</th>
                            <td id="htgdgg"></td>
                        </tr>
                        <tr>
                            <th>Laba Kotor Penjualan</th>
                            <td class="labakotor"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <table class="table table-responsive table-sm text-dark" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Biaya ADM</th>
                            <td><input type="text" value="0" class="text-right form-control form-control-sm" style="height: 25px" id="biaya_adm"></td>
                        </tr>
                        <tr>
                            <th>Biaya Konsultan</th>
                            <td><input type="text" value="0" class="text-right form-control form-control-sm" style="height: 25px" id="biaya_konsultan"></td>
                        </tr>
                        <tr>
                            <th>Total Pengeluaran</th>
                            <td class="text-right labakotor">0</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-responsive table-sm text-dark" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Point Unit</th>
                            <td class="text-right">0,00</td>
                        </tr>
                        <tr>
                            <th>Override Pribadi</th>
                            <td class="text-right">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-8">
                <h6 class="text-dark text-bold">Piutang / (Hutang)</h6>
                <table class="table table-responsive text-center table-sm text-dark" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Saldo Awal</th>
                            <th>Masuk / Keluar</th>
                            <th>Saldo Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Simpanan di HO</td>
                            <td id="saldoawal_simp"></td>
                            <td id="inout">0</td>
                            <td id="saldoakhir_simp">0</td>
                        </tr>
                        <tr>
                            <td>Override</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 d-flex">
                <table class="table table-responsive table-sm text-dark" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Laba Kotor Diterima</th>
                            <td class="text-right labakotor">0</td>
                        </tr>
                        <tr>
                            <th>Total Pembayaran Tagihan</th>
                            <td class="text-right labakotor">0</td>
                        </tr>
                        <tr>
                            <th>Jumlah Bersih Diterima</th>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <th>Saldo Awal</th>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <th>Saldo Akhir</th>
                            <td class="text-right">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-4 text-dark">
                <label for="akunsetoran">Akun Setoran :</label>
                <div class="input-group input-group-sm">
                  <select name="akunsetoran" id="akunsetoran" class="form-control form-control-sm">
                      <option value="">K-200 Bank BCA</option>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-warning btn-sm text-dark">Tambah Akun</button>
                  </div>
                </div>
                <br>
                <label for="akunadm">Akun ADM :</label>
                <div class="input-group input-group-sm">
                  <select name="akunadm" id="akunadm" class="form-control form-control-sm">
                      <option value="">K-200 Bank BCA</option>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-warning btn-sm text-dark">Tambah Akun</button>
                  </div>
                </div>
            </div>
            <div class="col-lg-4 text-dark">
                <label for="akunkonsultan">Akun Konsultan :</label>
                <div class="input-group input-group-sm">
                    <select name="akunkonsultan" id="akunkonsultan" class="form-control form-control-sm">
                        <option value="">K-200 Bank BCA</option>
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-warning btn-sm text-dark">Tambah Akun</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-dark text-right">
                <button class="btn btn-sm btn-success prosesInvoice" id="prosesInvoice">Proses</button>
            </div>
        </div>
    </div>


<!-- Modal Tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahlabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahlabel">Form Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('manager/tambah');?>" method="POST"> 
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditlabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditlabel">Form Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('manager/tambah');?>" method="POST"> 
        <div class="modal-body">
          <div class="form-group">
            <label for="kode2">Kode</label>
            <select name="kode2" id="kode2" class="form-control">
              <option>Pilih kode barang</option>
              <?php foreach($kode_barang as $kode_brg): ?>
              <option value="<?= $kode_brg['kode']; ?>"><?= $kode_brg['kode']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama2">Nama</label>
            <input name="nama2" id="nama2" class="form-control" value="" readonly/>
          </div>
          <div class="form-group">
            <label for="gudang2">Gudang</label>
            <input name="gudang2" id="gudang2" class="form-control" value="<?= $this->session->userdata('gudang'); ?>" readonly />
          </div>
          <div class="form-group">
            <label for="qty2">Qty</label>
            <input name="qty2" id="qty2" class="form-control" value="0" />
          </div>
          <div class="form-group">
            <label for="stok2">Stok</label>
            <input name="stok2" id="stok2" class="form-control" value="0" readonly/>
          </div>
          <div class="form-group">
            <label for="ftc2">F/C</label>
            <input name="ftc2" id="ftc2" class="form-control" value="0" readonly />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Edit Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah InOut-->
<div class="modal fade" id="modalTambahInOut" tabindex="-1" aria-labelledby="modalTambahInOutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahInOutLabel">Form Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <input name="keterangan" id="keterangan" class="form-control" />
        </div>
        <div class="form-group">
          <label for="jenis">Jenis</label>
          <select name="jenis" id="jenis" class="form-control">
            <option value="Pemasukan Simpanan">Pemasukan Simpanan</option>
            <option value="Pengeluaran Simpanan">Pengeluaran Simpanan</option>
            <option value="Pemasukan OVR">Pemasukan OVR</option>
            <option value="Pengeluaran OVR">Pengeluaran OVR</option>
          </select>
        </div>
        <div class="form-group">
          <label for="jumlah">Jumlah</label>
          <input name="jumlah" id="jumlah" class="form-control" />
        </div>
        <div class="form-group">
          <label for="akun">Akun</label>
          <select name="akun" id="akun" class="form-control">
            <option value="K-101">K-101 Kas</option>
            <option value="K-200">K-200 Bank BCA</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="tambahInOut" data-dismiss="modal">Tambah Data</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit InOut-->
<div class="modal fade" id="modalEditInOut" tabindex="-1" aria-labelledby="modalEditInOutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditInOutLabel">Form Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="keterangan2">Keterangan</label>
          <input name="keterangan2" id="keterangan2" class="form-control" />
        </div>
        <div class="form-group">
          <label for="jenis2">Jenis</label>
          <select name="jenis2" id="jenis2" class="form-control">
            <option value="Pemasukan Simpanan">Pemasukan Simpanan</option>
            <option value="Pengeluaran Simpanan">Pengeluaran Simpanan</option>
            <option value="Pemasukan OVR">Pemasukan OVR</option>
            <option value="Pengeluaran OVR">Pengeluaran OVR</option>
          </select>
        </div>
        <div class="form-group">
          <label for="jumlah2">Jumlah</label>
          <input name="jumlah2" id="jumlah2" class="form-control" />
        </div>
        <div class="form-group">
          <label for="akun2">Akun</label>
          <select name="akun2" id="akun2" class="form-control">
            <option value="K-101">K-101 Kas</option>
            <option value="K-200">K-200 Bank BCA</option>
          </select>
        </div>
      </div>
      <input type="hidden" name="id_inout" id="id_inout" />
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="editInOut()" data-dismiss="modal">Edit Data</button>
      </div>
    </div>
  </div>
</div>

<script>

$('.datepicker').datepicker();

$('#tambah-data').on('click', function() {
    let mitraid = $('select[name="kode_mitra"]').val();
    let fetchUrl = "manager/formtambah/" + mitraid;

    $.ajax({
      url: "<?= base_url(); ?>" + fetchUrl,
      success: function(result) {
        var data = JSON.parse(result);
        var konten = ``;

        if(data.weekly_manager2.length == 0){
          konten += `
          <div class="alert alert-danger text-center">tidak ada data pada mitra `+(mitraid+' - '+data.mitra[0].name)+`</div>
          `;
          $('#modalTambah .modal-footer').addClass('d-none');
        }
        else{
          $('#modalTambah .modal-footer').removeClass('d-none');
          if(data.weekly_manager2_barang[0].status == 'disimpan'){
            konten += `
              <div class="alert alert-danger text-center">Data ini telah anda tambahkan</div>
            `;
            $('#modalTambah .modal-footer').addClass('d-none');
          }
          else{
            $('#modalTambah .modal-footer').removeClass('d-none');
          }
          konten += `
              <input type="hidden" name="id" value="`+(data.weekly_manager2[0].id)+`">
              <label>Mitra : <b>`+(mitraid+' - '+data.mitra[0].name)+`</b></label><br>
              <label>No Weekly : <b>`+(data.weekly_manager2[0].no_invoice)+`</b></label><br>
              <hr>
              <div class="table-responsive">
                  <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>Qty</th>
                          <th>Stok</th>
                          <th>Harga Setor</th>
                          <th>Total Item</th>
                      <tr>
                  <thead>
                  <tbody>`;
                  $.each( data.weekly_manager2_barang, function( key, value ) {
                      konten += `
                      <tr>
                          <td>`+(value.kode)+`</td>
                          <td>`+(value.nama)+`</td>
                          <td>`+(value.qty_terjual)+`</td>
                          <td>`+(value.stok)+`</td>
                          <td>`+(new Intl.NumberFormat("id-ID").format(value.harga_setor))+`</td>
                          <td>`+(new Intl.NumberFormat("id-ID").format(value.total_item))+`</td>
                      </tr>
                      `;
                  })
                  konten += `
                  </tbody>
                  </table>
              </div>
              <div class="form-group">
                  <label>Total Penjualan</label>
                  <input class="form-control" value="`+(data.weekly_manager2[0].nominal_total)+`" name="total_penjualan" required readonly>
              </div>
              
          `;
        }

        $('#modalTambah .modal-body').html(konten);
        $('#modalTambah').modal('show');

      }
    });
  });




$('#jabatan').on('change', function() {
  let weekending = $('#weekending').val();
  fetchData(this.value);
});

$('#weekending').on('change', function() {
  let manager = $('#manager').val();
  invoiceMgr(this.value, manager);
});

$('#manager').on('change', function() {
  let weekending = $('#weekending').val();
  invoiceMgr(weekending, this.value);
});

$('#koreksi').on('change', function() {
  fetchData($('#jabatan').val());
});

function invoiceMgr(weekending, kode_id) {
  let urlInvoiceMgr = "manager/invoiceMgr/" + weekending + "/" + kode_id;

  $.ajax({
    url: "<?= base_url(); ?>" + urlInvoiceMgr,
    success: function(result) {
      let results = JSON.parse(result);
      let data = "";

      if (!results[0]) {
        data = `<tr><td class="text-center" colspan="9">Tidak ada data ditampilkan.</td></tr>`;
        alert("Manager belum mengirimkan data!");

        $('#noinv').val(results[0].no_invoice);
        $('#nm_manager').val(results[0].nm_mgr);
        $('#id_manager').val('MT-' + results[0].kode_id);
        $('#gudang').val(results[0].gudang);
        $('#akun_security').val(results[0].nm_mgr);
        $('#id_security').val('K-' + results[0].akun_simpanan);

      } else {
        $('#noinv').val(results[0].no_invoice);
        $('#nm_manager').val(results[0].nm_mgr);
        $('#id_manager').val('MT-' + results[0].kode_id);
        $('#gudang').val(results[0].gudang);
        $('#akun_security').val(results[0].nm_mgr);
        $('#id_security').val('K-' + results[0].akun_simpanan);

        getAdditionalData(weekending, results[0].kode_id);
        getSaldoUser(results[0].akun_simpanan);
        getSUMInOut(results[0].no_invoice);
        countAllSaldo();

        for (let i = 0; i < results.length; i++) {
          data += `<tr>
          <td class="text-center">
          ${i+1}
          </td>
          <td class="text-center">
          ${results[i].kode}
          </td>
          <td class="text-center">
          ${results[i].nama}
          </td>
          <td class="text-center">
          ${results[i].qty}
          </td>
          <td class="text-center">
          ${results[i].otc}
          </td>
          <td class="text-center">
          ${results[i].totalotc}
          </td>
          <td class="text-center">
          ${results[i].ftc}          
          </td>
          <td class="text-center">
          ${results[i].totalftc}          
          </td>

          <td class="text-center">

          <div class="btn-group">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Action
          </button>
          <div class="dropdown-menu">
          <button onclick="getEdit(${results[i].id})" class="btn btn-success" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></button>
          <a href="<?= base_url();?>manager/hapus/${results[i].id}" class="btn btn-danger mt-2" style="margin-left:35px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
          </div>
          </div>
          </td>
          </tr>`;
        }

        fetchInOut(results[0].no_invoice);

        let pilihanAkun = `<option value="K-200">K-200 Bank BCA</option>`;
        $('#akunsetoran').html(pilihanAkun);
        $('#akunadm').html(pilihanAkun);
        $('#akunkonsultan').html(pilihanAkun);

        let inOutData = "";
        let nomor_invoice = results[0].no_invoice;

        $('#tambahInOut').on('click', function() {
          tambahInOut(nomor_invoice);
        });
        
      }
      $('#show_data').html(data);
    }
  });
}

function getAdditionalData(weekending, kode_id) {
  return $.ajax({
    url: '<?= base_url('manager/getAdditionalData/'); ?>' + weekending + "/" + kode_id,
    success: function(result) {
      result = JSON.parse(result);
      let ttlqty = result.ttlqty;
      let ttlfullotc = result.ttlfullotc;
      let ttlfullftc = result.ttlfullftc;
      let htgdgg = Number(ttlfullotc) + Number(ttlfullotc * (10 / 100));

      $('#ttlqty').html(numberFormatter.format(ttlqty));
      $('#ttlotc').html(numberFormatter.format(ttlfullotc));
      $('#ppn').html(numberFormatter.format(ttlfullotc * (10 / 100)));
      $('#pjlkotor').html(numberFormatter.format(ttlfullftc));
      $('#htgdgg').html(numberFormatter.format(htgdgg));

      $('.labakotor').each(function() {
        $(this).html(numberFormatter.format(ttlfullftc - htgdgg));
      });

      let inout = (ttlfullftc - htgdgg);
      document.cookie = "inout=" + inout;
    }
  });
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function countAllSaldo() {
  let inOut = Number(getCookie("inout"));
  let ttlkredit = Number(getCookie("suminoutkre"));
  let ttldebit = Number(getCookie("suminoutdeb"));
  let saldoAwalSimp = Number(getCookie("saldoawal_simp"));
  let compute = Number(inOut - (ttlkredit - ttldebit));

  $('#saldoawal_simp').html(numberFormatter.format(saldoAwalSimp));
  $('#inout').html(numberFormatter.format(compute));
  if (compute >= 0) {
    $('#saldoakhir_simp').html(numberFormatter.format(saldoAwalSimp + compute));
  } else {
    $('#saldoakhir_simp').html(numberFormatter.format(saldoAwalSimp - compute));
  }
}

function getSaldoUser(akun_simpanan) {
  $.ajax({
    url: '<?= base_url('manager/getSaldoUser/'); ?>' + akun_simpanan,
    success: function(result) {
      result = JSON.parse(result);
      document.cookie = "saldoawal_simp=" + result.saldo_awal;
    }
  });
}

function getSUMInOut(no_invoice) {
  $.ajax({
    url: '<?= base_url('manager/getSUMInOut/'); ?>' + no_invoice.split("/").join("-"),
    success: function(result) {
      result = JSON.parse(result);
      document.cookie = "suminoutkre=" + result.ttlkredit;
      document.cookie = "suminoutdeb=" + result.ttldebit;
    }
  });
}

function getEdit(id) {
  let url = `<?php echo base_url();?>manager/getData/${id}`;

  $.ajax({
    url: url,
    success: function(result) {
      let results = JSON.parse(result);
      $('#kode2').val(results[0].kode);
      $('#nama2').val(results[0].nama);
      $('#gudang2').val(results[0].gudang);
      $('#qty2').val(results[0].qty);
      $('#stok2').val(results[0].stok);
      $('#ftc2').val(results[0].ftc);
      $('#modalEdit').modal('show');
    }
  }); 
}

function fetchInOut(no_invoice) {
  let urlFetchInOut = "manager/fetchInOut/" + no_invoice.split("/").join("-");

  $.ajax({
    url: "<?= base_url(); ?>" + urlFetchInOut,
    success: function(result) {
      let results = JSON.parse(result);
      let data = "";

      if (!results[0]) {
        data = `<tr><td colspan="3">Tidak ada data.</td></tr>`;
      } else {
        for (let i = 0; i < results.length; i++) {
          data += `
          <tr>
          <td>${results[i].keterangan}</td>
          <td>${results[i].debit}</td>
          <td>${results[i].kredit}</td>
          <td>
          <div class="btn-group">
          <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Action
          </button>
          <div class="dropdown-menu">
          <button class="btn btn-sm btn-success" style="margin-left:42px" onclick="getInOut(${results[i].id})"><i class="fa fa-edit"></i>Edit</i></button>
          <button onclick="hapusInOut(${results[i].id})" class="btn btn-sm btn-danger mt-2" style="margin-left:35px"><i class="fa fa-trash"></i>Hapus</button>
          </div>
          </div>
          </td>
          </tr>
          `;
        }
      }

      $('#show_data_inout').html(data);
    }
  });
}

function fetchData(jabatan) {
  let urlFetchMgr = "manager/allMgr/" + jabatan;

  $.ajax({
    url: "<?= base_url(); ?>" + urlFetchMgr,
    success: function(result) {
      let data = "";
      let results = JSON.parse(result);

      if (!results[0]) {
        data = `<option value="">Pilih manager</option>`;
      } else {
        data = `<option value="">Pilih manager</option>`;
        for (let i = 0; i < results.length; i++) {
          data += `
          <option value="${results[i].kode_id}">MT-${results[i].kode_id} ${results[i].nama}</option>
          `;
        }
      }

      $('#manager').html(data);
    }
  });

}

$('#kode').on('change', function() {
  let barang = $('#kode').val();
  let fetchUrl = "manager/barang/" + barang;

  $.ajax({
    url: "<?= base_url(); ?>" + fetchUrl,
    success: function(result) {
      let results = JSON.parse(result);
      let data = "";

      $('#nama').val(results[0].nama);
      $('#stok').val(results[0].qty);
      $('#otc').val(results[0].sebelumpajak);
      $('#ftc').val(results[0].hargasetoran);
    }
  });
});

function tambahInOut(nomor_invoice) {
  let keterangan = $('#keterangan').val();
  let jenis = $('#jenis').val();
  let jumlah = $('#jumlah').val();
  let akun = $('#akun').val();

  let fetchUrl = "manager/tambahInOut";


  $.ajax({
    url: "<?= base_url(); ?>" + fetchUrl,
    data: {
      kode_id: $('#id_manager').val(),
      no_invoice: nomor_invoice,
      keterangan: keterangan,
      jenis: jenis,
      jumlah: jumlah,
      akun: akun,
    },
    type: 'POST',
    success: function(result) {
      fetchInOut(JSON.parse(result));
    }
  });

}

function editInOut() {
  let id = $('#id_inout').val();
  let keterangan = $('#keterangan2').val();
  let jenis = $('#jenis2').val();
  let jumlah = $('#jumlah2').val();
  let akun = $('#akun2').val();

  let fetchUrl = "manager/editInOut";

  $.ajax({
    url: "<?= base_url(); ?>" + fetchUrl,
    data: {
      id: id,
      keterangan: keterangan,
      jenis: jenis,
      jumlah: jumlah,
      akun: akun,
    },
    type: 'POST',
    success: function() {
      fetchInOut($('#noinv').val());
    }
  });

}

function hapusInOut(id) {
  let url = "manager/hapusInOut/" + id;

  let hapus = confirm('Yakin ingin dihapus?');

  if (hapus) {
    $.ajax({
      url: url,
      success: function(result) {
        fetchInOut($('#noinv').val());
      }
    });
  }

}

function getInOut(id) {
  let url = "manager/getInOut/" + id;

  $.ajax({
    url: url,
    success: function(result) {
      let results = JSON.parse(result);
      $('#id_inout').val(results[0].id);
      $('#keterangan2').val(results[0].keterangan);
      $('#jenis2').val(results[0].jenis);
      if (results[0].debit == 0) {
        $('#jumlah2').val(results[0].kredit);
      } else {
        $('#jumlah2').val(results[0].debit);
      }
      $('#akun2').val(results[0].akun);
      $('#modalEditInOut').modal('show');
    }
  });
}

  $('#prosesInvoice').on('click', function(){
    console.log('awdasd');
    let no_invoice = $('#noinv').val();
    var data = {
      'noinv' : no_invoice, 
      'idweekly' : [], 
    };
    // $('input[name="idweekly[]"]').val()
    $('input[name="idweekly[]"]').each(function (i, val) {
      data.idweekly.push($(val).val());
    });
    
    if(data.idweekly.length == 0 || no_invoice == ''){
      alert('tidak ada data yang akan diproses, harap tambah data Weekly Mitra');
    }
    else{
      let url = "<?= base_url() ?>"+"manager/prosesInvoice/";
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(result) {
          alert('Data telah selesai diproses!');
          location.href = '<?= base_url() ?>'+'/manager';
          // fetchInOut($('#noinv').val());
        }
      });  
    }
  });
  

</script>