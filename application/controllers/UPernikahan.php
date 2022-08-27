<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UPernikahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data = [
            'title' => 'UNDANGAN DIGITAL',
            'nm_tamu' => $this->input->get('to'),
        ];
        error_reporting(0);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['cover'] = $this->db->get_where('cover_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['lokasi'] = $this->db->get('lok_mempelai', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['musik_data'] = $this->db->get_where('musik_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['quotes'] = $this->db->get('quotes_pernikahan')->result_array();
        $data['gallery'] = $this->db->get('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['hadiah'] = $this->db->get_where('hadiah', ['id_user'])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('ucapan', 'Ucapan', 'required');
        $this->form_validation->set_rules('hadir_tidak', 'Hadir/Tidak', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('pernikahan/undangan', $data);
        } else {
            $nama = $this->input->post('nama', true);
            $ucapan = $this->input->post('ucapan', true);
            $hadir_tidak = $this->input->post('hadir_tidak', true);

            $data = [
                'nama'        => $nama,
                'ucapan'      => $ucapan,
                'hadir_tidak' => $hadir_tidak
            ];

            $this->db->insert('quotes_pernikahan', $data);
            redirect('upernikahan');
        }
    }
}
