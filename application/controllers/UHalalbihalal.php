<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UHalalbihalal extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'UNDANGAN DIGITAL',
            'nm_tamu' => $this->input->get('to'),
        ];

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_halal', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['foto'] = $this->db->get_where('foto', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['musik_data'] = $this->db->get_where('musik_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['quotes'] = $this->db->get_where('quotes_halal', ['id_user' => $this->session->userdata('id_user')])->result_array();
        $data['template_halal'] = $this->db->get_where('template_halal')->result();
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

            $this->db->insert('quotes_pernikahan', $data);
            redirect('UHalalbihalal');
        }
    }

    function pilihTemplate($data)
    {
        $id_user = $this->session->userdata('id_user');
        $cek = $this->db->get_where('template_user', ['id_user' => $id_user])->row();
        if ($cek) {
            $get = $this->db->select('b.slug')->from('template_user a')->join('template_halal b', 'a.id_template = b.id', 'left')->where('a.id_user', $id_user)->get()->row();
            $template = $get->slug;

            $this->load->view("halalbihalal/desain/$template", $data);
        } else {
            $this->load->view('halalbihalal/desain/undangan', $data);
        }
    }
}
