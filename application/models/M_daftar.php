<?php

class M_daftar extends CI_Model
{
    public $kode;
    // public $nama_daftar_mitra;
    public function tampil_mitra()
    {
        return $this->db->get('daftarmitra')->result_array();
    }

    public function tampil_data_mitra($gudang, $username)
    {
        $this->db->select('*');
        $this->db->from('daftar_mitra');
        $this->db->where('gudang', $gudang);
        $this->db->where('name !=', $username);
        return $this->db->get()->result_array();
    }

    public function tampil_data()
    {
        $query = $this->db->query('SELECT * FROM `daftar_mitra` LEFT JOIN `users` ON daftar_mitra.kode  = users.kode_id');
        return $query;
    }

    public function tampil_promoter()
    {
        return $this->db->get('daftar_mitra')->result_array();
    }

    public function tampil_gudang()
    {
        return $this->db->get('gudang')->result_array();
    }

    public function tampil_jabatan()
    {
        return $this->db->get('jabatan_mitra')->result_array();
    }
    // public function cekkodedaftar_mitra()
    // {
    //     $query = $this->db->query("SELECT MAX(kode_barang) as kodebarang from barang");
    //     $hasil = $query->row();
    //     return $hasil->kodebarang;
    // }
    public function cekkodedaftar_mitra()
    { {
            $query = $this->db->query("SELECT MAX(kode) as kode from daftar_mitra");
            $hasil = $query->row();
            return $hasil->kode;
        }
    }

    public function tambahDataMitra()
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "name" => $this->input->post('name', true),
            "tgl_lahir" => $this->input->post('tgl_lahir', true),
            "jabatan" => $this->input->post('jabatan', true),
            "promoter" => $this->input->post('promoter', true),
            "thn_gabung" => $this->input->post('thn_gabung', true),
            "gudang" => $this->input->post('gudang', true),
            "alamat" => $this->input->post('alamat', true),
            "kota" => $this->input->post('kota', true),
            "telepon" => $this->input->post('telepon', true),
            "email" => $this->input->post('email', true)

        ];
        $this->db->insert('daftar_mitra', $data);
    }

    public function getdaftar_mitraById($id)
    {
        return $this->db->get_where('daftar_mitra', ['id' => $id])->row_array();
    }

    public function getUsername()
    {
        $query = $this->db->query('SELECT `username` FROM daftar_mitra RIGHT JOIN users ON daftar_mitra.kode = users.kode_id')->row();
        return $query;
    }

    public function hapusDatadaftar_mitra($id){
        $this->db->where('id',$id);
        $this->db->delete('daftar_mitra');
    }

    public function ubahDatadaftar_mitra()
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true),
            "telepon" => $this->input->post('telepon', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('daftar_mitra', $data);
    }

    public function cariDatadaftar_mitra()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('kode', $keyword);
        $this->db->or_like('nama', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('telepon', $keyword);
        return $this->db->get('daftar_mitra')->result_array();
    }
}
