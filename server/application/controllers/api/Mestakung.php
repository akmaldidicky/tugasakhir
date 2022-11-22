<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mestakung extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mestakung_model', 'mestakung');
    }
    public function index_get()
    {
        $key_device = $this->get('key_device');
        $key = $this->get('key');
        $urutan = $this->get('urutan');
        $check = $this->db->query("
        SELECT user.key, device.key_device FROM device
        JOIN user ON user.id=device.id_user
        where user.key='$key' AND device.key_device='$key_device';")->row_array();
        $this->db->where('is_deleted', 0);
        $check2 = $this->db->get_where('data', ['key_device' => $key_device])->row_array();
        if ($key_device) {
            if ($check) {
                if ($check2) {
                    $result = $this->mestakung->getdata_all_device($key_device, $urutan);
                    if ($result) {
                        $this->response([
                            'status' => true,
                            'your data' => $result
                        ], REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => false,
                            'message' => 'Device tidak memiliki data sensor!'
                        ], REST_Controller::HTTP_NO_CONTENT);
                    }
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Device tidak memiliki data sensor!'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'key device tidak terdaftar!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Masukan Chip_id!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function header_get()
    {
        $nama_header = $this->get('nama_header');
        $key = $this->get('key');
        $urutan = $this->get('urutan');
        $check = $this->db->query("
        SELECT user.key, aplication.nama_header FROM aplication
        JOIN user ON user.id=aplication.id_user
        where user.key='$key' AND aplication.nama_header='$nama_header';")->row_array();
        if ($nama_header) {
            if ($check) {
                $result = $this->mestakung->getdata_from_namaheader($nama_header, $urutan);
                if ($result) {
                    $this->response([
                        'status' => true,
                        'your data' => $result
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Device tidak memiliki data sensor!'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Chip_id tidak terdaftar!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Masukan Chip_id!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function realtime_get()
    {
        $key_device = $this->get('key_device');
        $check = $this->db->get_where('device', ['key_device' => $key_device])->row_array();
        if ($key_device) {
            if ($check) {
                $result = $this->mestakung->getdata_realtime($key_device);
                if ($result) {
                    $this->response([
                        'status' => true,
                        'your data' => $result
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Device tidak memiliki data sensor!'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Device tidak terdaftar!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
    public function w_get()
    {
        $key_device = $this->get('key_device');
        $urutan = $this->get('urutan');
        $limit = $this->get('limit');
        $check = $this->db->get_where('device', ['key_device' => $key_device])->row_array();
        $this->db->where('is_deleted', 0);
        $check2 = $this->db->get_where('data', ['key_device' => $key_device])->row_array();
        if ($key_device && $limit) {
            if ($check) {
                if ($check2) {
                    $result = $this->mestakung->getdata_limit_keydevice($key_device, $urutan, $limit);
                    if ($result) {
                        $this->response([
                            'status' => true,
                            'your data' => $result
                        ], REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => false,
                            'message' => 'Device tidak memiliki data sensor!'
                        ], REST_Controller::HTTP_NOT_FOUND);
                    }
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Device tidak memiliki data sensor!'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'key device tidak terdaftar!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Masukan parameter key device dan limit!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_delete()
    {
        $chip_id = $this->delete('chip_id');
        if ($chip_id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an chip_id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mestakung->deletedevice($chip_id) > 0 && $this->mestakung->deletedevice_key($chip_id) > 0) {
                //ok
                $this->response([
                    'status' => true,
                    'device' => $chip_id,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_OK);
            } else {
                //id not found
                $this->response([
                    'status' => false,
                    'message' => 'chip_id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }


    public function index_post()
    {
        $data = [
            // 'id_user' =>$this->post('id_user'),
            'id_user' => $this->post('id_user'),
            'chip_id' => $this->post('chip_id'),
            'nama_device' => $this->post('nama_device'),
            'nama_header' => $this->post('nama_header'),
            'key_device' => $this->post('key_device')
        ];
        $data2 = [
            // 'id_user' =>$this->post('id_user'),
            'key_device' => $this->post('key_device'),
            'id_user' => $this->post('id_user'),
            'chip_id' => $this->post('chip_id')
        ];
        $chip_id = $this->post('chip_id');
        $this->db->where('is_deleted', 0);
        $cek = $this->db->get_where('device', ['chip_id' => $chip_id])->row_array();
        if ($cek == null) {
            if ($this->mestakung->createdevice_key($data2) > 0 && $this->mestakung->createdevice($data) > 0) {

                $this->response([
                    'status' => true,
                    'message' => 'new device has been created'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => true,
                    'message' => 'failed to cretae new device'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => true,
                'message' => 'failed to cretae new device,device is registered!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function index_put()
    {
        $chip_id = $this->put('chip_id');
        $data = ['nama_device' => $this->put('nama_device')];

        if ($this->mestakung->updatedevice($data, $chip_id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data has been updated!'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
