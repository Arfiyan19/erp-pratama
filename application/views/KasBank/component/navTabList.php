<ul class="nav nav-tabs my-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="rincian-tab" data-toggle="pill" href="#rincian" role="tab" aria-controls="rincian" aria-selected="true">Rincian Kas Bank</a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" id="kas-bank-tab" data-toggle="pill" href="#kas-bank" role="tab" aria-controls="kas-bank" aria-selected="false">Kas Bank</a>
    </li> -->
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="rincian" role="tabpanel" aria-labelledby="rincian-tab">

        <div class="my-3 text-center">
            <button class="btn btn-success btn-sm" onclick="handleShowDataPengiriman()">Pengiriman</button>
            <button class="btn btn-info btn-sm" onclick="handleShowDataPenerimaan()">Penerimaan</button>
            <button class="btn btn-secondary btn-sm" onclick="handleShowDataPiutang()">Piutang</button>
            <button class="btn btn-danger btn-sm" onclick="handleShowDataHutang()">Hutang</button>
        </div>

        <div class="table-responsive">
            <table id="tableDataRincian" class="table table-striped table-bordered table-hover table-full-width" cellspacing="0" width="" style="font-size: small;">
                <thead>
                    <tr style="text-align:center;">
                        <td width="10%"><strong>Tanggal</strong></td>
                        <td width="15%"><strong>Nomor Aktivitas</strong></td>
                        <td width="15%"><strong>Nominal Aktivitas</strong></td>
                        <td width="10%"><strong>Penerimaan</strong></td>
                        <td width="10%"><strong>Pengeluaran</strong></td>
                        <td width="13%"><strong>Sisa Aktivitas</strong></td>
                        <td width="15%"><strong>Rekening</strong></td>
                        <td width="7%"><strong>Action</strong></td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <!-- <div class="tab-pane fade" id="kas-bank" role="tabpanel" aria-labelledby="kas-bank-tab">...</div> -->
</div>

<div class="row my-3">
    <div class="col-md-2"></div>
    <div class="col-md-2 text-right" style="margin-top: 1%">Total Penerimaan</div>
    <div class="col-md-3">
        <input type="text" id="penerimaan_sementara" class="form-control decimalnumber text-right" name="" readonly>
        <input type="hidden" id="penerimaan" class="form-control decimalnumber text-right" name="penerimaan" readonly>
    </div>
    <div class="col-md-2 text-right" style="margin-top: 1%">Total Pengeluaran</div>
    <div class="col-md-3">
        <input type="text" id="pengeluaran_sementara" class="form-control decimalnumber text-right" name="" readonly>
        <input type="hidden" id="pengeluaran" class="form-control decimalnumber text-right" name="pengeluaran" readonly>
    </div>
    <div class="col-md-3"></div>

</div>