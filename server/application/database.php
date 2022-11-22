<?php
class database
{

    var $host = "localhost";
    var $username = "root";
    var $password = "dbmesta2022";
    var $database = "mesta";
    var $koneksi = "";
    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        } else {
            echo "berhasil!";
        }
    }

    function get_data()
    {
        $data = mysqli_query($this->koneksi, "select * from data");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
    function insert_data($data)
    {

        foreach ($data as $d => $v) {
            mysqli_query($this->koneksi, "insert into data(chip_id,key_device, nama_header,code_header,data) values ('" . $v['chip_id'] . "','" . $v['key_device'] . "','" . $v['nama_header'] . "','" . $v['code_header'] . "','" . $v['data'] . "' )");
        }
    }
}
