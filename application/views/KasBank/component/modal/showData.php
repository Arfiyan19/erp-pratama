<div class="modal fade" id="showData" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tableShowData" class="table table-striped table-bordered table-hover table-full-width" cellspacing="0" width="" style="font-size: small;">
                        <thead>
                            <tr style="text-align:center;">
                                <th>
                                    <input type="checkbox" id="check-all" style="transform: scale(0.6)" class="form-control" onchange="checkAllSJ(this)" />
                                </th>
                                <th>Tanggal</th>
                                <th>Nomor Aktivitas</th>
                                <th>Nominal Aktivitas</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="handleChooseData()"><i class="fas fa-plus"></i> Pilih</button>
                <button type="button" class="btn btn-secondary" onclick="handleCloseModalShowData()">Tutup</button>
            </div>
        </div>
    </div>
</div>