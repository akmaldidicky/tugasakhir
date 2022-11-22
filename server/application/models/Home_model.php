<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function getUser($email = null)
    {
        if ($email) {
            $this->db->where('is_deleted', 0);
            return $this->db->get_where('user', ['email' => $email])->row_array();
        }
    }
    public function createUser($data)
    {
        $this->db->insert('user', $data);
    }
    public function createUser_key($data2)
    {
        $this->db->insert('user_key', $data2);
    }
    public function getLimit_resetuser($id_user = null)
    {
        if ($id_user) {
            return $this->db->get_where('user_key', ['id_user' => $id_user])->num_rows();
        }
    }
    public function deleteUser_key($id_user = null)
    {
        $data = [
            'is_used' => 0
        ];

        $this->db->where('id_user', $id_user);
        $this->db->update('user_key', $data);
    }
    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    public function updateUser_key($id_user, $data3)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('user_key', $data3);
    }
    // ----------------------------------------- DEVICE --------------------------------------------------------------
    public function getDevice($id_user = null)
    {
        if ($id_user) {
            $this->db->order_by("id", "asc");
            $this->db->where('is_deleted', 0);
            return $this->db->get_where('device', ['id_user' => $id_user])->result_array();
        }
    }
    public function updateDevice($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('device', $data);
    }
    public function deleteDevice($id = null)
    {
        $data = [
            'time_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];

        $this->db->where('id', $id);
        $this->db->update('device', $data);
    }
    public function createDevice($data)
    {
        $this->db->insert('device', $data);
    }
    public function getDevice_header($nama_header = null)
    {
        if ($nama_header) {
            $this->db->order_by("id", "asc");
            $this->db->where('is_deleted', 0);
            return $this->db->get_where('device', ['nama_header' => $nama_header])->result_array();
        }
    }
    public function deleteDevice_key($chip_id = null)
    {
        $data = [
            'is_used' => 0
        ];

        $this->db->where('chip_id', $chip_id);
        $this->db->update('device_key', $data);
    }
    public function updateDevice_key($chip_id, $data3)
    {
        $this->db->where('chip_id', $chip_id);
        $this->db->update('device_key', $data3);
    }
    public function createDevice_key($data2)
    {
        $this->db->insert('device_key', $data2);
    }
    public function getLimit_resetdevice($chip_id = null)
    {
        if ($chip_id) {
            return $this->db->get_where('device_key', ['chip_id' => $chip_id])->num_rows();
        }
    }


    // ---------------------------------------------------------------------------------------- APLICATION _---------------------------------------------------------
    public function getAplication($id_user = null)
    {
        if ($id_user) {
            $this->db->where('is_deleted', 0);
            return $this->db->get_where('aplication', ['id_user' => $id_user])->result_array();
        }
    }
    public function deleteAplication($id = null)
    {
        $data = [
            'time_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];

        $this->db->where('id', $id);
        $this->db->update('aplication', $data);
    }
    public function createAplication($data)
    {
        $this->db->insert('aplication', $data);
    }
    // ------------------------------------------------------------------------------------------------- VARIABLE ---------------------------------------------------------------------

    public function getVariable($id_user = null)
    {
        if ($id_user) {
            $this->db->order_by("id", "asc");
            $this->db->where('is_deleted', 0);
            return $this->db->get_where('variable', ['id_user' => $id_user])->result_array();
        }
    }
    public function deleteVariable($id = null)
    {
        $data = [
            'date_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];

        $this->db->where('id', $id);
        $this->db->update('variable', $data);
    }
    public function updateVariable($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('variable', $data);
    }
    public function createVariable($data)
    {
        $this->db->insert('variable', $data);
    }

    // ------------------------------------------------------------------------------ DATA ---------------------------------------------------------
    public function deleteData($key_device = null, $waktuawal = null, $waktuakhir = null)
    {
        $data = [
            'time_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];
        $this->db->where("time_add BETWEEN '$waktuawal' AND '$waktuakhir'");
        $this->db->where('key_device', $key_device);
        $this->db->update('data', $data);
    }
public function getBanyakdata($key_device = null, $urutan = null, $waktu_awal = null, $waktu_akhir = null)
    {
        $query = $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');");
        $res   = $query->num_rows();

        //add this two line 
        $query->next_result();
        $query->free_result();
        //end of new code

        return $res;
    }
public function getData($key_device = null, $urutan = null, $waktu_awal = null, $waktu_akhir = null)
    {
        $query = $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');");
        $res   = $query->result_array();

        //add this two line 
        $query->next_result();
        $query->free_result();
        //end of new code

        return $res;
    }
 public function getHeader($key_device = null, $waktu_awal = null, $waktu_akhir = null, $nama_header2 = null)
    {
        $query = $this->db->query("SELECT data.code_header as code, variable.variabel as variabel FROM data
                JOIN variable ON variable.code=data.code_header
                WHERE data.key_device ='$key_device' AND data.is_deleted=0 AND data.time_add between '$waktu_awal' AND '$waktu_akhir' AND variable.nama_header = '$nama_header2'
                GROUP by code_header;");
        $res = $query->result_array();
        $query->next_result();
        $query->free_result();
        return $res;
    }


}
