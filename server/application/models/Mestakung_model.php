<?php

class Mestakung_model extends CI_Model
{

    public function getData_from_namaheader($nama_header, $urutan)
    {
        return $this->db->query("CALL data_header('$nama_header','$urutan');")->result_array();
    }
    public function getData_realtime($key_device)
    {
        return $this->db->query("CALL data_realtime('$key_device');")->result_array();
    }
    public function getData_limit_keydevice($key_device, $urutan, $limit)
    {
        return $this->db->query("CALL data_limit_keydevice('$key_device','$urutan',$limit);")->result_array();
    }
    public function getData_all_device($key_device, $urutan)
    {
        return $this->db->query("CALL data_all_device('$key_device','$urutan');")->result_array();
    }


    public function deleteDevice($chip_id)
    {
        // $this->db->where('api_key',$key);
        //$this->db->delete('device', ['chip_id' => $chip_id]);
        $data = [
            'time_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];

        $this->db->where('chip_id', $chip_id);
        $this->db->update('device', $data);
        return $this->db->affected_rows();

        // $this->db->delete('user',['nama'=>$nama]);
        // return $this->db->affected_rows();
    }
    public function deleteDevice_key($chip_id)
    {
        $data = [
            'is_used' => 0
        ];

        $this->db->where('chip_id', $chip_id);
        $this->db->update('device_key', $data);
        return $this->db->affected_rows();
    }

    public function createDevice($data)
    {
        $this->db->insert('device', $data);
        return $this->db->affected_rows();
    }
    public function createDevice_key($data2)
    {
        $this->db->insert('device_key', $data2);
        return $this->db->affected_rows();
    }


    public function updateDevice($data, $chip_id)
    {
        $this->db->update('device', $data, ['chip_id' => $chip_id]);
        return $this->db->affected_rows();
    }
}
