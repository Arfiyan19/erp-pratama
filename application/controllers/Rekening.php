<?php

class Rekening extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Rekening');
        $this->load->model('M_account');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Rekening';
        $data['rekening'] = $this->M_Rekening->tampil_data();
        foreach ($data['rekening'] as $key => $value) {
            $data['rekening'][$key]['nama_akun'] = $this->M_account->getDataById($value['id_chartofaccount']);
        }
        $this->load->view('templates/header',$topik);
        $this->load->view('rekening/index',$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Rekening';
        $data['akun'] = $this->M_account->tampil_data("up");
        
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('id_chartofaccount','No Akun','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('rekening/tambah');
        }else {
            $this->M_Rekening->tambahDataRekening();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('rekening');
        }
        
    }
    public function hapus($id){
        $this->M_Rekening->hapusDataRekening($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('rekening');

    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Dosen';
        $data['rekening'] = $this->M_Rekening->getRekeningById($id);
        $data['akun'] = $this->M_account->tampil_data("up");
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];
       
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('id_chartofaccount','No Akun','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$topik);
            $this->load->view('rekening/edit',$data);
        }else {
            $this->M_Rekening->ubahDataRekening();
            $this->session->set_flashdata('flash','Diubah');
            redirect('rekening');
        }
    }
}
