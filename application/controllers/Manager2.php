<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager2 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_manager');
		$this->load->model('M_user');
        $this->load->library('form_validation');
    }

    public function index(){
        $topik['judul'] = 'Halaman Menu Manager Lain';
        
        $dfil['faktur'] = $this->input->get('faktur', true);
        $dfil['tgl_mulai'] = $this->input->get('tgl_mulai', true);
        $dfil['tgl_sampai'] = $this->input->get('tgl_sampai', true);

        $data['manager'] = $this->M_manager->tampil_data();
        $data['datas'] = $this->M_manager->tampil_data_manager($dfil);
        $data['kode_barang'] = $this->M_manager->kode_barang();
        $data['barang'] = $this->M_manager->get_barang_mitra2($this->session->userdata('kode_id'));
        $data['user'] = $this->M_manager->getMitra();
        $this->load->view('templates2/header',$topik);
        $this->load->view('manager2/index',$data);
        $this->load->view('templates2/footer');
    }

    public function tampil_data() {
        echo json_encode($this->M_manager->tampil_data1());
    }

    public function barang($kode) {
        echo json_encode($this->M_manager->get_barang_mitra2($this->session->userdata('kode_id'), $kode));
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

    public function editwm($id) {
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

    public function editDataPenjualanManager() {
        $id = $this->input->post('id', true);
        $wd['nominal_total'] = $this->input->post('total_penjualan', true);
        
        $this->db->set($wd);
        $this->db->where('id', $id);
        $this->db->update('weekly_manager2');

        $this->db->delete('weekly_manager2_barang', ['id_weekly_manager2' => $id]);
        for($i=0;$i<=count($this->input->post('kode',true))-1;$i++){
            $barang = $this->M_manager->get_barang_mitra2($this->session->userdata('kode_id'), $this->input->post('kode',true)[$i]);

            $data['id_weekly_manager2'] = $id;
            $data['kode'] = $this->input->post('kode',true)[$i];
            $data['nama'] = $barang[0]['nama'];
            $data['stok'] = $this->input->post('stok',true)[$i];
            $data['qty_terjual'] = $this->input->post('qty',true)[$i];
            $data['fc'] = $this->input->post('fc',true)[$i];
            $data['harga_setor'] = $this->input->post('harga_setor',true)[$i];
            $data['total_item'] = $this->input->post('total_item',true)[$i];

            $this->db->insert('weekly_manager2_barang', $data);
        }

        $this->session->set_flashdata('flash','Berhasil Diubah');
        redirect('manager2');
    }

    public function cari() {
        $topik['judul'] = 'Halaman Menu Cari';
        $data['manager'] = $this->M_manager->tampil_data();
        $data['datas'] = $this->M_manager->getDataSearch()->result_array();
        $this->load->view('templates2/header',$topik);
        $this->load->view('manager2/cari',$data);
        $this->load->view('templates2/footer');
    }

    public function search()
    {
        if(isset($_GET['start_date']) && !empty($_GET['end_date'])) {
            $getData = [
                'start_date' => date('Y-m-d', strtotime($_GET['start_date'])),
                'end_date' => date('Y-m-d', strtotime($_GET['end_date']))
            ];
            $data['judul'] = 'Halaman Search Weekly';
            $data['datas'] = $this->M_manager->getSearch($getData);
            $this->load->view('templates2/header',$data);
            $this->load->view('manager2/search',$data);
            $this->load->view('templates2/footer');
        }
    }

    public function tambah(){
        $data['judul'] = 'Form Tambah Data Manager Lain';
        $data['users'] = $this->M_user->tampil_data2();
        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No_Faktur','required');
        $this->form_validation->set_rules('transaksi','Transaksi','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates2/header',$data);
            $this->load->view('manager2/tambah');
            $this->load->view('templates2/footer');
        } else {
            $this->M_manager->tambahDataDownLine();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('manager2');
        }
        
    }

    public function tambahDataPenjualanManager() {
        $latest_no_invoice = ((int)"00999" + 1);
        $latest_no_invoice = (string)$latest_no_invoice;
        $no_invoice = "INV/".date('ymd')."/";
        $jmlNol = 0;

        for ($i = 0; $i < strlen($latest_no_invoice); $i++) {
            if ($latest_no_invoice[$i] != "0") {
                $no_invoice .= str_repeat("0", $jmlNol).((int)substr($latest_no_invoice, $i) + 1);
            break;
            } else {
                $jmlNol++;
            }
        }
        $wd['kode_id'] = $this->session->userdata('kode_id');
        $wd['tgl'] = date('Y-m-d');
        $wd['no_invoice'] = $no_invoice;
        $wd['nominal_total'] = $this->input->post('total_penjualan',true);
        $wd['validasi'] = 'N';
        
        $this->db->insert('weekly_manager2', $wd);
        $wid = $this->db->insert_id();

        for($i=0;$i<=count($this->input->post('kode',true))-1;$i++){
            $barang = $this->M_manager->get_barang_mitra2($this->session->userdata('kode_id'), $this->input->post('kode',true)[$i]);

            $data['id_weekly_manager2'] = $wid;
            $data['kode'] = $this->input->post('kode',true)[$i];
            $data['nama'] = $barang[0]['nama'];
            $data['stok'] = $this->input->post('stok',true)[$i];
            $data['qty_terjual'] = $this->input->post('qty',true)[$i];
            $data['fc'] = $this->input->post('fc',true)[$i];
            $data['harga_setor'] = $this->input->post('harga_setor',true)[$i];
            $data['total_item'] = $this->input->post('total_item',true)[$i];

            $this->db->insert('weekly_manager2_barang', $data);
        }

        $this->session->set_flashdata('flash','Ditambahkan');
        redirect('manager2');
    }

    // public function detail($id){
    //     $topik['judul'] = 'Detail Data Karyawan';
    //     $data['manager'] = $this->M_manager->getPengirimanById($id);
    //     $this->load->view('templates/header',$topik);
    //     $this->load->view('manager/detail',$data);
    // }
    public function hapus($id){
        $this->M_manager->hapusDataManager($id);
        $this->M_manager->hapusDataBarangManager($id);

        $this->session->set_flashdata('flash2','Dihapus');
        redirect('manager2');
    }

    public function edit($id){
        $topik['judul'] = 'Edit Data Manager Lain';
        $data['manager'] = $this->M_manager->getManagerById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No_Faktur','required');
        $this->form_validation->set_rules('transaksi','Transaksi','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates2/header',$topik);
            $this->load->view('manager/edit',$data);
        } else {
            $this->M_manager->ubahDataManager();
            $this->session->set_flashdata('flash','Diubah');
            redirect('manager');
        }
}
}