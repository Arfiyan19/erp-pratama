<?php

class M_role_akses extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tbl_role')->result_array();
    }
    public function tambahDataRoleAkses()
    {
        $data = [
            "name" => $this->input->post('name', true),
            "description" => $this->input->post('description', true),

        ];
        $this->db->insert('tbl_role', $data);
    }


    public function hapusDataRoleAkses($id)
    {
        //kondisi 
        $this->db->where('id', $id);
        $this->db->delete('tbl_role');
    }

    public function getRoleAksesById($id)
    {
        return $this->db->get_where('tbl_role', ['id' => $id])->row_array();
    }

    public function ubahDataRoleAkses()
    {
        $data = [
            "name" => $this->input->post('name', true),
            "description" => $this->input->post('description', true),

        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_role', $data);
    }
}
