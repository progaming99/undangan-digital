<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UlangTahun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Ultah_model');
    }

    public function info_ultah()
    {
        $cekUser = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->num_rows();

        if ($cekUser > 0) {
            redirect('DashboardUltah');
        }

        $data['title'] = 'Informasi Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['ultah'] = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['jenkel'] = ['Putra', 'Putri'];
        error_reporting(0);

        $this->form_validation->set_rules('nama', 'Nama Panggilan', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('ultah_ke', 'Ulang Tahun', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/info_ultah', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user      = $this->session->userdata('id_user', true);
            $nama         = $this->input->post('nama', true);
            $nama_lengkap = $this->input->post('nama_lengkap', true);
            $nm_ayah = $this->input->post('nm_ayah', true);
            $nm_ibu = $this->input->post('nm_ibu', true);
            $jenis_kelamin = $this->input->post('jenis_kelamin', true);
            $urutan = $this->input->post('urutan', true);
            $ultah_ke     = $this->input->post('ultah_ke', true);
            $uc_tambahan  = $this->input->post('uc_tambahan', true);

            $data = [
                'id_user'       => $id_user,
                'nama'          => $nama,
                'nama_lengkap'  => $nama_lengkap,
                'nm_ayah'       => $nm_ayah,
                'nm_ibu'        => $nm_ibu,
                'jenis_kelamin' => $jenis_kelamin,
                'urutan'        => $urutan,
                'ultah_ke'      => $ultah_ke,
                'uc_tambahan'   => $uc_tambahan
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/ultah';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                    redirect('UlangTahun/info_ultah');

                    echo $this->upload->display_errors();
                }
            }
            $check = $this->db->get_where('nm_ultah', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('id_user',  $id_user);
                $this->db->update('nm_ultah', $data);
            } else {
                $this->db->insert('nm_ultah', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, data kamu berhasil ditambahkan!</div>');
            redirect('UlangTahun/info_lokasi');
        }
    }


    public function info_lokasi()
    {
        $data['title'] = 'Informasi Lokasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lokasi'] = $this->db->get_where('lok_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['zona'] = ['WIB', 'WIT', 'WITA'];

        $this->form_validation->set_rules('judul_acara', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nm_lokasi', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tgl_acara', 'Nama', 'required|trim');
        $this->form_validation->set_rules('w_mulai', 'Nama', 'required|trim');
        $this->form_validation->set_rules('w_selesai', 'Nama', 'required|trim');
        $this->form_validation->set_rules('z_waktu', 'Nama', 'required|trim');
        $this->form_validation->set_rules('sharelok', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/info_lokasi', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user     = $this->session->userdata('id_user', true);
            $judul_acara = $this->input->post('judul_acara', true);
            $alamat      = $this->input->post('alamat', true);
            $nm_lokasi   = $this->input->post('nm_lokasi', true);
            $tgl_acara   = $this->input->post('tgl_acara', true);
            $w_mulai     = $this->input->post('w_mulai', true);
            $w_selesai   = $this->input->post('w_selesai', true);
            $z_waktu     = $this->input->post('z_waktu', true);
            $sharelok    = $this->input->post('sharelok', true);

            $data = [
                'id_user'     => $id_user,
                'judul_acara' => $judul_acara,
                'alamat'      => $alamat,
                'nm_lokasi'   => $nm_lokasi,
                'tgl_acara'   => $tgl_acara,
                'w_mulai'     => $w_mulai,
                'w_selesai'   => $w_selesai,
                'z_waktu'     => $z_waktu,
                'sharelok'    => $sharelok
            ];
            $check = $this->db->get_where('lok_ultah', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('id_user',  $id_user);
                $this->db->update('lok_ultah', $data);
            } else {
                $this->db->insert('lok_ultah', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, data kamu berhasil ditambahkan!</div>');
            redirect('UlangTahun/tambah_cover');
        }
    }

    public function tambah_cover()
    {
        $data['title'] = 'Cover Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->db->get_where('cover_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('cover', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_cover', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $cover = $this->input->post('cover');

            $data = [
                'id_user'        => $id_user,
                'cover'        => $cover
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '1024';
                $config['upload_path']   = './assets/images/ultah/cover_ultah/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['cover']['image'];
                    if ($gambar_lama != 'pria.png') {
                        unlink(FCPATH . 'assets/images/ultah/cover_ultah/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $check = $this->db->get_where('cover_ultah', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('id_user',  $id_user);
                $this->db->update('cover_ultah', $data);
            } else {
                $this->db->insert('cover_ultah', $data);
            }
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, cover undangan berhasil ditambahkan! </div>');
            redirect('DashboardUltah');
        }
    }
}
