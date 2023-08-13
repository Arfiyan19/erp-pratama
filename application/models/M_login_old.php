<?php

class M_login extends CI_Model
{
    public function cek_login($where) {
      return $this->db->get_where('users', $where);
    }
    
    public function fetchSessData($username) {
      $this->db->select('gudang, jabatan, akun_simpanan');
      $this->db->from('daftarmitra');
      $this->db->where('nama', $username);
      
      return $this->db->get();
    }
      
}






