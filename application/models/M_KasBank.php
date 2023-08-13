<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_KasBank extends CI_Model
{


    public function getDataKasBank()
    {
        return $this->db->select("a.id, a.kode, a.tanggal, COALESCE(SUM(b.penerimaan),0) as penerimaan, COALESCE(SUM(b.pengeluaran),0) as pengeluaran")
            ->from("kas_bank a")
            ->join("kas_bank_detail b", "a.id = b.kas_bank_id", "left")
            ->group_by("a.kode, a.tanggal")->get()->result();
    }

    public function getLatestNoTf()
    {
        $this->db->select('kode');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('kas_bank')->row();
    }

    public function getDataPengiriman()
    {
        return $this->db->select("p.id, p.no_do as no_aktivitas, p.total_pengiriman as nominal, p.tanggal")
            ->from("pengiriman p")
            ->join("kas_bank_detail kbd", "p.id = kbd.id_pengiriman", "left")
            ->where("kbd.id_pengiriman", NULL)->get()->result();
    }

    public function getDataPengirimanById($id)
    {

        // $kode = $this->db->select("kode")->from('kas_bank')->where("id", $id)->get()->row();

        return $this->db->select("p.id, p.no_do as no_aktivitas, p.total_pengiriman as nominal, p.tanggal")
            ->from("pengiriman p")
            ->join("kas_bank_detail kbd", "p.id = kbd.id_pengiriman", "left")
            ->where("kbd.id_pengiriman", NULL)
            ->or_where("kbd.kas_bank_id", $id)
            ->get()->result();
    }

    public function getDataPenerimaan()
    {
        return $this->db->select("p.id, p.total_harga as nominal, p.tanggal, p.no_lpb as no_aktivitas")
            ->from("penerimaan p")
            ->join("kas_bank_detail kbd", "p.id = kbd.id_penerimaan", "left")
            ->where("kbd.id_penerimaan", NULL)->get()->result();
    }

    public function getDataPenerimaanById($id)
    {

        // $kode = $this->db->select("kode")->from('kas_bank')->where("id", $id)->get()->row();

        return $this->db->select("p.id, p.total_harga as nominal, p.tanggal, p.no_lpb as no_aktivitas")
            ->from("penerimaan p")
            ->join("kas_bank_detail kbd", "p.id = kbd.id_penerimaan", "left")
            ->where("kbd.id_penerimaan", NULL)
            ->or_where("kbd.kas_bank_id", $id)
            ->get()->result();
    }

    public function getDataPiutang()
    {
        return $this->db->query("SELECT p.id, p.no_do as no_aktivitas, COALESCE(p.total_pengiriman,0 ) - COALESCE(kbd.totNominal, 0) as nominal, p.tanggal
                                FROM pengiriman p
                                left join (select id_pengiriman, COALESCE(SUM(penerimaan),0) as totNominal from kas_bank_detail group by id_pengiriman) as kbd
                                    ON p.id = kbd.id_pengiriman
                                WHERE p.jenis_transaksi = 'kredit'
                                ")->result();
    }

    public function getDataPiutangById($id)
    {

        return $this->db->query("SELECT  p.id, p.no_do as no_aktivitas, COALESCE(p.total_pengiriman,0 ) - COALESCE(kbd.totNominal, 0) as nominal, p.tanggal
                                FROM pengiriman p
                                left join (select kas_bank_id,id_pengiriman, COALESCE(SUM(penerimaan),0) as totNominal from kas_bank_detail group by kas_bank_id,id_pengiriman) as kbd
                                    ON p.id = kbd.id_pengiriman
                                WHERE p.jenis_transaksi = 'kredit'
                                    OR kbd.kas_bank_id = '$id'
                                ")->result();
    }

    public function getDataHutang()
    {
        return $this->db->query("SELECT p.id, p.tanggal, p.no_lpb as no_aktivitas, COALESCE(p.total_harga,0 ) - COALESCE(kbd.totNominal, 0) as nominal
                                FROM penerimaan p
                                left join (select id_penerimaan, COALESCE(SUM(pengeluaran),0) as totNominal from kas_bank_detail group by id_penerimaan) as kbd
                                    ON p.id = kbd.id_penerimaan
                                WHERE p.jenis_transaksi = 'credit'
                                ")->result();
    }

    public function getDataHutangById($id)
    {

        return $this->db->query("SELECT p.id, p.tanggal, p.no_lpb as no_aktivitas, COALESCE(p.total_harga,0 ) - COALESCE(kbd.totNominal, 0) as nominal
                                FROM penerimaan p
                                left join (select kas_bank_id,id_penerimaan, COALESCE(SUM(pengeluaran),0) as totNominal from kas_bank_detail group by kas_bank_id,id_penerimaan) as kbd
                                    ON p.id = kbd.id_penerimaan
                                WHERE p.jenis_transaksi = 'credit'
                                    OR kbd.kas_bank_id = '$id'
                                ")->result();
    }

    public function getDataByChecked($id, $type)
    {

        $params = [];
        $idx = explode(",", $id);
        for ($i = 0; $i < count($idx); $i++) {
            $params[$i] = "'" . $idx[$i] . "'";
        }

        if ($type == "pengiriman") {
            return $this->db->select("id, no_do as no_aktivitas, total_pengiriman as nominal, tanggal")
                ->from("pengiriman")->where_in('id', explode(',', $id))->get()->result();
        }

        if ($type == "penerimaan") {
            return $this->db->select("id, total_harga as nominal, tanggal, no_lpb as no_aktivitas")
                ->from("penerimaan")->where_in('id', explode(',', $id))->get()->result();
        }

        if ($type == "piutang") {

            return $this->db->query("SELECT p.id, p.no_do as no_aktivitas, COALESCE(p.total_pengiriman,0 ) - COALESCE(kbd.totNominal, 0) as nominal, p.tanggal
                                FROM pengiriman p
                                left join (select id_pengiriman, COALESCE(SUM(penerimaan),0) as totNominal from kas_bank_detail group by id_pengiriman) as kbd
                                    ON p.id = kbd.id_pengiriman
                                WHERE p.id in(" . implode(",", $params) . ")")->result();
        }

        if ($type == "hutang") {

            $data =  $this->db->query("SELECT p.id, p.tanggal, p.no_lpb as no_aktivitas, COALESCE(p.total_harga,0 ) - COALESCE(kbd.totNominal, 0) as nominal
                                FROM penerimaan p
                                left join (select id_penerimaan, COALESCE(SUM(pengeluaran),0) as totNominal from kas_bank_detail group by id_penerimaan) as kbd
                                    ON p.id = kbd.id_penerimaan
                                WHERE p.id in(" . implode(",", $params) . ")")->result();

            $finalData = [];

            foreach ($data as $key => $value) {
                $tgl = str_replace('/', '-', $value->tanggal);
                $newDate = date("Y-m-d", strtotime($tgl));
                array_push($finalData, [
                    'id' => $value->id,
                    'tanggal' => $newDate,
                    'no_aktivitas' => $value->no_aktivitas,
                    'nominal' => $value->nominal,
                ]);
            }

            return $finalData;
        }
    }

    public function save($dataId, $tgl, $noKasBank, $keterangan, $totPenerimaan, $totPengeluaran, $detailData, $type)
    {
        $this->db->trans_begin();

        if ($type == "create") {
            //insert to header
            $dataheader = [
                'kode' => $noKasBank,
                'tanggal' => $tgl,
                'keterangan' => $keterangan == "" ? NULL : $keterangan,
                'total_penerimaan' => $totPenerimaan,
                'total_pengeluaran' => $totPengeluaran,
            ];

            $this->db->insert('kas_bank', $dataheader);
            $kas_bank_id = $this->db->insert_id();

            //insert to detail
            foreach ($detailData as $key => $value) {
                $type = explode(",", $value['id']);

                $idPenerimaan = $type[0] == "penerimaan" ? $type[1] : NULL;
                $idPengiriman = $type[0] == "pengiriman" ? $type[1] : NULL;
                $idPiutang = $type[0] == "piutang" ? $type[1] : NULL;
                $idHutang = $type[0] == "hutang" ? $type[1] : NULL;

                $dataDetail = [
                    'kas_bank_id' => $kas_bank_id,
                    'tanggal' => preg_replace('/\s+/', '', $value['tgl']),
                    'nomor_aktivitas' => $value['nomorAktivitas'],
                    'nominal_aktivitas' => $value['nominal'],
                    'sisa_aktivitas' => $value['sisaAktivitas'],
                    'penerimaan' => $value['penerimaan'] == "" ? NULL : $value['penerimaan'],
                    'pengeluaran' => $value['pengeluaran'] == "" ? NULL : $value['pengeluaran'],
                    'rekening_id' => $value['rekening'],
                    'id_pengiriman' => $idPengiriman,
                    'id_penerimaan' => $idPenerimaan,
                    'id_piutang' => $idPiutang,
                    'id_hutang' => $idHutang,
                ];

                $this->db->insert('kas_bank_detail', $dataDetail);
            }
        }

        if ($type == "update") {
            $dataheader = [
                "tanggal" => $tgl,
                "keterangan" => $keterangan == "" ? NULL : $keterangan,
                "total_penerimaan" => $totPenerimaan,
                "total_pengeluaran" => $totPengeluaran,
            ];

            $this->db->where('id', $dataId);
            $this->db->update('kas_bank', $dataheader);

            //delete data detail by no return
            $this->db->where('kas_bank_id', $dataId);
            $this->db->delete('kas_bank_detail');

            foreach ($detailData as $key => $value) {
                $type = explode(",", $value['id']);

                $idPenerimaan = $type[0] == "penerimaan" ? $type[1] : NULL;
                $idPengiriman = $type[0] == "pengiriman" ? $type[1] : NULL;
                $idPiutang = $type[0] == "piutang" ? $type[1] : NULL;
                $idHutang = $type[0] == "hutang" ? $type[1] : NULL;

                $dataDetail = [
                    'kas_bank_id' => $dataId,
                    'tanggal' => $value['tgl'],
                    'nomor_aktivitas' => $value['nomorAktivitas'],
                    'nominal_aktivitas' => $value['nominal'],
                    'sisa_aktivitas' => $value['sisaAktivitas'],
                    'penerimaan' => $value['penerimaan'] == "" ? NULL : $value['penerimaan'],
                    'pengeluaran' => $value['pengeluaran'] == "" ? NULL : $value['pengeluaran'],
                    'rekening_id' => $value['rekening'],
                    'id_pengiriman' => $idPengiriman,
                    'id_penerimaan' => $idPenerimaan,
                    'id_piutang' => $idPiutang,
                    'id_hutang' => $idHutang,
                ];

                $this->db->insert('kas_bank_detail', $dataDetail);
            }
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function getDataDetailById($id)
    {
        return $this->db->select("b.*")->from("kas_bank a")->join("kas_bank_detail b", "a.id = b.kas_bank_id", "left")->where("a.id", $id)->get()->result();
    }

    public function delete($id)
    {
        // $data = $this->db->select("kode")->from("kas_bank")->where("id", $id)->get()->row();

        $this->db->where('kas_bank_id', $id);
        $this->db->delete('kas_bank_detail');

        $this->db->where('id', $id);
        $this->db->delete('kas_bank');
    }
}
