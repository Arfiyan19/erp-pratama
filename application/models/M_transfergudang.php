<?php

class M_transfergudang extends CI_Model
{
    public function tampil_data()
    {
        // return $this->db->get('tf_gudang')->result_array();
        return $this->db->select("a.id,a.tgl, a.no_transfer, a.keterangan, a.gudang_asal, a.gudang_tujuan, COALESCE(SUM(b.qty),0) as qty")
            ->from("tf_gudang a")
            ->join("tf_gudang_detail b", "a.no_transfer = b.no_transfer", "left")
            ->group_by("a.id,a.tgl, a.no_transfer, a.keterangan, a.gudang_asal, a.gudang_tujuan")->get()->result_array();
    }
    public function tambahDataTfGudang()
    {
        $no_transfer = $this->input->post('no_transfer', true);
        $data = [
            "tgl" => $this->input->post('tgl', true),
            "no_transfer" => $no_transfer,
            "keterangan" => $this->input->post('keterangan', true),
            "gudang_asal" => $this->input->post('gudang_asal', true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan', true),
            "kode_id" => $this->session->userdata('kode_id')
        ];

        $this->db->insert('tf_gudang', $data);

        foreach ($this->input->post('detailData') as $key => $value) {
            $dataDetailTf = [
                'no_transfer' => $no_transfer,
                'kode' => $value['kode'],
                'barang' => $value['barang'],
                'qty' => $value['qty'],
            ];

            $query = $this->db->insert('tf_gudang_detail', $dataDetailTf);
        }

        // $dataDetail = $this->db->select("kode, SUM(qty) as qty")->from('tf_gudang_detail')->where('no_transfer', $no_transfer)->group_by('kode')->get()->result();
        // foreach ($dataDetail as $key => $value) {
        //     //get qty in product
        //     $produk = $this->db->select('qty')->from('produk')->where('kode', $value->kode)->get()->row();

        //     $newQty = $value->qty + $produk->qty;

        //     //update new Qty in Produk
        //     $this->db->set('qty', $newQty);
        //     $this->db->where("kode", $value->kode);
        //     $query = $this->db->update('produk');
        // }


        return $query;
    }

    public function getAllGdg()
    {
        $this->db->select('nama');
        return $this->db->get('gudang')->result_array();
    }

    public function getLatestNoTf()
    {
        $this->db->select('no_transfer');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('tf_gudang')->row_array();
    }

    public function getTfGudangById($id)
    {
        return $this->db->get_where('tf_gudang', ['id' => $id])->row_array();
    }

    public function getTfGudangDetailById($id)
    {
        return $this->db->select("b.*")->from('tf_gudang a')
            ->join("tf_gudang_detail b", "a.no_transfer = b.no_transfer", "left")
            ->where("a.id", $id)->order_by('b.id', 'ASC')->get()->result();
    }

    public function hapusDataTfGudang($id)
    {


        $data = $this->db->select("no_transfer")->from("tf_gudang")->where("id", $id)->get()->row();

        $this->db->where('no_transfer', $data->no_transfer);
        $this->db->delete('tf_gudang_detail');

        $this->db->where('id', $id);
        return $this->db->delete('tf_gudang');

        // $sql = "DELETE b FROM tf_gudang a
        //         LEFT JOIN tf_gudang_detail b ON a.no_transfer = b.no_transfer
        //         WHERE a.id = '$id'";
        // return $this->db->query($sql);
    }
    public function ubahDataTfGudang()
    {
        $no_transfer = $this->input->post('no_transfer', true);
        $data = [
            "tgl" => $this->input->post('tgl', true),
            "no_transfer" => $no_transfer,
            "keterangan" => $this->input->post('keterangan', true),
            "gudang_asal" => $this->input->post('gudang_asal', true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan', true),
            "kode_id" => $this->session->userdata('kode_id')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tf_gudang', $data);

        //delete data detail by no transfer
        $this->db->where('no_transfer', $no_transfer);
        $this->db->delete('tf_gudang_detail');

        foreach ($this->input->post('detailData') as $key => $value) {
            $dataDetail = [
                'no_transfer' => $no_transfer,
                'kode' => $value['kode'],
                'barang' => $value['barang'],
                'qty' => $value['qty'],
            ];

            $query = $this->db->insert('tf_gudang_detail', $dataDetail);
        }

        return $query;
    }
}
