<?php

class Mestakung_model extends CI_Model
{
    public function getMestakung($ch = null, $cd = null)
    {


        if ($cd !== null) {
            return $this->db->get_where('device', ['code_d' => $cd])->result_array();
        } else {
            $this->db->where('nama_device', $ch);
            return $this->db->get('device')->result_array();
        }
        // else {

        //     $this->db->limit($device);
        //     $this->db->order_by('id', 'desc');
        //     $this->db->select('user.nama,device.nama_device,data.arus,data.tegangan,data.daya,data.daya_apa');
        //     $this->db->join('device', 'user.key=device.api_key');
        //     $this->db->join('data', 'data.chip_id=device.chip_id');
        //     return $this->db->get_where('user', ['key' => $device])->result_array();
        // }
    }

    //     public function deleteMestakung($key)
    //     {
    //         $this->db->delete('user', ['key' => $key]);
    //         return $this->db->affected_rows();

    //         // $this->db->delete('user',['nama'=>$nama]);
    //         // return $this->db->affected_rows();
    //     }

    //     public function createMestakung($data)
    //     {
    //         $this->db->insert('user', $data);
    //         return $this->db->affected_rows();
    //     }


    //     public function updateMestakung($data, $nama)
    //     {
    //         $this->db->update('user', $data, ['nama' => $nama]);
    //         return $this->db->affected_rows();
    //     }
}
