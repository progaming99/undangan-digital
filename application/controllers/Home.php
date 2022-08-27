<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function beranda()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('1,3,4')])->row_array();
        $this->load->model('Home_model', 'user');

        $data['ulasan'] = $this->user->getUlasan();
        $data['user'] = $this->db->get('user')->result_array();

        $this->load->view('home/index', $data);
    }
}
