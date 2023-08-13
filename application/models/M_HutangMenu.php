<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_HutangMenu extends CI_Model
{

    public function getDataHutangMenu($dataPost)
    {

        $tglAwal = str_replace('-', '/', $dataPost->tanggalAwal);
        $tglAkhir = str_replace('-', '/', $dataPost->tanggalAkhir);

        $tglAwal2 = date('d/m/Y', strtotime($tglAwal));
        $tglAkhir2 = date('d/m/Y', strtotime($tglAkhir));

        $supplier = $dataPost->supplier != "all" ? "AND b.nama = '$dataPost->supplier'" : "";
        $rangeDate = $dataPost->tanggalAwal ? 'AND a.tanggal BETWEEN "' . $tglAwal2 . '" AND "' . $tglAkhir2 . '"' : "";

        return  $this->db->query("SELECT
                            b.nama AS supplier,
                            a.no_lpb as kode,
                            REPLACE(a.tanggal, '/', '-') as tanggal,
                            REPLACE(a.tanggal_jatuh_tempo, '/', '-') AS tanggal_jt,
                            a.total_harga AS nominal_hutang,
                            COALESCE(kbd.totNominal, 0) as nominal_pembayaran,
                            COALESCE(a.total_harga, 0) - COALESCE(kbd.totNominal, 0) as sisa_hutang
                        FROM penerimaan a  
                        LEFT JOIN supplier b
                            ON a.supplier = b.nama
                        LEFT JOIN (select id_penerimaan, COALESCE(SUM(pengeluaran),0) as totNominal, id_hutang 
                                    FROM kas_bank_detail 
                                    GROUP BY id_penerimaan, id_hutang) as kbd
                            ON a.id = kbd.id_penerimaan
                        WHERE a.jenis_transaksi = 'credit'
                            AND kbd.id_hutang is null
                            " . $supplier . " " . $rangeDate . "")->result();
    }
}
