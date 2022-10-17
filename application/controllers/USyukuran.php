<?php
defined('BASEPATH') or exit('No direct script access allowed');

class USyukuran extends CI_Controller
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
        $data['nama'] = $this->db->get_where('nm_syukuran', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['cover'] = $this->db->get_where('cover', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['musik'] = $this->db->get_where('musik_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['quotes'] = $this->db->get('quotes_syukuran')->result_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['hadiah'] = $this->db->get_where('hadiah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('ucapan', 'Ucapan', 'required');
        $this->form_validation->set_rules('hadir_tidak', 'Hadir/Tidak', 'required');

        $this->pilihTemplate($data);
        if ($this->form_validation->run()) {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama', true);
            $ucapan = $this->input->post('ucapan', true);
            $hadir_tidak = $this->input->post('hadir_tidak', true);

            $data = [
                'id_user'     => $id_user,
                'nama'        => $nama,
                'ucapan'      => $ucapan,
                'hadir_tidak' => $hadir_tidak
            ];

            $this->db->insert('quotes_syukuran', $data);
            redirect('USyukuran');
        }
    }

    function pilihTemplate($data)
    {
        $id_user = $this->session->userdata('id_user');
        $cek = $this->db->get_where('template_user', ['id_user' => $id_user])->row();
        if ($cek) {
            $get = $this->db->select('b.slug')->from('template_user a')->join('template_syukuran b', 'a.id_template = b.id', 'left')->where('a.id_user', $id_user)->get()->row();
            $template = $get->slug;

            $this->load->view("syukuran/desain/$template", $data);
        } else {
            $this->load->view('syukuran/desain/undangan', $data);
        }
    }
}
