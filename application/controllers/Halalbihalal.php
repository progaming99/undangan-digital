<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Halalbihalal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // $this->load->model('Lainnya_model');
    }

    public function info_halal()
    {
        $cekUser = $this->db->get_where('nm_halal', ['id_user' => $this->session->userdata('id_user')])->num_rows();

        if ($cekUser > 0) {
            redirect('DashboardHalal');
        }

        $data['title'] = 'Informasi Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['halal'] = $this->db->get_where('nm_halal', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['zona'] = ['WIB', 'WIT', 'WITA'];
        error_reporting(0);

        $this->form_validation->set_rules('nama_grub', 'Nama', 'required|trim');
        $this->form_validation->set_rules('judul_acara', 'Judul Acara', 'required|trim');
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Acara', 'required|trim');
        $this->form_validation->set_rules('waktu', 'Waktu Acara', 'required|trim');
        $this->form_validation->set_rules('zona_waktu', 'Zona Waktu', 'required|trim');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required|trim');
        $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('halalbihalal/info_halal', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user         = $this->session->userdata('id_user', true);
            $nama_grub       = $this->input->post('nama_grub', true);
            $judul_acara     = $this->input->post('judul_acara', true);
            $tgl_acara       = $this->input->post('tgl_acara', true);
            $waktu           = $this->input->post('waktu', true);
            $zona_waktu      = $this->input->post('zona_waktu', true);
            $nm_lokasi       = $this->input->post('nm_lokasi', true);
            $alamat_lengkap  = $this->input->post('alamat_lengkap', true);
            $sharelok  = $this->input->post('sharelok', true);

            $data = [
                'id_user'        => $id_user,
                'nama_grub'      => $nama_grub,
                'judul_acara'    => $judul_acara,
                'tgl_acara'      => $tgl_acara,
                'waktu'          => $waktu,
                'zona_waktu'     => $zona_waktu,
                'nm_lokasi'      => $nm_lokasi,
                'alamat_lengkap' => $alamat_lengkap,
                'sharelok'       => $sharelok
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/halal';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                    redirect('Halalbihalal/info_halal');

                    echo $this->upload->display_errors();
                }
            }
            $check = $this->db->get_where('nm_halal', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('id_user',  $id_user);
                $this->db->update('nm_halal', $data);
            } else {
                $this->db->insert('nm_halal', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, data kamu berhasil ditambahkan!</div>');
            redirect('Halalbihalal/hitung_mundur');
        }
    }

    public function hitung_mundur()
    {
        $data['title'] = 'Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->model('Halal_model');

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('halalbihalal/hitung_mundur', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Halal_model->tambahHitungMundur();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, hitung mundur berhasil ditambahkan! </div>');
            redirect('DashboardHalal');
        }
    }
}
