<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mesta extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mesta_model', 'mesta');
    }
    public function index_get()
    {
        $key = $this->get('key');
        $key_device = $this->get('key_device');
        $waktu_awal = $this->get('waktu_awal');
        $waktu_akhir = $this->get('waktu_akhir');
        $urutan = $this->get('urutan');
        if ($key_device) {
            $check = $this->db->query("
            SELECT user.key, device.key_device FROM device
            JOIN user ON user.id=device.id_user
            where user.key='$key' AND device.key_device='$key_device' AND device.is_deleted=0;")->row_array();
            $this->db->where('is_deleted', 0);
            $check2 = $this->db->get_where('data', ['key_device' => $key_device])->row_array();
            if ($check) {
                if ($check2) {
                    $result = $this->mesta->getdata_keydevice($key_device, $urutan, $waktu_awal, $waktu_akhir);
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
                    'message' => 'Device tidak terdaftar!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $result = $this->mesta->getheader($key);
            $result2 = $this->mesta->getdevice($key);
            $result2 = $this->mesta->getaplication($key);
            if ($result) {
                $this->response([
                    'status' => true,
                    'your header' => $result,
                    'your device' => $result2
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Anda belum memiliki device!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
    public function index_post()
    {
        $nama_header = $this->post('nama_header');
        $check = $this->db->query("SELECT * FROM aplication WHERE nama_header = '$nama_header';")->row_array();
        $data = [
            'nama_header' => $this->post('nama_header'),
            'id_user' => $this->post('id_user')
        ];
        if ($check == null) {
            if ($this->mesta->createaplication($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'new header has been created'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => true,
                    'message' => 'failed to cretae new header'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => true,
                'message' => 'header name has been registered'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $chip_id = $this->put('chip_id');
        $key_device = $this->put('key_device');
        $limit = $this->db->get_where('device_key', ['chip_id' => $chip_id])->num_rows();
        $cek = $this->db->get_where('device_key', ['key_device' => $key_device])->num_rows();
        $data = [
            'key_device' => $key_device
        ];
        $data2 = [
            // 'id_user' =>$this->post('id_user'),
            'key_device' => $key_device,
            'id_user' => $this->put('id_user'),
            'chip_id' => $chip_id
        ];
        if ($cek == null) {
            if ($limit <= 4) {
                if ($this->mesta->createDevice_key($data2) > 0 && $this->mesta->updatekeydevice($data, $chip_id) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'header has been updated!'
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'failed to update header'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'limit update key device'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'key device has been registered'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_delete()
    {
        $nama_header = $this->delete('nama_header');
        if ($nama_header === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an nama_header'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mesta->deleteaplication($nama_header) > 0) {
                //ok
                $this->response([
                    'status' => true,
                    'header' => $nama_header,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_OK);
            } else {
                //id not found
                $this->response([
                    'status' => false,
                    'message' => 'nama_header not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function v_get()
    {
        $chip_id = $this->get('chip_id');
        $urutan = $this->get('urutan');
        $waktu_awal = $this->get('waktu_awal');
        $waktu_akhir = $this->get('waktu_akhir');
        if ($chip_id) {
            if ($waktu_awal) {
                if ($waktu_akhir) {
                    $result = $this->mesta->getdata_sortir_waktu($chip_id, $urutan, $waktu_awal, $waktu_akhir);
                    if ($result) {
                        $this->response([
                            'status' => true,
                            'your data' => $result
                        ], REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => false,
                            'message' => 'Tidak ada data dalam rentang waktu ini!'
                        ], REST_Controller::HTTP_NOT_FOUND);
                    }
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Masukan Waktu akhir!'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Masukan Waktu awal!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Masukan Chip_id!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function v_delete()
    {
        $nama_header = $this->delete('nama_header');
        $variabel = $this->delete('variabel');
        if ($nama_header === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an nama_header'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mesta->deleteVariable($nama_header, $variabel) > 0) {
                //ok
                $this->response([
                    'status' => true,
                    'header' => $variabel,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_OK);
            } else {
                //id not found
                $this->response([
                    'status' => false,
                    'message' => 'variabel or nama_device not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }


    public function v_post()
    {
        $id_user = $this->post('id_user');
        $nama_header = $this->post('nama_header');
        $codemax = $this->db->query(" select MAX(code) from variable
                where id_user=$id_user AND nama_header='$nama_header' ;")->result_array();
        foreach ($codemax as $c) :
            $code = $c['MAX(code)'] + 1;
        endforeach;

        $check = $this->db->query("SELECT * FROM aplication WHERE nama_header = '$nama_header';")->row_array();
        if ($check > 0) {
            $data = [
                'id_user' => $id_user,
                'nama_header' => $this->post('nama_header'),
                'code' => $code,
                'variabel' => $this->post('variabel')
            ];
            if ($this->mesta->createvariable($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'new variable has been created'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => true,
                    'message' => 'failed to cretae new variable'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => true,
                'message' => 'header name not registered!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function v_put()
    {
        $code_header = $this->put('code_header');
        $nama_header = $this->put('nama_header');
        $data = [
            'variabel' => $this->put('variabel')
        ];


        if ($this->mesta->updatevariable($data, $nama_header, $code_header) > 0) {
            $this->response([
                'status' => true,
                'message' => 'header has been updated!'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update header'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
