<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function getUlasan()
    {
        $query = "SELECT `ulasan`. *, `user`. `nama`
                  FROM `ulasan` JOIN `user`
                  ON `ulasan`. `id_user` = `user`. `id` 
        ";
        return $this->db->query($query)->result_array();
    }
}
