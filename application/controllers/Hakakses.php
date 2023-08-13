<?php

class Hakakses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Akses', 'm_akses');
        $this->load->model('M_menu');
        $this->load->model('m_role');
        $this->load->model('m_login');


        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu User';
        $data['tbl_role'] = $this->m_role->tampil_data();
        $data['jabatan'] = $this->m_akses->getJabatan();
        $this->load->view('templates/header', $topik);
        $this->load->view('hakakses/index', $data);
        $this->load->view('hakakses/akses_js');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $topik['judul'] = 'Form Tambah Data Hak Akses';

        $this->form_validation->set_rules('name', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['menus'] = $this->M_menu->getMenu();
            $data['subMenus'] = $this->M_menu->getSubMenu();
            $data['roles'] = $this->M_menu->getRole();
            $this->load->view('templates/header', $topik);
            $this->load->view('hakakses/tambah', $data);
        } else {
            $this->m_akses->tambahHakAkses();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('users');
        }
    }

    public function simpan()
    {
        $where = ['username' => 'admin'];
        $cekUsername = $this->m_login->cek_login($where)->row_array();
        if ($cekUsername > 1) {
            $this->m_akses->simpan();
            $this->session->set_flashdata('flash', 'DI Perbarui');
            redirect('hakakses');
        } else {
            echo ('Anda Tidak Memiliki Akses');
        }
    }

    public function edit()
    {
        // if ($this->session->set_userdata('users')) {
        //     $data['list_menu'] = $this->m_akses->list_menu();
        //     $data['list_user'] = $this->m_akses->list_user();
        //     $this->load->view('hakakses/akses_edit', $data);
        // } else {
        //     $this->session->set_flashdata('gagal', 'Anda Tidak Memiliki Akses');
        //     redirect('unautorized');
        // }
        // $data = $this->m_login->cek_login($where)->row_array();
        $where = ['username' => 'admin'];
        $cekUsername = $this->m_login->cek_login($where)->row_array();
        if ($cekUsername > 1) {
            $data['list_menu'] = $this->m_akses->list_menu();
            $data['list_user'] = $this->m_akses->list_name();
            $this->load->view('hakakses/akses_edit', $data);
        } else {
            echo ('Anda Tidak Memiliki Akses');
        }
    }

    public function hapus($id)
    {
        $this->m_role->hapus_data($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('users');
    }

    public function update()
    {
        $this->m_role->update_data();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('users');
    }
}
