<?php

class Lihat_syukuran extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'UNDANGAN DIGITAL',
        ];
        error_reporting(0);
        $data['user'] = $this->db->get_where('user')->row_array();
        $data['nama'] = $this->db->get_where('nm_syukuran')->row_array();
        $data['cover'] = $this->db->get_where('cover')->row_array();
        $data['musik'] = $this->db->get_where('musik_pernikahan')->row_array();
        $data['quotes'] = $this->db->get('quotes_syukuran')->result_array();
        $data['gallery'] = $this->db->get('gallery')->row_array();
        $data['hadiah'] = $this->db->get_where('hadiah', ['id_user'])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur')->row_array();

        $this->load->view('syukuran/desain/undangan', $data);
    }
}
