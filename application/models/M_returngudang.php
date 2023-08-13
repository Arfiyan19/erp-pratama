<?php

class M_returngudang extends CI_Model
{
    public function tampil_data()
    {
        // return $this->db->get('return_gudang')->result_array();
        return $this->db->select("a.id,a.tanggal, a.no_return, a.keterangan, a.gudang_asal, a.gudang_tujuan, COALESCE(SUM(b.jumlah),0) as jumlah")
            ->from("return_gudang a")
            ->join("return_gudang_detail b", "a.no_return = b.no_return", "left")
            ->group_by("a.id,a.tanggal, a.no_return, a.keterangan, a.gudang_asal, a.gudang_tujuan")->get()->result_array();
    }
    public function tambahDataReturn_gudang()
    {
        $no_return = $this->input->post('no_return', true);
        $data = [
            "tanggal" => $this->input->post('tgl', true),
            "no_return" => $no_return,
            "keterangan" => $this->input->post('keterangan', true),
            "gudang_asal" => $this->input->post('gudang_asal', true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan', true),
            "kode_id" => $this->session->userdata('kode_id')
        ];

        $this->db->insert('return_gudang', $data);

        foreach ($this->input->post('detailData') as $key => $value) {
            $dataDetail = [
                'no_return' => $no_return,
                'kode' => $value['kode'],
                'barang' => $value['barang'],
                'jumlah' => $value['jumlah'],
            ];

            $query = $this->db->insert('return_gudang_detail', $dataDetail);
        }

        return $query;
    }
    public function getReturn_gudangById($id)
    {
        return $this->db->get_where('return_gudang', ['id' => $id])->row_array();
    }

    public function getReturn_gudang_detailById($id)
    {
        return $this->db->select("b.*")->from('return_gudang a')
            ->join("return_gudang_detail b", "a.no_return = b.no_return", "left")
            ->where("a.id", $id)->order_by('b.id', 'ASC')->get()->result();
    }
    public function hapusDataReturn_gudang($id)
    {

        $data = $this->db->select("no_return")->from("return_gudang")->where("id", $id)->get()->row();

        $this->db->where('no_return', $data->no_return);
        $this->db->delete('return_gudang_detail');

        $this->db->where('id', $id);
        $this->db->delete('return_gudang');
    }
    public function ubahDataReturn_gudang()
    {

        $no_return = $this->input->post('no_return', true);
        $data = [
            "tanggal" => $this->input->post('tgl', true),
            "no_return" => $no_return,
            "keterangan" => $this->input->post('keterangan', true),
            "gudang_asal" => $this->input->post('gudang_asal', true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan', true),
            "kode_id" => $this->session->userdata('kode_id')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('return_gudang', $data);

        //delete data detail by no return
        $this->db->where('no_return', $no_return);
        $this->db->delete('return_gudang_detail');

        foreach ($this->input->post('detailData') as $key => $value) {
            $dataDetail = [
                'no_return' => $no_return,
                'kode' => $value['kode'],
                'barang' => $value['barang'],
                'jumlah' => $value['jumlah'],
            ];

            $query = $this->db->insert('return_gudang_detail', $dataDetail);
        }

        return $query;
    }

    public function getLatestNoTf()
    {
        $this->db->select('no_return');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('return_gudang')->row_array();
    }

    public function getAllGdg()
    {
        $this->db->select('nama');
        return $this->db->get('gudang')->result_array();
    }

    // public function cariDataKaryawan(){
    //     $keyword = $this->input->post('keyword',true);
    //     $this->db->like('nama',$keyword);
    //     $this->db->or_like('jabatan',$keyword);
    //     $this->db->or_like('alamat',$keyword);
    //     return $this->db->get('return_gudang')->result_array();
    // }
}
