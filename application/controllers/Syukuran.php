<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Syukuran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function info_syukuran()
    {
        $cekUser = $this->db->get_where('nm_syukuran', ['id_user' => $this->session->userdata('id_user')])->num_rows();

        if ($cekUser > 0) {
            redirect('DashboardSyukuran');
        }

        $data['title'] = 'Informasi Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->db->get_where('nm_syukuran', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['zona'] = ['WIB', 'WIT', 'WITA'];
        $data['jk'] = ['Putra', 'Putri'];
        error_reporting(0);

        $this->form_validation->set_rules('nm_panggilan', 'Nama Panggilan', 'required|trim');
        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('jenkel', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Acara', 'required|trim');
        $this->form_validation->set_rules('w_mulai', 'Waktu Mulai', 'required|trim');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required|trim');
        $this->form_validation->set_rules('z_waktu', 'Zona Waktu', 'required|trim');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/info_syukuran', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user       = $this->session->userdata('id_user', true);
            $nm_panggilan  = $this->input->post('nm_panggilan', true);
            $nm_lengkap    = $this->input->post('nm_lengkap', true);
            $jenkel        = $this->input->post('jenkel', true);
            $tgl_acara     = $this->input->post('tgl_acara', true);
            $w_mulai       = $this->input->post('w_mulai', true);
            $w_selesai     = $this->input->post('w_selesai', true);
            $z_waktu       = $this->input->post('z_waktu', true);
            $nm_lokasi     = $this->input->post('nm_lokasi', true);
            $alamat        = $this->input->post('alamat', true);

            $data = [
                'id_user'      => $id_user,
                'nm_panggilan' => $nm_panggilan,
                'nm_lengkap'   => $nm_lengkap,
                'jenkel'       => $jenkel,
                'tgl_acara'    => $tgl_acara,
                'w_mulai'      => $w_mulai,
                'w_selesai'    => $w_selesai,
                'z_waktu'      => $z_waktu,
                'nm_lokasi'    => $nm_lokasi,
                'alamat'       => $alamat
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/syukuran';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                    redirect('Syukuran/info_syukuran');

                    echo $this->upload->display_errors();
                }
            }
            $check = $this->db->get_where('nm_syukuran', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('id_user',  $id_user);
                $this->db->update('nm_syukuran', $data);
            } else {
                $this->db->insert('nm_syukuran', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, data kamu berhasil ditambahkan!</div>');
            redirect('Syukuran/hitung_mundur');
        }
    }

    public function hitung_mundur()
    {
        $data['title'] = 'Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->model('Syukuran_model');

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/hitung_mundur', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_model->tambahHitungMundur();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, hitung mundur berhasil ditambahkan! </div>');
            redirect('DashboardSyukuran');
        }
    }
}
