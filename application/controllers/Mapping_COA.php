<?php

class Mapping_COA extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_mapping_coa');
        $this->load->model('M_account');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Mapping COA';
        $data['mapping_coa'] = $this->M_mapping_coa->tampil_data();
        foreach ($data['mapping_coa'] as $key => $value) {
            $data['mapping_coa'][$key]['akun'] = $this->M_account->getDataById($value['id_coa']);
            $data['mapping_coa'][$key]['akun_1'] = $this->M_account->getDataById($value['id_coa_1']);
            $data['mapping_coa'][$key]['akun_2'] = $this->M_account->getDataById($value['id_coa_2']);
            $data['mapping_coa'][$key]['akun_3'] = $this->M_account->getDataById($value['id_coa_3']);
        }
        $this->load->view('templates/header',$topik);
        $this->load->view('mapping_coa/index',$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Mapping COA';
        $data['akun'] = $this->M_account->tampil_data("up");
        
        $this->form_validation->set_rules('id_coa','Kode Akun','required');
        $this->form_validation->set_rules('id_coa_1','Mapping Kode Akun 1','required');
        $this->form_validation->set_rules('id_coa_2','Mapping Kode Akun 2','required');
        $this->form_validation->set_rules('id_coa_3','Mapping Kode Akun 3','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('mapping_coa/tambah');
        }else {
            $this->M_mapping_coa->tambahDataMappingCOA();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('mapping_coa');
        }
        
    }
    public function hapus($id){
        $this->M_mapping_coa->hapusDataMappingCOA($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('mapping_coa');

    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Dosen';
        $data['mapping_coa'] = $this->M_mapping_coa->getMappingCOAById($id);
        $data['akun'] = $this->M_account->tampil_data("up");

        $this->form_validation->set_rules('id_coa','Kode Akun','required');
        $this->form_validation->set_rules('id_coa_1','Mapping Kode Akun 1','required');
        $this->form_validation->set_rules('id_coa_2','Mapping Kode Akun 2','required');
        $this->form_validation->set_rules('id_coa_3','Mapping Kode Akun 3','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$topik);
            $this->load->view('mapping_coa/edit',$data);
        }else {
            $this->M_mapping_coa->ubahDataMappingCOA();
            $this->session->set_flashdata('flash','Diubah');
            redirect('mapping_coa');
        }
    }
}
