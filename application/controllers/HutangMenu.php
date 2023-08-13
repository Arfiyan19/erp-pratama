<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HutangMenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_HutangMenu']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $topik['judul'] = 'Halaman Menu Hutang';

        $data = [
            'suppliers' => $this->db->get_where('supplier')->result(),
        ];

        $this->load->view('templates/header', $topik);
        $this->load->view('HutangMenu/index', $data);
        $this->load->view('templates/footer');

        //load file javascript
        $this->load->view('HutangMenu/S_HutangMenu', $data);
    }

    public function getDataHutangMenu()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));

        $dataHutangMenu = $this->M_HutangMenu->getDataHutangMenu($dataPost);

        $finalDataHutangMenu    = [];
        foreach ($dataHutangMenu as $key => $value) {

            if ((int)$value->sisa_hutang != 0) {
                $dataTemp                = $value;

                $newDate = date("Y-m-d", strtotime($value->tanggal));
                $newDateTempo = date("Y-m-d", strtotime($value->tanggal_jt));

                $tanggal                 = new DateTime($newDate);
                $tanggalTempo            = new DateTime($newDateTempo);
                $tanggalSekarang         = new DateTime();
                $selisih                 = $tanggalTempo->diff($tanggal)->days;
                $selisih1                = $tanggalSekarang->diff($tanggal)->days;
                $dataTemp->tanggal       = $newDate;
                $dataTemp->tanggal_jt    = $newDateTempo;
                $dataTemp->usiaHutang    = (int)$selisih - (int)$selisih1;

                switch ($dataPost->usiaHutang) {
                    case 'kurang30':
                        if ($dataTemp->usiaHutang < 30) {
                            array_push($finalDataHutangMenu, $dataTemp);
                        }
                        break;

                    case '0':
                        if ($dataTemp->usiaHutang == 0) {
                            array_push($finalDataHutangMenu, $dataTemp);
                        }
                        break;
                    case 'lebih30':
                        if ($dataTemp->usiaHutang > 30) {
                            array_push($finalDataHutangMenu, $dataTemp);
                        }
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }

        echo json_encode($finalDataHutangMenu);
    }
}
