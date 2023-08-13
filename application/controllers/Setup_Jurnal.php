<?php

class Setup_Jurnal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_setup_jurnal');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu Setup Jurnal';
        $data['setup_jurnal'] = $this->M_setup_jurnal->tampil_data();
        $this->load->view('templates/header', $topik);
        $this->load->view('setup_jurnal/index', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Setup Jurnal';

        $dataSetupJurnal = [
            "kode_jurnal" => $this->input->post('kode_jurnal', true),
            "formulir" => $this->input->post('formulir', true),
            "tabulasi" => $this->input->post('tabulasi', true),
            "keterangan" => $this->input->post('keterangan', true)
        ];

        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $this->load->view('templates/header', $data);
            $this->load->view('setup_jurnal/tambah');
        } else {
            $this->M_setup_jurnal->tambahDataSetupJurnal($dataSetupJurnal);
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('setup_jurnal');
        }
    }
    public function hapus($id)
    {
        $this->M_setup_jurnal->hapusDataSetupJurnal($id);
        $this->session->set_flashdata('flash2', 'Dihapus');
        redirect('setup_jurnal');
    }
    public function edit($id)
    {
        $topik['judul'] = 'Edit Data Dosen';
        $data['setup_jurnal'] = $this->M_setup_jurnal->getSetupJurnalById($id);
        $data['setup_jurnal_anggaran'] = $this->M_setup_jurnal->getSetupJurnalAnggaranById($id);
        $data['setup_jurnal_finansial'] = $this->M_setup_jurnal->getSetupJurnalFinansialById($id);

        $dataSetupJurnal = [
            "kode_jurnal" => $this->input->post('kode_jurnal', true),
            "formulir" => $this->input->post('formulir', true),
            "tabulasi" => $this->input->post('tabulasi', true),
            "keterangan" => $this->input->post('keterangan', true)
        ];

        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $this->load->view('templates/header', $topik);
            $this->load->view('setup_jurnal/edit', $data);
        } else {
            $this->M_setup_jurnal->ubahDataSetupJurnal($dataSetupJurnal);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('setup_jurnal');
        }
    }
}
