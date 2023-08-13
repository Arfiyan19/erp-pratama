<?php

class Tahun extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Tahun');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Tahun';
        $data['tahun'] = $this->M_Tahun->tampil_data();
        $this->load->view('templates/header',$topik);
        $this->load->view('tahun/index',$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Tahun';

        $this->form_validation->set_rules('year','Year','required');
        $this->form_validation->set_rules('is_active','Is Active','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('tahun/tambah');
        }else {
            $this->M_Tahun->tambahDataTahun();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('tahun');
        }
        
    }
    public function hapus($id){
        $this->M_Tahun->hapusDataTahun($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('tahun');

    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Dosen';
        $data['tahun'] = $this->M_Tahun->getTahunById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];
       
        $this->form_validation->set_rules('year','Year','required');
        $this->form_validation->set_rules('is_active','Is Active','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$topik);
            $this->load->view('tahun/edit',$data);
        }else {
            $this->M_Tahun->ubahDataTahun();
            $this->session->set_flashdata('flash','Diubah');
            redirect('tahun');
        }
    }
}
