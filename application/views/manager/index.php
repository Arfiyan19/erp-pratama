

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
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= $this->session->flashdata('flash2');?>
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
                <input type="text" name="noinv" id="noinv" class="form-control form-control-sm">
            </div>
            <div class="input-group input-group-sm mt-1">
                <div class="input-group-prepend">
                    <label for="noinv" class="input-group-text">Mitra :</label>
                </div>
                <select class="form-control" name="mitra">
                  <option value="0">Pilih Mitra</option>
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
<a href="<?= base_url('manager/tambahpl');?>" class="btn btn-primary mb-2">Tambah Data</a>
<a href="<?= base_url('manager/export');?>" class="btn btn-danger mb-2">Export PDF</a>

<div class="table-responsive">
    <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
        <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">No Manager PL</th>
                    <th class="text-center">No Invoice</th>
                    <th class="text-center">Kode Mitra</th>
                    <th class="text-center">Nama Mitra</th>
                    <th class="text-center">Total Penjualan</th>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">Tanggal Validasi</th>
                    <th class="text-center">Validasi</th>
                </tr>
            </thead>
            <tbody>
              <?php if(count($managerpl) < 1){ 
                $totalall = 0;?>
                <tr>
                  <td class="text-center" colspan="9">Tidak ada data ditampilkan.</td>
                </tr>
              <?php }else{ ?>
                <?php 
                  $totalall = 0;
                  foreach($managerpl as $k => $v){ 
                    $totalall += floatval($v['nominal_total']);
                    ?>
                  <tr>
                    <td><?= $k+1 ?></td>
                    <td><?= $v['no_invoice_manager'] ?></td>
                    <td><?= $v['no_invoice'] ?></td>
                    <td><?= $v['kode_id'] ?></td>
                    <td><?= $v['name'] ?></td>
                    <td><?= number_format($v['nominal_total'], 2, ',', '.'); ?></td>
                    <td>
                      <button data-id="<?= $v['wmid'] ?>" data-tglvalid="<?= $v['tgl_validasi'] ?>" class="mb-1 btn btn-warning edit">Edit</button>
                      <button data-id="<?= $v['wmid'] ?>" class="mb-1 btn btn-danger hapus">Batalkan Validasi</button>
                      <button data-id="<?= $v['wmid'] ?>" class="mb-1 btn btn-success priview">Preview</button>
                    </td>
                    <td><?= $v['tgl_validasi'] ?></td>
                    <td><?= $v['validasi'] ?></td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
            <tfoot id="tfooter">
              <tr>
                <th colspan="4"></th>
                <th><h5><b>Total</b></h5></th>
                <th><h5><b><?= number_format($totalall, 2, ',', '.') ?></b></h5></th>
                <th colspan="3"></th>
              </tr>
            </tfoot>
        </table>
    </div>
    <!-- ./table-responsive -->

</div>

<!-- Modal priview-->
<div class="modal fade" id="modalpriview" tabindex="-1" aria-labelledby="modalPriviewlabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPriviewlabel">Priview Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="modaleditlabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditlabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php base_url() ?>manager/editpl" method="POST">
            <div class="modal-body ">
              <div class="attr"></div>
              <div class="form-group">
                <label>Edit Tanggal Validasi</label>
                <input type="date" name="tgl_validasi" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
  $('#mytable').on('click', '.edit', function() {
    let id = $(this).attr('data-id');
    let defval = $(this).attr('data-tglvalid');

    $('#modaledit .modal-body input[name="tgl_validasi"]').val(defval);
    $('#modaledit .modal-body .attr').html("<input type='hidden' name='id' value='"+id+"'>");
    $('#modaledit').modal("show");
  });

  $('#mytable').on('click', '.hapus',function() {
    let id = $(this).attr('data-id');
    let fetchUrl = "<?= base_url(); ?>" ;

    let text = "Apakah anda yakin untuk membatalkan validasi ? ";
    if (confirm(text) == true) {
        location.href = fetchUrl + "manager/batalpl/" + id;
    }

  });

  $('#mytable').on('click', '.priview', function() {
    let id = $(this).attr('data-id');
    let fetchUrl = "manager/priview/" + id;

    $.ajax({
      url: "<?= base_url(); ?>" + fetchUrl,
      success: function(result) {
        var data = JSON.parse(result);
        console.log(data);
        var konten = ``;

        if(data.weekly_manager2[0].validasi == 'V'){
            konten += `
            <label>No Invoice Manager PL: <b>`+(data.weekly_manager2[0].no_invoice_manager)+`</b></label><br>
            `
        }
        konten += `
            <label>No Invoice : <b>`+(data.weekly_manager2[0].no_invoice)+`</b></label><br>
            <label>Tanggal : <b>`+(data.weekly_manager2[0].tgl)+`</b></label><br>
            <label>Nominal Total : <b>`+(new Intl.NumberFormat("id-ID").format(data.weekly_manager2[0].nominal_total))+`</b></label><br>
            <label>Validasi : <b>`+(data.weekly_manager2[0].validasi == 'V' ? 'V (sudah tervalidasi)' : 'N (belum tervalidasi)' )+`</b></label>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>FC</th>
                        <th>Stok</th>
                        <th>Qty Terjual</th>
                        <th>Harga Setor</th>
                        <th>Total Item</th>
                    <tr>
                <thead>
                <tbody>`;
                $.each( data.weekly_manager2_barang, function( key, value ) {
                    konten += `
                    <tr>
                        <td>`+(value.kode+' - '+value.nama)+`</td>
                        <td>`+(value.fc)+`</td>
                        <td>`+(value.stok)+`</td>
                        <td>`+(value.qty_terjual)+`</td>
                        <td>`+(new Intl.NumberFormat("id-ID").format(value.harga_setor))+`</td>
                        <td>`+(new Intl.NumberFormat("id-ID").format(value.total_item))+`</td>
                    </tr>
                    `;
                })
                konten += `
                </tbody>
                </table>
            </div>
        `;

        $('#modalpriview .modal-body').html(konten);
        $('#modalpriview').modal('show');

      }
    });
  });
</script>
