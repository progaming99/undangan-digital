<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function beranda()
    {
        // $data['harga'] = $this->db->get_where('harga', ['id' => ('1,3,4')])->row_array();
        $data['harga'] = $this->db->get('harga')->result_array();
        $this->load->model('Home_model', 'user');

        $data['ulasan'] = $this->user->getUlasan();
        $data['user'] = $this->db->get('user')->result_array();

        $this->load->view('home/index', $data);
    }

    public function lihat_lainnya()
    {
        $data['pernikahan'] = $this->db->get_where('template_pernikahan')->result_array();
        $data['ultah'] = $this->db->get_where('template_ultah')->result_array();
        $data['halal'] = $this->db->get_where('template_halal')->result_array();
        $data['syukuran'] = $this->db->get_where('template_syukuran')->result_array();

        $this->load->view('home/lihat_lainnya', $data);
    }
}
