<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Home_model', 'home');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('home');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }


        //validasi sukses
        else {
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('pwd');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            //usernya ada
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'key' => $user['key'],
                    'id' => $user['id']
                ];
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong Password.</div>');
                redirect('auth');
            }
        } else {
            //usernya tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email not registered!</div>');
            redirect('auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {
            redirect('home');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email has already registered!'
        ]);
        $this->form_validation->set_rules('pwd1', 'Password', 'required|trim|min_length[8]|matches[pwd2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('pwd2', 'Password', 'required|trim|matches[pwd1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'MESTAKUNG User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $key = md5($this->input->post('email'));
            $data = [
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('pwd1'), PASSWORD_DEFAULT),
                'key' => $key,
            ];
            $this->db->insert('user', $data);
            sleep(2);
            $email = $this->input->post('email');
            $arr = $this->home->getuser($email);
            // $id_user = implode($arr);
            $data2 = [
                'id_user' => $arr['id'],
                'key_user' => $key
            ];
            $this->db->insert('user_key', $data2);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been created, please login.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('key');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
}
