<?php

class Lihat_pernikahan extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'UNDANGAN DIGITAL',
            'nm_tamu' => $this->input->get('to'),
        ];
        error_reporting(0);
        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => 65])->row_array();
        $data['cover'] = $this->db->get_where('cover_pernikahan', ['id_user' => 65])->row_array();
        $data['lokasi'] = $this->db->get_where('lok_mempelai', ['id_user' => 65])->row_array();
        $data['musik_data'] = $this->db->get_where('musik_pernikahan', ['id_user' => 65])->row_array();
        $data['quotes'] = $this->db->get_where('quotes_pernikahan', ['id_user' => 65])->result_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => 65])->row_array();
        $data['hadiah'] = $this->db->get_where('hadiah', ['id_user' => 65])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => 65])->row_array();

        $this->load->view('pernikahan/desain/undangan', $data);
    }
}
