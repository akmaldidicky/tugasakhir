<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Postdata_model extends CI_Model
{
    public function createNilai($data)
    {
        $this->db->insert('data', $data);
        return $this->db->affected_rows();
    }
}
