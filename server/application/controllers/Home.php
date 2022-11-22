<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Home_model', 'home');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = '';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
    public function profile()
    {
        $data['title'] = 'My Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/profile', $data);
        $this->load->view('templates/footer');
    }
    public function resetkey()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $id_user = $this->session->userdata('id');
        $limit = $this->home->getLimit_resetuser($id_user);
        if ($limit > 3) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Batas Reset telah tercapai!!</div>');
            redirect('home/profile');
        } else {

            $rand = rand(100, 999);
            $email = $this->session->userdata('email');
            $id = $this->session->userdata('id');
            $keybaru = md5($rand . $email);
            $data = [
                'key' => $keybaru

            ];
            $data2 = [
                'id_user' => $id_user,
                'key_user' => $keybaru

            ];
            $data3 = [
                'is_used' => 0
            ];
            $this->home->updateUser_key($id_user, $data3);
            $this->home->updateUser($id, $data);
            $this->home->createUser_key($data2);

            redirect('home/profile');
        }
    }
    public function resetkey_device($id, $chip_id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $limit = $this->home->getLimit_resetdevice($chip_id);

        if ($limit >= 3) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Batas Reset telah tercapai!!</div>');
            redirect('home/device');
        } else {

            $rand = rand(100, 999);
            $email = $this->session->userdata('email');
            $id_user = $this->session->userdata('id');
            $keybaru = md5($rand . $chip_id);
            $data = [
                'key_device' => $keybaru

            ];
            $data2 = [
                'id_user' => $id_user,
                'chip_id' => $chip_id,
                'key_device' => $keybaru

            ];
            $data3 = [
                'is_used' => 0
            ];
            $this->home->createdevice_key($data2);
            $this->home->updatedevice_key($chip_id, $data3);
            $this->home->updatedevice($id, $data);

            redirect('home/device');
        }
    }
    public function mydevice()
    {

        $data['title'] = 'Header';
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $data['header'] = $this->home->getvariable($id_user);
        $data['kelompok_header'] = $this->home->getaplication($id_user);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/mydevice', $data);
        $this->load->view('templates/footer');
    }
    public function device()
    {

        $data['title'] = 'My Device';
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $data['device'] = $this->home->getdevice($id_user);
        $data['kelompok_header'] = $this->home->getaplication($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/device', $data);
        $this->load->view('templates/footer');
    }

    public function data_filter()
    {
        $data['title'] = 'Data Device';
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $data['header_nama'] = $this->home->getaplication($id_user);

        $nama_header = $this->input->post('nama_header');
        $data['device'] = $this->home->getdevice_header($nama_header);


        $nama_header2 = $this->input->post('nama_header2');
        $key_device = $this->input->post('key_device');
        $waktu_awal = $this->input->post('waktu_awal');
        $waktu_akhir = $this->input->post('waktu_akhir');
        $urutan = $this->input->post('urutan');
        $kode_form = $this->input->post('kode_form');
        $data['key_device'] = $this->input->post('key_device');
        $data['nama_device'] = $this->input->post('nama_device');
        $data['namaheader'] = $this->input->post('nama_header');
        $data['namaheader2'] = $this->input->post('nama_header2');
        $data['waktuawal'] = $this->input->post('waktu_awal');
        $data['waktuakhir'] = $this->input->post('waktu_akhir');
        $data['urutan2'] = $this->input->post('urutan');
        if ($nama_header2) {
            $banyakdata = $this->home->getBanyakdata($key_device, $urutan, $waktu_awal, $waktu_akhir);
            if ($banyakdata <= 1000) {
                $data['header'] = $this->home->getHeader($key_device, $waktu_awal, $waktu_akhir, $nama_header2);
                $data['device_2'] = $this->db->query("SELECT*FROM device WHERE key_device='$key_device';")->row_array();
                $data['nilai'] = $this->home->getData($key_device, $urutan, $waktu_awal, $waktu_akhir);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('home/data_filter_hasil', $data);
                $this->load->view('templates/footer');
            } else {
                $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

                $nama_device =  $this->db->query("SELECT*FROM device WHERE key_device='$key_device';")->row_array();
                $nama_device2 = $nama_device['nama_device'];
                $date = date('d M Y');
                $header = $this->db->query("SELECT*FROM variable
                WHERE id_user=$id_user AND nama_header= '$nama_header2' AND is_deleted=0
                ;")->result_array();
                $nilai = $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');")->result_array();
                $spreadsheet = new Spreadsheet;
                $sheet = $spreadsheet->getActiveSheet();

                $i = 3;
                $sheet->setCellValue('A1', $nama_device2);
                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Time_add');
                foreach ($header as $h) {
                    $sheet->setCellValueByColumnAndRow($i, 2, $h['variabel']);
                    $i++;
                }

                $baris = 3;
                $nomer = 1;
                foreach ($nilai as $n) :
                    $kolom2 = 2;

                    $sheet->setCellValue('A' . $baris, $nomer);
                    $sheet->setCellValue('B' . $baris, $n['time_add']);
                    foreach ($header as $h) :
                        $sheet->setCellValue($alphabet[$kolom2] . $baris,  $n['data_' . $h['code']]);
                        $kolom2++;
                    endforeach;
                    $nomer++;
                    $baris++;
                endforeach;
                for ($a = 'A'; $a !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $a++) {
                    $spreadsheet->getActiveSheet()->getColumnDimension($a)->setAutoSize(TRUE);
                }
                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="Mestakung ' . $date . ' (' . $nama_device2 . ').xlsx"');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');

                redirect('home/data_filter');
            }
        } else {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/data_filter', $data);
            $this->load->view('templates/footer');
        }
    }
    public function hapus($id)
    {
        $this->home->deletevariable($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Header telah dihapus!!</div>');
        redirect('home/mydevice');
    }
    public function hapusk_header($id)
    {
        $this->home->deleteaplication($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aplication telah dihapus!!</div>');
        redirect('home/mydevice');
    }
    public function hapusdevice($id, $chip_id)
    {
        $this->home->deletedevice($id);
        $this->home->deletedevice_key($chip_id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Device telah dihapus!!</div>');
        redirect('home/device');
    }
    public function hapus_data()
    {
        $key_device = $this->input->post('keydevice');
        $waktuawal = $this->input->post('waktuawal');
        $waktuakhir = $this->input->post('waktuakhir');

        $this->home->deleteData($key_device, $waktuawal, $waktuakhir);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil hapus data!</div>');
        redirect('home/data_filter');
    }
    public function tambah()
    {
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $data['header'] = $this->home->getvariable($id_user);
        $kode_form = $this->input->post('kode_form');

        if ($kode_form == 1) {
            $this->form_validation->set_rules('nama_header', 'Nama header', 'required|trim|is_unique[aplication.nama_header]', [
                'is_unique' => 'Nama header ini sudah terdaftar!'
            ]);
            if ($this->form_validation->run() == false) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Header ini telah terdaftar (ganti yang lain)!!</div>');
                redirect('home/mydevice');
            } else {
                $data = [
                    'id_user' => $id_user,
                    'nama_header' => htmlspecialchars($this->input->post('nama_header', true))
                ];
                $this->home->createAplication($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Header telah ditambahkan!!</div>');
                redirect('home/mydevice');
            }
        } else {
            $this->form_validation->set_rules('variabel', 'Variabel', 'required|trim');
            if ($this->form_validation->run() == false) {
                redirect('home/mydevice');
            } else {

                $nama_header2 = $this->input->post('nama_header2');
                $codemax = $this->db->query(" select MAX(code) from variable
                where id_user=$id_user AND nama_header='$nama_header2' ;")->result_array();
                foreach ($codemax as $c) :
                    $code = $c['MAX(code)'] + 1;
                endforeach;

                $data = [
                    'id_user' => $id_user,
                    'nama_header' => htmlspecialchars($this->input->post('nama_header2', true)),
                    'code' => $code,
                    'variabel' => htmlspecialchars($this->input->post('variabel', true))

                ];
                $this->home->createVariable($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel telah ditambahkan!!</div>');
                redirect('home/mydevice');
            }
        }
    }
    public function tambahdevice()
    {
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $random = rand(100, 999);
        $waktu = date("H:i:sa");
        $key_device = md5($random . $waktu);
        $this->form_validation->set_rules('chipid', 'Chipid', 'required|trim');
        $this->form_validation->set_rules('namadevice', 'Nama_device', 'required|trim');
        $this->form_validation->set_rules('namaheader', 'Nama_header', 'required|trim');
        if ($this->form_validation->run() == false) {

            redirect('home/device');
        } else {

            $data = [
                'key_device' => $key_device,
                'id_user' => $id_user,
                'chip_id' => htmlspecialchars($this->input->post('chipid', true)),
                'nama_device' => htmlspecialchars($this->input->post('namadevice', true)),
                'nama_header' => htmlspecialchars($this->input->post('namaheader', true))

            ];
            $data2 = [
                'key_device' => $key_device,
                'id_user' => $id_user,
                'chip_id' => htmlspecialchars($this->input->post('chipid', true))

            ];
            $this->home->createDevice_key($data2);
            $this->home->createDevice($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Device telah ditambahkan!!</div>');
            redirect('home/device');
        }
    }
    public function editprofile()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Header';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/editprofile', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true));
            $email = htmlspecialchars($this->input->post('email', true));

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('home/profile');
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('email', $data['user']['email']);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil berhasil diubah!</div>');
            redirect('home/profile');
        }
    }
    public function edit($id)
    {
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $data['header'] = $this->home->getvariable($id_user);
        $data['head'] = $this->db->get_where('variable', ['id' => $id])->result_array();

        $this->form_validation->set_rules('namaheader', 'Nama_header', 'required|trim');
        $this->form_validation->set_rules('variabel', 'Variabel', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Header';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/edit', $data, $id);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'variabel' => htmlspecialchars($this->input->post('variabel', true))

            ];
            $this->home->updatevariabel($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Header berhasil diubah!!</div>');
            redirect('home/mydevice');
        }
    }
    public function editdevice($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->db->where('is_deleted', 0);
        $data['device'] = $this->db->get_where('device', ['id' => $id])->result_array();

        $this->form_validation->set_rules('chipid', 'Chipid', 'required|trim');
        $this->form_validation->set_rules('namadevice', 'Nama_device', 'required|trim');
        $this->form_validation->set_rules('namaheader', 'Nama_header', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Device';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/editdevice', $data, $id);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'chip_id' => htmlspecialchars($this->input->post('chipid', true)),
                'nama_device' => htmlspecialchars($this->input->post('namadevice', true)),
                'nama_header' => htmlspecialchars($this->input->post('namaheader', true))

            ];
            $this->home->updatedevice($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Device berhasil diubah!!</div>');
            redirect('home/device');
        }
    }
    public function doc_clouds()
    {
        $data['title'] = ' ';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('navbar/doc_clouds');
        $this->load->view('templates/footer');
    }
    public function doc_api()
    {
        $data['title'] = 'Documentation';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('navbar/doc_api');
        $this->load->view('templates/footer');
    }
    public function ex_clouds()
    {
        $data['title'] = '';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('navbar/ex_clouds');
        $this->load->view('templates/footer');
    }
    public function ex_api()
    {
        $data['title'] = 'Examples';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('navbar/ex_api');
        $this->load->view('templates/footer');
    }
    public function program()
    {
        $data['title'] = '';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('navbar/program');
        $this->load->view('templates/footer');
    }
    public function export()
    {

        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);

        $key_device = $this->input->post('keydevice_export');
        $nama_header = $this->input->post('header_export');
        $waktu_awal = $this->input->post('waktuawal_export');
        $waktu_akhir = $this->input->post('waktuakhir_export');
        $urutan = $this->input->post('urutan_export');

        $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        //  HEADER----------> VARIABLE
        $nama_device =  $this->db->query("SELECT*FROM device WHERE key_device='$key_device';")->row_array();
        $nama_device2 = $nama_device['nama_device'];
        $header = $this->db->query("SELECT data.code_header as code, variable.variabel as variabel FROM data
        JOIN variable ON variable.code=data.code_header
        WHERE data.key_device ='$key_device' AND data.is_deleted=0 AND data.time_add between '$waktu_awal' AND '$waktu_akhir' AND variable.nama_header = '$nama_header'
        GROUP by code_header;")->result_array();
        $nilai = $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');")->result_array();
        // ----------------------===========================--------------------------------------------
        //  EXPORT EXCEL
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        //set column dimension to auto size

        $i = 3;
        $sheet->setCellValue('A1', $nama_device2);
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Time_add');
        foreach ($header as $h) {
            $sheet->setCellValueByColumnAndRow($i, 2, $h['variabel']);
            $i++;
        }

        $baris = 3;
        $nomer = 1;
        foreach ($nilai as $n) :
            $kolom2 = 2;

            $sheet->setCellValue('A' . $baris, $nomer);
            $sheet->setCellValue('B' . $baris, $n['time_add']);
            foreach ($header as $h) :
                $sheet->setCellValue($alphabet[$kolom2] . $baris,  $n['data_' . $h['code']]);
                $kolom2++;
            endforeach;
            $nomer++;
            $baris++;
        endforeach;
        for ($a = 'A'; $a !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $a++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($a)->setAutoSize(TRUE);
        }
        $date = date('d M Y');
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Mestakung ' . $date . ' (' . $nama_device2 . ').xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        redirect('home/data_filter');
    }
}
