<?php

class M_pendapatanlain extends CI_Model{
    public function tampil_data(){
        return $this->db->get('pendapatanlain')->result_array();
    }
    public function filter($data){
        $this->db->where('tgl >=', $data['tanggal']);
		$this->db->where('tgl <=', $data['tanggal_sampai']);
        
        return $this->db->get_where('pendapatanlain')->result_array();
    }
    public function getcoaByPendapatanId($id){
        $this->db->where('pendapatanlain_id', $id);
        return $this->db->get('pendapatanlain_akun_transaksi')->result_array();
    }
    public function tambahDataPendapatan(){
        $data = [
            "tgl" => $this->input->post('tgl',true),
            "rekening" => $this->input->post('rekening',true),
            "no_faktur" => $this->input->post('no_faktur',true),
            "kode_jurnal" => $this->input->post('kode_jurnal',true),
            "jumlah_total" => $this->input->post('jumlah_total',true)
        ];
        $this->db->insert('pendapatanlain',$data);
    }
    public function tambahDataPendapatanAkun($data){

        $this->db->insert('pendapatanlain_akun_transaksi',$data);
    }
    public function cekkodependapatan()
    {
        $query = $this->db->query("SELECT MAX(no_faktur) as no_faktur from pendapatanlain");
        $hasil = $query->row();
        return $hasil->no_faktur;
    }
    public function getPendapatanById($id){
        return $this->db->get_where('pendapatanlain',['id'=>$id])->row_array();
    }
    public function hapusDataPendapatan($id){
        $this->db->where('id',$id);
        $this->db->delete('pendapatanlain');
    }
    public function hapusDataPendapatanAkunByPendapatanId($id){
        $this->db->where('pendapatanlain_id',$id);
        $this->db->delete('pendapatanlain_akun_transaksi');
    }
    public function ubahDataPendapatan(){
        $data = [
            "tgl" => $this->input->post('tgl',true),
            "rekening" => $this->input->post('rekening',true),
            "no_faktur" => $this->input->post('no_faktur',true),
            "kode_jurnal" => $this->input->post('kode_jurnal',true),
            "jumlah_total" => $this->input->post('jumlah_total',true)
        ];
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('pendapatanlain',$data);
    }
    public function cariDataKaryawan(){
        $keyword = $this->input->post('keyword',true);
        $this->db->like('nama',$keyword);
        $this->db->or_like('jabatan',$keyword);
        $this->db->or_like('alamat',$keyword);
        return $this->db->get('pendapatanlain')->result_array();
    }
}