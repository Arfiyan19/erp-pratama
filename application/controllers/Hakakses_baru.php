<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hakakses_baru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Admin_model");
    }

    public function index()
    {
        $data['judul'] = 'Halaman Menu User';
        $data["data_role"] = $this->Admin_model->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('hakaksesbaru/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data['judul'] = 'Form Tambah Data Hak Akses';
        $role = $this->Admin_model;
        $validation = $this->form_validation;
        $validation->set_rules($role->rules());

        if ($validation->run()) {
            $role->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data role berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect("hakakses_baru/index");
        }

        $this->load->view('templates/header', $data);
        $this->load->view('hakaksesbaru/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect("hakakses_baru/index");

        $role = $this->Admin_model;
        $validation = $this->form_validation;
        $validation->set_rules($role->rules());

        if ($validation->run()) {
            $role->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Role berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect("hakakses_baru/index");
        }

        $data['judul'] = 'Form Edit Data Hak Akses';
        $data["data_role"] = $role->getById($id);
        if (!$data["data_role"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view("hakaksesbaru/edit", $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();

        $this->Admin_model->delete($id);

        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Role berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}
