<?php

class M_user extends CI_Model{
    public function tampil_data(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('tbl_role', 'users.id_role = tbl_role.id');
        $query = $this->db->get();
        return $query;

    }
	
	function tampil_data1(){
    $username=$this->session->userdata("username");
     $this->db->where('username',"$username");
	  $this->db->select('*');
	 $this->db->from('users');
	 $query = $this->db->get();
	 return $query->result_array();
	}
	
    public function getRole()
    {
        $query = $this->db->get_where('tbl_role', ['name'])->result();
        return $query;
    }

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	function tampil_data2(){
    $username=$this->session->userdata("username");
     $this->db->where('username',"$username");
	  $this->db->select('*');
	 $this->db->from('users');
	 $this->db->limit(1);
	 $query = $this->db->get();
	 return $query->result_array();
	}
	
    public function tambahDataUser(){

            $data = [
                "first_name" => $this->input->post('firstname',true),
                "last_name" => $this->input->post('lastname',true),
                "username" => $this->input->post('username',true),
                "email" => $this->input->post('email',true),
                'password'=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                // "password" => $this->input->post('password',true),
                "kode_id" => $this->input->post('kode_id',true),
                "id_role" => $this->input->post('id_role',true),
                "created_at" => date('Y-m-d H:i:s')
            ];

        $this->db->insert('users', $data);
    }

    public function getUserById($id){
     return $this->db->get_where('users',['id'=>$id])->row_array();
    }

    public function hapusDataUser($id){
        $this->db->where('id',$id);
        $this->db->delete('users');
    }

     public function ubahDataUser(){
        $data = [
           "username" => $this->input->post('username',true),
            "email" => $this->input->post('email',true),
            "password" => $this->input->post('password',true),
			"kode_id" => $this->input->post('kode_id',true),
			"id_role" => $this->input->post('id_role',true),

        ];
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('users',$data);
     }
     
    public function aktivasiUser($kode_id) {
        $this->db->select('username, activated');
        $active = $this->db->get_where('users', ['kode_id' => $kode_id])->row_array();
        
        $this->db->where('kode_id', $kode_id);
        if ($active['activated'] == 1) {
            $this->db->update('users', ['activated' => 0]);
            return [$active['username'], 0];
        } else {
            $this->db->update('users', ['activated' => 1]);
            return [$active['username'], 1];
        }
    }
}