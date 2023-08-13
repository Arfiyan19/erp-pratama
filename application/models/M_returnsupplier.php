<?php

class M_returnsupplier extends CI_Model{
    public function tampil_data(){
        return $this->db->get('return_supplier')->result_array();
    }

    public function getLatestNoReturn() {
        $this->db->select('no_return');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('return_supplier')->row_array();
    }

    public function tambahDataReturn_supplier(){
        $data = [
            "tanggal" => $this->input->post('tgl_returnsuppl'),
            "no_return" => $this->input->post('no_return_returnsuppl'),
            "keterangan" => $this->input->post('keterangan_returnsuppl'),
            "jenis_kendaraan" => $this->input->post('jenis_kendaraan_returnsuppl'),
            "no_polisi" => $this->input->post('no_polisi_returnsuppl'),
            "nama_driver" => $this->input->post('nama_driver_returnsuppl'),
            "nama_expedisi" => $this->input->post('nama_expedisi_returnsuppl'),
            "kode" => $this->input->post('kode_returnsuppl'),
            "barang" => $this->input->post('barang_returnsuppl'),
            "gudang_asal" => $this->input->post('gudang_asal_returnsuppl'),
            "supplier_tujuan" => $this->input->post('supplier_tujuan_returnsuppl'),
            "jumlah" => $this->input->post('qty_returnsuppl'),
            "kode_id" => $this->session->userdata('kode_id')
        ];
        $this->db->insert('return_supplier',$data);
    }
    public function getReturn_supplierById($id){
        return $this->db->get_where('return_supplier',['id'=>$id])->row_array();
    }
    public function hapusDataReturn_supplier($id){
        $this->db->where('id',$id);
        $this->db->delete('return_supplier');
    }
    public function ubahDataReturn_supplier(){
        $data = [
            "tanggal" => $this->input->post('tgl_returnsuppl'),
            "no_return" => $this->input->post('no_return_returnsuppl'),
            "keterangan" => $this->input->post('keterangan_returnsuppl'),
            "jenis_kendaraan" => $this->input->post('jenis_kendaraan_returnsuppl'),
            "no_polisi" => $this->input->post('no_polisi_returnsuppl'),
            "nama_driver" => $this->input->post('nama_driver_returnsuppl'),
            "nama_expedisi" => $this->input->post('nama_expedisi_returnsuppl'),
            "kode" => $this->input->post('kode_returnsuppl'),
            "barang" => $this->input->post('barang_returnsuppl'),
            "gudang_asal" => $this->input->post('gudang_asal_returnsuppl'),
            "supplier_tujuan" => $this->input->post('supplier_tujuan_returnsuppl'),
            "jumlah" => $this->input->post('qty_returnsuppl'),
            "kode_id" => $this->session->userdata('kode_id')
        ];
        $this->db->where('id',$this->input->post('id_returnsuppl'));
        $this->db->update('return_supplier',$data);
    }
    // public function cariDataKaryawan(){
    //     $keyword = $this->input->post('keyword',true);
    //     $this->db->like('nama',$keyword);
    //     $this->db->or_like('jabatan',$keyword);
    //     $this->db->or_like('alamat',$keyword);
    //     return $this->db->get('return_supplier')->result_array();
    // }
}