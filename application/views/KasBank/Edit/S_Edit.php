<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const dataId = Object.fromEntries(urlSearchParams.entries()).id;


    $(document).ready(function() {

        $(document).on("input", ".numeric", function(event) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        getDataHeader()
        getDataDetail()

        countTotal();
    });

    async function postData(url = '', data = {}, type) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: type,
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        return response.json();
    }

    const getDataHeader = () => {
        postData('<?= base_url('Kas_bank/getDataHeaderById') ?>', {
                id: dataId
            }, 'POST')
            .then((response) => {
                $("#nomor_kas_bank").val(response.kode)
                $("#tanggal").val(response.tanggal)
                $("#keterangan").val(response.keterangan == null ? '' : response.keterangan)
            });
    }

    const getDataDetail = () => {
        postData('<?= base_url('Kas_bank/getDataDetailById') ?>', {
                id: dataId
            }, 'POST')
            .then((response) => {
                let arrIdx = [];
                // console.log(response);

                arrIdx = [];
                response.forEach(function(v, i) {
                    let idx = $("#tableDataRincian tbody tr").length;
                    arrIdx.push({
                        idx,
                        rekeningId: v.rekening_id
                    });

                    const type = (v.id_penerimaan != null) ? 'penerimaan' : (v.id_pengiriman != null) ? 'pengiriman' : (v.id_piutang != null) ? 'piutang' : (v.id_hutang != null) ? 'hutang' : '';
                    const typeId = (v.id_penerimaan != null) ? v.id_penerimaan : (v.id_pengiriman != null) ? v.id_pengiriman : (v.id_piutang != null) ? v.id_piutang : (v.id_hutang != null) ? v.id_hutang : '';

                    $("#tableDataRincian > tbody").append(`
                        <tr>
                            <td>${v.tanggal} <input type="hidden" value="${type}, ${typeId}"></td>
                            <td>${v.nomor_aktivitas}</td>
                            <td>${numberFormat(v.nominal_aktivitas)}</td>
                            <td>
                                <input type="text" class="form-control numeric" ${v.penerimaan != null ? "" : "disabled"} onkeyup="handleCountPenerimaan(event,'${idx}', '${v.nominal_aktivitas}')" value="${v.penerimaan == null ? '' : v.penerimaan}">
                            </td>
                            <td>
                                <input type="text" class="form-control numeric" ${v.pengeluaran != null ? "" : "disabled"} onkeyup="handleCountPengeluaran(event,'${idx}', '${v.nominal_aktivitas}')" value="${v.pengeluaran == null ? '' : v.pengeluaran}">
                            </td>
                            <td>
                                <input type="text" class="form-control" disabled id="sisaAktivitas_${idx}" value="${numberFormat(v.sisa_aktivitas)}">
                            </td>
                            <td>
                                <select class="form-control rekening" name="rekening" id="rekening_${idx}" required></select>
                            </td>
                            <td>
                                <button type="button" class="deleteItem" style="border:none;background:transparent"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
                            </td>
                        </tr>
                    `);
                });

                fetch('<?= base_url('Kas_bank/getRekening'); ?>')
                    .then(response => response.json())
                    .then((result) => {

                        $.each(arrIdx, function(i, v) {
                            $(`#rekening_${v.idx}`).empty();
                            let html = '';
                            html += "<option value=''>--Pilih Rekening--</option>";
                            result.forEach((value) => {
                                if (v.rekeningId == value.id) {
                                    html += `<option value="${value.id}" selected>${value.name}</option>`;
                                } else {
                                    html += `<option value="${value.id}">${value.name}</option>`;
                                }
                            });
                            $(`#rekening_${v.idx}`).append(html);
                        })
                    });

                countTotal();
            });
    }

    const countTotal = () => {

        let totPenerimaan = 0;
        let totPegeluaran = 0;

        $("#tableDataRincian > tbody tr").each(function() {
            let penerimaan = $(this).find("td:eq(3) input[type='text']").val()
            let pengeluaran = $(this).find("td:eq(4) input[type='text']").val()

            let changeValPenerimaan = penerimaan == "" ? 0 : parseFloat(penerimaan);
            let changeValPengeluaran = pengeluaran == "" ? 0 : parseFloat(pengeluaran);
            totPenerimaan += changeValPenerimaan
            totPegeluaran += changeValPengeluaran

        });

        $("#penerimaan_sementara").val(numberFormat(totPenerimaan))
        $("#pengeluaran_sementara").val(numberFormat(totPegeluaran))
    }

    const initDataTable = (table, target) => {
        $(table).DataTable({
            columnDefs: [{
                sortable: false,
                targets: target
            }],
            lengthMenu: [
                [-1],
                ['All']
            ],
        });
    }

    const numberFormat = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const handleShowDataPengiriman = () => {

        $("#showData").modal('show');
        $(".modal-title").html("Data Pengiriman");

        postData('<?= base_url('Kas_bank/getDataPengirimanById'); ?>', {
                id: dataId
            }, 'POST')
            .then((response) => {
                initData(response)
            });
    }

    const handleShowDataPenerimaan = () => {

        $("#showData").modal('show');
        $(".modal-title").html("Data Penerimaan");

        postData('<?= base_url('Kas_bank/getDataPenerimaanById'); ?>', {
                id: dataId
            }, 'POST')
            .then((response) => {
                initData(response)

            });
    }

    const handleShowDataPiutang = () => {

        $("#showData").modal('show');
        $(".modal-title").html("Data Piutang");

        postData('<?= base_url('Kas_bank/getDataPiutangById'); ?>', {
                id: dataId
            }, 'POST')
            .then((response) => {
                initData(response)

            });
    }

    const handleShowDataHutang = () => {

        $("#showData").modal('show');
        $(".modal-title").html("Data Hutang");

        postData('<?= base_url('Kas_bank/getDataHutangById'); ?>', {
                id: dataId
            }, 'POST')
            .then((response) => {
                initData(response)

            });
    }

    const initData = (response) => {
        if (response.length > 0) {
            if ($.fn.DataTable.isDataTable('#tableShowData')) {
                $('#tableShowData').DataTable().destroy();
            }

            $("#tableShowData > tbody").empty();

            response.forEach((v) => {
                $("#tableShowData > tbody").append(`
                    <tr class="text-center">
                        <td>
                            <input type="checkbox" class="form-control check-item" style="transform: scale(0.5)" name="chk-data[]" id="chk-data[]" value="${v.id}"/>
                        </td>
                        <td>${v.tanggal}</td>
                        <td>${v.no_aktivitas}</td>
                        <td>Rp. ${numberFormat(v.nominal)}</td>
                    </tr>
                `);
            });

            initDataTable("#tableShowData", [0, 1, 2, 3])

        } else {
            $("#tableShowData > tbody").html(`<tr><td colspan="4" class="text-center text-danger">Data Kosong</td></tr>`);
        }
    }


    function checkAllSJ(e) {
        var checkboxes = $("input[name='chk-data[]']");
        if (e.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }

    const handleChooseData = async () => {
        const type = $("#showData .modal-title").html().split(" ")[1].toLowerCase();

        let arr_chk = [];
        var checkboxes = $("input[name='chk-data[]']");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true && !(checkboxes[i].disabled)) {
                arr_chk.push(checkboxes[i].value);
            }
        }

        if (arr_chk.length == 0) {
            alert("Pilih data yang akan dipilih");
        } else {
            const url = "<?= base_url('Kas_bank/getDataByChecked') ?>";

            let postData = new FormData();
            postData.append('id', arr_chk);
            postData.append('type', type);

            const request = await fetch(url, {
                method: 'POST',
                body: postData
            });

            const response = await request.json();

            initDataToRincian(response, type);
            $("#showData").modal('hide');
            arr_chk = [];
        }
    }

    const initDataToRincian = (response, type) => {

        let arrIdx = [];

        arrIdx = [];
        response.forEach(function(v, i) {
            let idx = $("#tableDataRincian tbody tr").length;
            arrIdx.push(idx);
            $("#tableDataRincian > tbody").append(`
                <tr>
                    <td>${v.tanggal} <input type="hidden" value="${type}, ${v.id}"></td>
                    <td>${v.no_aktivitas}</td>
                    <td>${numberFormat(v.nominal)}</td>
                    <td>
                        <input type="text" class="form-control numeric" ${(type === "penerimaan") || (type === "hutang") ?  "disabled" : ""} onkeyup="handleCountPenerimaan(event,'${idx}', '${v.nominal}')">
                    </td>
                    <td>
                        <input type="text" class="form-control numeric" ${(type === "pengiriman") || (type === "piutang") ? "disabled" : ""}  onkeyup="handleCountPengeluaran(event,'${idx}', '${v.nominal}')">
                    </td>
                    <td>
                        <input type="text" class="form-control" disabled id="sisaAktivitas_${idx}">
                    </td>
                    <td>
                        <select class="form-control rekening" name="rekening" id="rekening_${idx}" required></select>
                    </td>
                    <td>
                        <button type="button" class="deleteItem" style="border:none;background:transparent"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
                    </td>
                </tr>
            `);
        });


        fetch('<?= base_url('Kas_bank/getRekening'); ?>')
            .then(response => response.json())
            .then((result) => {
                $.each(arrIdx, function(i, v) {
                    let html = '';
                    html += "<option value=''>--Pilih Rekening--</option>";
                    result.forEach((value) => {
                        html += `<option value="${value.id}">${value.name}</option>`;
                    });
                    $(`#rekening_${v}`).append(html);
                })
            });
    }

    const handleCountPenerimaan = (event, idx, nominal) => {
        const valPenerimaan = event.currentTarget.value == "" ? 0 : parseFloat(event.currentTarget.value);
        $(`#sisaAktivitas_${idx}`).val(numberFormat(parseFloat(nominal) - valPenerimaan));
        countTotal()
    }

    const handleCountPengeluaran = (event, idx, nominal) => {
        const valPengeluaran = event.currentTarget.value == "" ? 0 : parseFloat(event.currentTarget.value);
        $(`#sisaAktivitas_${idx}`).val(numberFormat(parseFloat(nominal) - valPengeluaran));
        countTotal()
    }

    $(document).on("click", ".deleteItem", function() {
        $(this).parent().parent().remove();

        $("#tableDataRincian tbody tr").each(function(i, v) {
            let nominal = $(this).find("td:eq(2)")
            let penerimaan = $(this).find("td:eq(3) input[type='text']")
            let pengeluaran = $(this).find("td:eq(4) input[type='text']")
            let sisaAktivitas = $(this).find("td:eq(5) input[type='text']")
            let rekening = $(this).find("td:eq(6) input[type='text']")

            penerimaan.attr('onkeyup', `handleCountPenerimaan(event,'${i}', '${nominal.text().replace(/,/g, '')}')`)
            pengeluaran.attr('onkeyup', `handleCountPengeluaran(event,'${i}', '${nominal.text().replace(/,/g, '')}')`)
            sisaAktivitas.attr('id', `sisaAktivitas_${i}`)
            rekening.attr('id', `rekening_${i}`)
        });

        countTotal()
    });

    const handleCloseModalShowData = () => {
        $("#showData").modal('hide');
        $("#tableShowData > tbody").empty();
    }

    const handleSaveData = () => {

        let arrId = [];
        let arrTgl = [];
        let arrNomorAktivitas = []
        let arrNominal = [];
        let arrPenerimaan = [];
        let arrPengeluaran = [];
        let arrSisaAktivitas = [];
        let arrRekening = [];
        let finalDetailData = [];

        if ($("#tanggal").val() == "") {
            alert('Tanggal tidak boleh kosong!')
            $("#error").val("1");
            return false;
        } else {
            let countDataRincian = $("#tableDataRincian tbody tr").length;
            if (countDataRincian == 0) {
                alert('Rincian kas kosong! minimal ada 1 data yang terisi')
                $("#error").val("1");
                return false;
            } else {
                $("#tableDataRincian tbody tr").each(function(i, v) {
                    let id = $(this).find("td:eq(0) input[type='hidden']")
                    let tgl = $(this).find("td:eq(0)")
                    let nomorAktivitas = $(this).find("td:eq(1)")
                    let nominal = $(this).find("td:eq(2)")
                    let penerimaan = $(this).find("td:eq(3) input[type='text']")
                    let pengeluaran = $(this).find("td:eq(4) input[type='text']")
                    let sisaAktivitas = $(this).find("td:eq(5) input[type='text']")
                    let rekening = $(this).find("td:eq(6) select").children("option").filter(":selected");

                    if (!penerimaan.attr('disabled')) {
                        if (penerimaan.val() == "") {
                            alert('Penerimaan tidak boleh kosong!')
                            $("#error").val("1");
                            return false;
                        } else {
                            $("#error").val("0");
                        }
                    }

                    if (!pengeluaran.attr('disabled')) {
                        if (pengeluaran.val() == "") {
                            alert('Pengeluaran tidak boleh kosong!')
                            $("#error").val("1");
                            return false;
                        } else {
                            $("#error").val("0");
                        }
                    }

                    if (rekening.val() == "") {
                        alert('Rekening tidak boleh kosong!')
                        $("#error").val("1");
                        return false;
                    } else {
                        $("#error").val("0");
                    }

                    if ($("#error").val() == 0) {
                        id.map(function() {
                            arrId.push($(this).val());
                        }).get();

                        tgl.map(function() {
                            arrTgl.push($(this).text());
                        }).get();

                        nomorAktivitas.map(function() {
                            arrNomorAktivitas.push($(this).text());
                        }).get();

                        nominal.map(function() {
                            arrNominal.push(parseFloat($(this).text().replace(/,/g, '')));
                        }).get();

                        penerimaan.map(function() {
                            arrPenerimaan.push($(this).val());
                        }).get();

                        pengeluaran.map(function() {
                            arrPengeluaran.push($(this).val());
                        }).get();

                        sisaAktivitas.map(function() {
                            arrSisaAktivitas.push(parseFloat($(this).val().replace(/,/g, '')));
                        }).get();

                        rekening.map(function() {
                            arrRekening.push($(this).val());
                        }).get();
                    } else {
                        return false
                    }
                });
            }

        }

        if ($("#error").val() != 0) {
            return false;
        } else {
            if (arrId != null) {
                for (let index = 0; index < arrId.length; index++) {
                    finalDetailData.push({
                        id: arrId[index],
                        tgl: arrTgl[index],
                        nomorAktivitas: arrNomorAktivitas[index],
                        nominal: arrNominal[index],
                        penerimaan: arrPenerimaan[index],
                        pengeluaran: arrPengeluaran[index],
                        sisaAktivitas: arrSisaAktivitas[index],
                        rekening: arrRekening[index],
                    });
                }
            }

            const datas = {
                dataId,
                tgl: $("#tanggal").val(),
                noKasBank: $("#nomor_kas_bank").val(),
                keterangan: $("#keterangan").val(),
                totPenerimaan: parseFloat($("#penerimaan_sementara").val().replace(/,/g, '')),
                totPengeluaran: parseFloat($("#pengeluaran_sementara").val().replace(/,/g, '')),
                detailData: finalDetailData,
                type: "update"
            }

            $.ajax({
                url: "<?= base_url('Kas_bank/save'); ?>",
                type: "POST",
                data: datas,
                dataType: "JSON",
                success: function(response) {
                    if (response) {
                        location.href = "<?= base_url('Kas_bank') ?>"
                    } else {
                        alert('edit data gagal');
                    }
                }
            })

        }
    }
</script>