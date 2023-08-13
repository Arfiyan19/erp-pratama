<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_AdjustStok extends CI_Model
{

    public function getDataAdjust()
    {
        // return $this->db->query("SELECT produk.kode, produk.nama, produk.gudang, produk.kategori, 
        //                             COALESCE(penerimaan.qty, 0) - COALESCE(pengiriman.qty, 0) + COALESCE(adjust_stok_detail.qty, 0) as stok,
        //                             produk.hpp, produk.jumlah
        //                         FROM adjust_stok
        //                         LEFT JOIN (SELECT kode, no_penyesuaian, SUM(qty) as qty FROM adjust_stok_detail group by kode, no_penyesuaian) as adjust_stok_detail
        //                             ON adjust_stok.no_penyesuaian = adjust_stok_detail.no_penyesuaian
        //                         LEFT JOIN produk
        //                             ON adjust_stok_detail.kode = produk.kode
        //                         LEFT JOIN (SELECT kode, SUM(total_qty) as qty FROM penerimaan group by kode) as penerimaan
        //                             ON produk.kode = penerimaan.kode
        //                         LEFT JOIN (SELECT kode, total, SUM(total_qty) as qty FROM pengiriman group by kode, total) as pengiriman
        //                             ON produk.kode = pengiriman.kode;")->result_array();

        return $this->db->select("a.id,a.tgl, a.no_penyesuaian, a.keterangan, a.gudang_asal, a.gudang_tujuan, COALESCE(SUM(b.qty),0) as qty")
            ->from("adjust_stok a")
            ->join("adjust_stok_detail b", "a.no_penyesuaian = b.no_penyesuaian", "left")
            ->group_by("a.id,a.tgl, a.no_penyesuaian, a.keterangan, a.gudang_asal, a.gudang_tujuan")->get()->result_array();
    }

    public function getLatestNoTf()
    {
        $this->db->select('no_penyesuaian');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('adjust_stok')->row_array();
    }

    public function tambahDataStok_akhir()
    {
        $no_penyesuaian = $this->input->post('no_penyesuaian', true);
        $data = [
            "tgl" => $this->input->post('tgl', true),
            "no_penyesuaian" => $no_penyesuaian,
            "keterangan" => $this->input->post('keterangan', true),
            "gudang_asal" => $this->input->post('gudang_asal', true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan', true),
            "kode_id" => $this->session->userdata('kode_id')
        ];

        $this->db->insert('adjust_stok', $data);

        foreach ($this->input->post('detailData') as $key => $value) {
            $dataDetail = [
                'no_penyesuaian' => $no_penyesuaian,
                'kode' => $value['kode'],
                'barang' => $value['barang'],
                'qty' => $value['qty'],
                'kondisi' => $value['kondisi'],
            ];

            $query = $this->db->insert('adjust_stok_detail', $dataDetail);
        }

        return $query;
    }

    public function getAllGdg()
    {
        $this->db->select('nama');
        return $this->db->get('gudang')->result_array();
    }

    public function getAdjustById($id)
    {
        return $this->db->get_where('adjust_stok', ['id' => $id])->row_array();
    }

    public function getAdjustDetailById($id)
    {
        return $this->db->select("b.*")->from('adjust_stok a')
            ->join("adjust_stok_detail b", "a.no_penyesuaian = b.no_penyesuaian", "left")
            ->where("a.id", $id)->order_by('b.id', 'ASC')->get()->result();
    }

    public function ubahDataAdjustStok()
    {

        $no_penyesuaian = $this->input->post('no_penyesuaian', true);
        $data = [
            "tgl" => $this->input->post('tgl', true),
            "no_penyesuaian" => $no_penyesuaian,
            "keterangan" => $this->input->post('keterangan', true),
            "gudang_asal" => $this->input->post('gudang_asal', true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan', true),
            "kode_id" => $this->session->userdata('kode_id')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('adjust_stok', $data);

        //delete data detail by no return
        $this->db->where('no_penyesuaian', $no_penyesuaian);
        $this->db->delete('adjust_stok_detail');

        foreach ($this->input->post('detailData') as $key => $value) {
            $dataDetail = [
                'no_penyesuaian' => $no_penyesuaian,
                'kode' => $value['kode'],
                'barang' => $value['barang'],
                'qty' => $value['qty'],
                'kondisi' => $value['kondisi'],
            ];

            $query = $this->db->insert('adjust_stok_detail', $dataDetail);
        }

        return $query;
    }

    public function hapusDataAdjustStok($id)
    {

        $data = $this->db->select("no_penyesuaian")->from("adjust_stok")->where("id", $id)->get()->row();

        $this->db->where('no_penyesuaian', $data->no_penyesuaian);
        $this->db->delete('adjust_stok_detail');

        $this->db->where('id', $id);
        $this->db->delete('adjust_stok');
    }
}
