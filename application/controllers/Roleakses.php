<?php

class Roleakses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_menu');
        $this->load->model('M_role_akses');
        $this->load->model('m_role');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu User';
        $data['tbl_role'] = $this->m_role->tampil_data();
        $this->load->view('templates/header', $topik);
        $this->load->view('roleakses/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data2['judul'] = 'Form Tambah Data Akses';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data2);
            $this->load->view('roleakses/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->M_role_akses->tambahDataRoleAkses();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('roleakses');
        }
    }

    public function hapus($id)
    {

        $this->M_role_akses->hapusDataRoleAkses($id);
        $this->session->set_flashdata('flash2', 'Dihapus');
        redirect('roleakses');
    }

    public function edit($id)
    {
        $topik['judul'] = 'Edit Data Role Akses';
        $data['roleakses'] = $this->M_role_akses->getRoleAksesById($id);

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $topik);
            $this->load->view('roleakses/edit', $data);
        } else {
            $this->M_role_akses->ubahDataRoleAkses();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('roleakses');
        }
    }
}
