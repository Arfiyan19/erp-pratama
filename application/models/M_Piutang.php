<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Piutang extends CI_Model
{

    public function getDataPiutang($dataPost)
    {
        $mitra = $dataPost->mitra != "all" ? "AND b.id = '$dataPost->mitra'" : "";
        $rangeDate = $dataPost->tanggalAwal ? 'AND a.tanggal BETWEEN "' . $dataPost->tanggalAwal . '" AND "' . $dataPost->tanggalAkhir . '"' : "";

        return  $this->db->query("SELECT
                            b.name AS mitra,
                            a.no_do as kode,
                            a.tanggal,
                            a.tanggal_jt,
                            a.total_pengiriman AS nominal_piutang,
                            COALESCE(kbd.totNominal, 0) as nominal_pembayaran,
                            COALESCE(a.total_pengiriman, 0) - COALESCE(kbd.totNominal, 0) as sisa_piutang
                        FROM pengiriman a  
                        LEFT JOIN daftar_mitra b
                            ON a.kode_id = b.kode
                        LEFT JOIN (select id_pengiriman, COALESCE(SUM(penerimaan),0) as totNominal, id_piutang 
                                    FROM kas_bank_detail 
                                    GROUP BY id_pengiriman, id_piutang) as kbd
                            ON a.id = kbd.id_pengiriman
                        WHERE a.jenis_transaksi = 'kredit'
                            AND kbd.id_piutang is null
                            " . $mitra . " " . $rangeDate . "")->result();
    }
}
