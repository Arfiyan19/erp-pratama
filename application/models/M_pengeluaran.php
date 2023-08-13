<?php

class M_pengeluaran extends CI_Model{
    public function tampil_data(){
        return $this->db->get('pengeluaran')->result_array();
    }
	
    public function filter($data){
        $this->db->where('tgl >=', $data['tanggal']);
		$this->db->where('tgl <=', $data['tanggal_sampai']);
        
        return $this->db->get_where('pengeluaran')->result_array();
    }

	function tampil_data1(){
    $username=$this->session->userdata("username");
     $this->db->where('users.username',"$username");
	  $this->db->select('pengeluaran.id,pengeluaran.tgl,pengeluaran.uraian,pengeluaran.reff,pengeluaran.batasan,pengeluaran.jumlah,pengeluaran.no_akun,pengeluaran.kode_id');
	 $this->db->from('users');
	 $this->db->join('pengeluaran','pengeluaran.kode_id=users.kode_id');
	 $query = $this->db->get();
	 return $query->result_array();
	}
	
    public function tambahDataPengeluaran($data){
        
        $this->db->insert('pengeluaran',$data);
    }

    public function tambahDataPengeluaranAkun($data){
        $this->db->insert('pengeluaran_akun_transaksi',$data);
    }
    public function hapusAkunDataPengeluaran($pengeluaranid){
        $this->db->where('pengeluaran_id',$pengeluaranid);
        $this->db->delete('pengeluaran_akun_transaksi');
    }
    public function getPengeluaranById($id){
        return $this->db->get_where('pengeluaran',['id'=>$id])->row_array();
    }
    public function getAkunPengeluaran($pengeluaranid){
        return $this->db->get_where('pengeluaran_akun_transaksi',['pengeluaran_id'=>$pengeluaranid])->result_array();
    }
    public function hapusDataPengeluaran($id){
        $this->db->where('id',$id);
        $this->db->delete('pengeluaran');
    }
    public function ubahDataPengeluaran($data){
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('pengeluaran',$data);
    }
    // public function cariDataKaryawan(){
    //     $keyword = $this->input->post('keyword',true);
    //     $this->db->like('nama',$keyword);
    //     $this->db->or_like('jabatan',$keyword);
    //     $this->db->or_like('alamat',$keyword);
    //     return $this->db->get('pendapatanlain')->result_array();
    // }
}