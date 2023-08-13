<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('m_manager');
        $this->load->model('M_daftar');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Manager Lain';
        $data['jabatan'] = $this->M_daftar->tampil_jabatan();
        $data['manager'] = $this->m_manager->tampil_data();
        $data['mitra'] = $this->m_manager->tampil_data_mitra();
        $data['managerpl'] = $this->m_manager->tampil_data_pl_valid();
       
        $data['kode_barang'] = $this->m_manager->kode_barang();
        $data['latest_no_invoice'] = $this->m_manager->latest_no_invoice();
        $this->load->view('templates/header',$topik);
        $this->load->view('manager/index',$data);
        $this->load->view('templates/footer');
    }

    public function priview($id) {
        $this->db->select('*');
        $this->db->from('weekly_manager2');
        $this->db->where('id',"$id");
        $data['weekly_manager2'] = $this->db->get()->result_array();
        $ids = $data['weekly_manager2'][0]['id'];

        $this->db->select('*');
        $this->db->from('weekly_manager2_barang');
        $this->db->where('id_weekly_manager2',"$ids");
        $data['weekly_manager2_barang'] = $this->db->get()->result_array();

        echo json_encode($data);
    }

    public function tambahpl(){
        $topik['judul'] = 'Halaman Menu Manager Lain';
        $data['jabatan'] = $this->M_daftar->tampil_jabatan();
        $data['manager'] = $this->m_manager->tampil_data();
        $data['mitra'] = $this->m_manager->tampil_data_mitra();
        $data['managerpl'] = $this->m_manager->tampil_data_pl();

        $nourut = count($this->m_manager->tampil_data_pl_valid()) + 1;
        $data['no_invoice'] = 'INV/'.sprintf("%06d", $nourut).'/MGRPL/'.date('Y');

        $this->db->select('*');
        $this->db->from('weekly_manager2_barang');
        $this->db->join('weekly_manager2', 'weekly_manager2_barang.id_weekly_manager2 = weekly_manager2.id');
        $this->db->where('weekly_manager2.validasi', "N");
        $this->db->where('weekly_manager2_barang.status', "disimpan");
        $data['weekly_manager2_barang'] = $this->db->get()->result_array();

        $this->db->select('id_weekly_manager2, SUM(harga_setor)');
        $this->db->from('weekly_manager2_barang');
        $this->db->where('status', "disimpan");
        $this->db->group_by('id_weekly_manager2');

        $data['wm2hidden'] = $this->db->get()->result_array();
        $data['kode_barang'] = $this->m_manager->kode_barang();
        $data['latest_no_invoice'] = $this->m_manager->latest_no_invoice();
        $this->load->view('templates/header',$topik);
        $this->load->view('manager/tambah',$data);
        $this->load->view('templates/footer');
    }

    public function formtambah($mitraid){
        $this->db->select('*');
        $this->db->from('daftar_mitra');
        $this->db->where(['kode' => $mitraid]);
        $data['mitra'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('weekly_manager2');
        $this->db->where(['kode_id' => $mitraid, 'validasi' => 'N']);
        $data['weekly_manager2'] = $this->db->get()->result_array();
        if(count($data['weekly_manager2']) > 0){
            $ids = $data['weekly_manager2'][0]['id'];
    
            $this->db->select('*');
            $this->db->from('weekly_manager2_barang');
            $this->db->where('id_weekly_manager2',"$ids");
            $data['weekly_manager2_barang'] = $this->db->get()->result_array();
        }
        else{
            $data['weekly_manager2_barang'] = [];
        }

        echo json_encode($data);
    }

    public function managerReport() {
        $topik['judul'] = 'Halaman Menu Laporan Manager';
        $data['manager'] = $this->m_manager->tampil_data();
        $data['kode_barang'] = $this->m_manager->kode_barang();
        $this->load->view('templates/header',$topik);
        $this->load->view('managerreport/index',$data);
        $this->load->view('templates/footer');
    }

    public function fetchInOut($no_invoice) {
        $no_invoice = explode("-", $no_invoice);
        $no_invoice = implode("/", $no_invoice);
        echo json_encode($this->m_manager->fetchInOut($no_invoice));
    }

    public function barang($barang = NULL) {
        echo json_encode($this->m_manager->barang($barang));
    }

    public function allMgr($jabatan = NULL) {
        echo json_encode($this->m_manager->allMgr(urldecode($jabatan)));
    }

    public function invoiceMgr($weekending = NULL, $kode_id = NULL) {
        echo json_encode($this->m_manager->invoiceMgr($weekending, urldecode($kode_id)));
    }

    public function getAdditionalData($weekending = NULL, $kode_id = NULL) {
        echo json_encode($this->m_manager->getAdditionalData($weekending, urldecode($kode_id)));
    }

    public function getSaldoUser($akun_simpanan) {
        echo json_encode($this->m_manager->getSaldoUser($akun_simpanan));
    }

    public function getSUMInOut($no_invoice) {
        $no_invoice = explode("-", $no_invoice);
        $no_invoice = implode("/", $no_invoice);
        echo json_encode($this->m_manager->getSUMInOut($no_invoice));
    }

    public function fetchData($weekending = NULL, $jabatan = NULL, $manager = NULL) {
        echo json_encode($this->m_manager->fetchData(urldecode($weekending), urldecode($jabatan), urldecode($manager)));
    }

    public function prosesInvoice() {
        $inv = $this->input->post('noinv');
        foreach($this->input->post('idweekly', true) as $b){
            $this->db->set([
                'validasi' => 'V', 
                'tgl_validasi' => date('Y-m-d'), 
                'no_invoice_manager' => $inv
            ]);
            $this->db->where('id', $b);
            $this->db->update('weekly_manager2');
        }

        echo json_encode(['ok']);
        // $this->session->set_flashdata('flash','Berhasil Divalidasi');
        // redirect('manager');
    }

    public function editpl() {
        $id = $this->input->post('id');
        $date = $this->input->post('tgl_validasi');
        $this->db->set([
            'tgl_validasi' => $date
        ]);
        $this->db->where('id', $id);
        $this->db->update('weekly_manager2');

        $this->session->set_flashdata('flash','Berhasil Edit Data');
        redirect('manager');
    }
    
    public function batalpl($id) {
        $this->db->set([
            'tgl_validasi' => 'null',
            'validasi' => 'N'
        ]);
        $this->db->where('id', $id);
        $this->db->update('weekly_manager2');

        $this->db->set([
            'status' => 'belum disimpan'
        ]);
        $this->db->where('id_weekly_manager2', $id);
        $this->db->update('weekly_manager2_barang');

        $this->session->set_flashdata('flash','Berhasil Batalkan Validasi');
        redirect('manager');
    }

    public function tambah() {
        // $this->m_manager->tambahDataPenjualanManager();
        $id = $this->input->post('id');
        // var_dump($id);die();

        $this->db->set(['status' => 'disimpan']);
        $this->db->where('id_weekly_manager2', $id);
        $this->db->update('weekly_manager2_barang');

        $this->session->set_flashdata('flash','Berhasil Disimpan');
        redirect('manager/tambahpl');
    }

    public function tambahInOut() {
        $kode_id = $this->input->post('kode_id');
        $no_invoice = $this->input->post('no_invoice');
        $keterangan = $this->input->post('keterangan');
        $jenis = $this->input->post('jenis');
        $akun = $this->input->post('akun');
        $jumlah = $this->input->post('jumlah');

        $this->m_manager->tambahInOut($kode_id, $no_invoice, $keterangan, $jenis, $jumlah, $akun);
        echo json_encode($no_invoice);
    }

    public function editInOut() {
        $id = $this->input->post('id');
        $keterangan = $this->input->post('keterangan');
        $jenis = $this->input->post('jenis');
        $akun = $this->input->post('akun');
        $jumlah = $this->input->post('jumlah');

        $this->m_manager->editInOut($id, $keterangan, $jenis, $jumlah, $akun);
    }

    public function hapusInOut($id) {
        $this->m_manager->hapusInOut($id);
    }

    public function getInOut($id) {
        echo json_encode($this->m_manager->getInOut($id));
    }


    // public function detail($id){
    //     $topik['judul'] = 'Detail Data Karyawan';
    //     $data['manager'] = $this->m_manager->getPengirimanById($id);
    //     $this->load->view('templates/header',$topik);
    //     $this->load->view('manager/detail',$data);
    // }
    public function hapus($id){
        $this->m_manager->hapusDataManager($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('manager');
    }

    public function getData($id) {
        echo json_encode($this->m_manager->getData($id));
    }

    public function edit($id){
        $topik['judul'] = 'Edit Data Manager Lain';
        $data['manager'] = $this->m_manager->getManagerById($id);

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No_Faktur','required');
        $this->form_validation->set_rules('transaksi','Transaksi','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$topik);
            $this->load->view('manager/edit',$data);
        }else {
            $this->m_manager->ubahDataManager();
            $this->session->set_flashdata('flash','Diubah');
            redirect('manager');
        }
}
}