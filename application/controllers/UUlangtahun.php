<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UUlangtahun extends CI_Controller
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
        $data['nama'] = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['cover'] = $this->db->get_where('cover_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['lokasi'] = $this->db->get('lok_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['musik_data'] = $this->db->get_where('musik_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['quotes'] = $this->db->get('quotes_ultah')->result_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['hadiah'] = $this->db->get_where('hadiah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('ucapan', 'Ucapan', 'required');
        $this->form_validation->set_rules('hadir_tidak', 'Hadir/Tidak', 'required');

        if ($this->form_validation->run() == false) {
            $this->pilihTemplate($data);
        } else {
            $nama = $this->input->post('nama', true);
            $ucapan = $this->input->post('ucapan', true);
            $hadir_tidak = $this->input->post('hadir_tidak', true);

            $data = [
                'nama'        => $nama,
                'ucapan'      => $ucapan,
                'hadir_tidak' => $hadir_tidak
            ];

            $this->db->insert('quotes_ultah', $data);
            redirect('UUlangtahun');
        }
    }

    function pilihTemplate($data)
    {
        $id_user = $this->session->userdata('id_user');
        $cek = $this->db->get_where('template_user', ['id_user' => $id_user])->row();

        if ($cek) {
            $get = $this->db->select('b.slug')->from('template_user a')->join('template_pernikahan b', 'a.id_template = b.id', 'left')->where('a.id_user', $id_user)->get()->row();
            $template = $get->slug;
            return $this->load->view("ultah/desain/$template");
        } else {
            return $this->load->view("ultah/desain/undangan");
        }
    }
}
