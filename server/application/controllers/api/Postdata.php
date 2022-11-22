<?php

// use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . 'libraries/REST_Controller.php';
// require APPPATH . 'libraries/Format.php';


class Postdata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Postdata_model', 'postdata');
    }
    public function index()
    {
        if (isset($_POST['nilai'])) {
            $chip_id = $this->input->post('chip_id');
            $nama_header = $this->input->post('nama_header');
            $code_header = $this->input->post('code_header');
            $nilai = $this->input->post('nilai');
            $data = [
                'chip_id' => $chip_id,
                'nama_header' => $nama_header,
                'code_header' => $code_header,
                'data' => $nilai,
                'time_add' => date("Y-m-d H:i:sa")
            ];
            $this->postdata->createnilai($data);
        } else {
            echo "wrong variabel";
        }
    }
}
