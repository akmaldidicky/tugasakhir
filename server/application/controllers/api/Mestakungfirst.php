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

        $cd = $this->get('cd');
        if ($cd) {
        }
        if ($result) {
            $this->response([
                'status' => true,
                'message' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'empty1'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        // elseif ($cd !== null) {
        //     $result = $this->mestakung->getMestakung($cd);
        //     if ($result) {
        //         $this->response([
        //             'status' => true,
        //             'message' => $result
        //         ], REST_Controller::HTTP_OK);
        //     } else {
        //         $this->response([
        //             'status' => false,
        //             'message' => 'empty'
        //         ], REST_Controller::HTTP_NOT_FOUND);
        //     }
        // }
        //else {

        //     $result = $this->mestakung->getMestakung($limit);
        // }

        // if ($result) {
        //     $this->response([
        //         'status' => true,
        //         'message' => $result
        //     ], REST_Controller::HTTP_OK);
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'empty'
        //     ], REST_Controller::HTTP_NOT_FOUND);
        // }
    }

    //     public function index_delete()
    //     {
    //         $key = $this->delete('key');

    //         if ($key === null) {
    //             $this->response([
    //                 'status' => false,
    //                 'message' => 'provide an key'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         } else {
    //             if ($this->mestakung->deleteMestakung($key) > 0) {
    //                 //ok
    //                 $this->response([
    //                     'status' => true,
    //                     'id' => $key,
    //                     'message' => 'deleted'
    //                 ], REST_Controller::HTTP_OK);
    //             } else {
    //                 //id not found
    //                 $this->response([
    //                     'status' => false,
    //                     'message' => 'user not found!'
    //                 ], REST_Controller::HTTP_BAD_REQUEST);
    //             }
    //         }
    //     }


    //     public function index_post()
    //     {
    //         $data = [
    //             // 'id_user' =>$this->post('id_user'),
    //             'nama' => $this->post('nama'),
    //             'password' => $this->post('password'),
    //             'key' => $this->post('api_key')
    //         ];

    //         if ($this->mestakung->createMestakung($data) > 0) {
    //             $this->response([
    //                 'status' => true,
    //                 'message' => 'new user has been created'
    //             ], REST_Controller::HTTP_CREATED);
    //         } else {
    //             $this->response([
    //                 'status' => true,
    //                 'message' => 'failed to cretae new user'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }
    //     }


    //     public function index_put()
    //     {
    //         $nama = $this->put('namalama');
    //         $data = [
    //             'nama' => $this->put('nama'),
    //             'password' => $this->put('password')
    //             // 'api_key' =>$this->put('api_key')
    //         ];

    //         if ($this->mestakung->updateMestakung($data, $nama) > 0) {
    //             $this->response([
    //                 'status' => true,
    //                 'message' => 'data has been updated!'
    //             ], REST_Controller::HTTP_OK);
    //         } else {
    //             $this->response([
    //                 'status' => false,
    //                 'message' => 'failed to update data'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }
    //     }
}
