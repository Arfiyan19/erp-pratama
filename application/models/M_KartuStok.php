<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_KartuStok extends CI_Model
{

    public function getKodeProduk()
    {
        return $this->db->select("kode")->from("produk")->order_by('kode', 'ASC')->get()->result();
    }

    public function getGudang()
    {
        return $this->db->select("kode, nama")->from("gudang")->order_by('kode', 'ASC')->get()->result();
    }

    public function getAllProduk()
    {
        return $this->db->query("SELECT produk.kode, produk.nama, produk.gudang, produk.kategori, 
                                    COALESCE(penerimaan.qty, 0) - COALESCE(pengiriman.qty, 0) as stok,
                                    produk.hpp, produk.jumlah
                                FROM produk
                                LEFT JOIN (SELECT kode, SUM(total_qty) as qty FROM penerimaan group by kode) as penerimaan
                                    ON produk.kode = penerimaan.kode
                                LEFT JOIN (SELECT kode, total, SUM(total_qty) as qty FROM pengiriman group by kode, total) as pengiriman
                                    ON produk.kode = pengiriman.kode;")->result();
    }

    public function getProdukByFilter($kode, $gudang)
    {
        return $this->db->query("SELECT produk.kode, produk.nama, produk.gudang, produk.kategori, 
                                    COALESCE(penerimaan.qty, 0) - COALESCE(pengiriman.qty, 0) as stok,
                                    produk.hpp, produk.jumlah
                                FROM produk
                                LEFT JOIN (SELECT kode, SUM(total_qty) as qty FROM penerimaan group by kode) as penerimaan
                                    ON produk.kode = penerimaan.kode
                                LEFT JOIN (SELECT kode, total, SUM(total_qty) as qty FROM pengiriman group by kode, total) as pengiriman
                                    ON produk.kode = pengiriman.kode
                                WHERE produk.kode = '$kode'")->result();
    }
}
