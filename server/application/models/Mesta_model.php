<?php

class Mesta_model extends CI_Model
{
    public function getData_sortir_waktu($chip_id, $urutan, $waktu_awal, $waktu_akhir)
    {
        return $this->db->query("CALL data_chipidwaktu('$chip_id','$urutan','$waktu_awal','$waktu_akhir');")->result_array();
    }
    public function getData_keydevice($key_device, $urutan, $waktu_awal, $waktu_akhir)
    {
        return  $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');")->result_array();
    }
    public function deleteVariable($nama_header, $variabel)
    {
        // $this->db->where('api_key',$key);
        $data = [
            'date_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];
        $this->db->where('nama_header', $nama_header);
        $this->db->where('variabel', $variabel);
        $this->db->update('variable', $data);
        return $this->db->affected_rows();

        // $this->db->delete('user',['nama'=>$nama]);
        // return $this->db->affected_rows();
    }
    public function deleteAplication($nama_header = null)
    {
        $data = [
            'time_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];

        $this->db->where('nama_header', $nama_header);
        $this->db->update('aplication', $data);
        return $this->db->affected_rows();
    }

    public function getDevice($key)
    {
        if ($key) {
            $this->db->select('device.chip_id, device.nama_device,device.key_device,device.time_created');
            $this->db->join('device', 'device.id_user=user.id');
            $this->db->where('device.is_deleted', 0);
            return $this->db->get_where('user', ['key' => $key])->result_array();
        }
    }
    public function getHeader($key)
    {
        if ($key) {
            $this->db->select('variable.nama_header,variable.code,variable.variabel,variable.date_created');
            $this->db->join('variable', 'variable.id_user=user.id');
            return $this->db->get_where('user', ['key' => $key])->result_array();
        }
    }
    public function getAplication($key)
    {
        if ($key) {
            $this->db->select('aplication.nama_header,aplication.time_created');
            $this->db->join('aplication', 'aplication.id_user=user.id');
            return $this->db->get_where('user', ['key' => $key])->result_array();
        }
    }

    public function createVariable($data)
    {
        $this->db->insert('variable', $data);
        return $this->db->affected_rows();
    }
    public function createAplication($data)
    {
        $this->db->insert('aplication', $data);
        return $this->db->affected_rows();
    }
    public function createDevice_key($data2)
    {
        $this->db->insert('device_key', $data2);
        return $this->db->affected_rows();
    }

    public function updateVariable($data, $nama_header, $code_header)
    {
        $this->db->where('nama_header', $nama_header);
        $this->db->update('variable', $data, ['code' => $code_header]);
        return $this->db->affected_rows();
    }
    public function updateKeydevice($data, $chip_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->update('device', $data, ['chip_id' => $chip_id]);
        return $this->db->affected_rows();
    }
}

        // public function getData_limit_header($nama_header, $urutan, $limit)
        // {
        //     return $this->db->query("CALL data_limit_header('$nama_header','$urutan',$limit);")->result_array();
        // }
        // public function getData_from_header($nama_header, $urutan)
        // {
        //     return $this->db->query("CALL data_header('$nama_header','$urutan');")->result_array();
        // }