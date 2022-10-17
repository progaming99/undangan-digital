<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pernikahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pernikahan_model');
    }

    public function hasilc()
    {

        $getMempelai = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row();
        $mempelai =  $getMempelai->np_pria . "-" . $getMempelai->np_wanita; //jamal-putrek
        $data = [
            'title' =>  $mempelai,
            'to'    => $this->input->get('to')
        ];
        $this->load->view('pernikahan/undangan2', $data);
    }

    public function nm_mempelai_pria()
    {
        $data['title'] = 'Informasi Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('np_pria', 'Nama Panggilan', 'required|trim');
        $this->form_validation->set_rules('nl_pria', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('na_pria', 'Nama Ayah', 'required|trim');
        $this->form_validation->set_rules('ni_pria', 'Nama Ibu', 'required|trim');
        $this->form_validation->set_rules('urutan_pria', 'Urutan Anak', 'required|trim');
        $this->form_validation->set_rules('i_pria', 'Instagram', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/nm_mempelai_pria', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user   = $this->session->userdata('id_user', true);
            $np_pria   = $this->input->post('np_pria', true);
            $nl_pria   = $this->input->post('nl_pria', true);
            $na_pria   = $this->input->post('na_pria', true);
            $ni_pria   = $this->input->post('ni_pria', true);
            $i_pria    = $this->input->post('i_pria', true);
            $urutan_pria    = $this->input->post('urutan_pria', true);

            $data = [
                'id_user'   => $id_user,
                'np_pria'   => $np_pria,
                'nl_pria'   => $nl_pria,
                'na_pria'   => $na_pria,
                'ni_pria'   => $ni_pria,
                'i_pria'    => $i_pria,
                'urutan_pria'    => $urutan_pria
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/pernikahan';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Gambar anda belum ditambahkan </div>');
                    redirect('Pernikahan/nm_mempelai_pria');

                    echo $this->upload->display_errors();
                }
            }

            $check = $this->db->get_where('nm_mempelai', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('nm_mempelai', $data);
            } else {
                $this->db->insert('nm_mempelai', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, data mempelai pria berhasil tersimpan! </div>');
            redirect('Pernikahan/nm_mempelai_wanita');
        }
    }

    public function nm_mempelai_wanita()
    {
        $data['title'] = 'Data Mempelai Wanita';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('np_wanita', 'Nama Panggilan', 'required|trim');
        $this->form_validation->set_rules('nl_wanita', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('na_wanita', 'Nama Ayah', 'required|trim');
        $this->form_validation->set_rules('ni_wanita', 'Nama Ibu', 'required|trim');
        $this->form_validation->set_rules('urutan_wanita', 'Urutan Anak', 'required|trim');
        $this->form_validation->set_rules('i_wanita', 'Instagram', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/nm_mempelai_wanita', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user          = $this->session->userdata('id_user', true);
            $np_wanita        = $this->input->post('np_wanita', true);
            $nl_wanita        = $this->input->post('nl_wanita', true);
            $na_wanita        = $this->input->post('na_wanita', true);
            $ni_wanita        = $this->input->post('ni_wanita', true);
            $i_wanita         = $this->input->post('i_wanita', true);
            $urutan_wanita    = $this->input->post('urutan_wanita', true);

            $data = [
                'id_user'          => $id_user,
                'np_wanita'        => $np_wanita,
                'nl_wanita'        => $nl_wanita,
                'na_wanita'        => $na_wanita,
                'ni_wanita'        => $ni_wanita,
                'i_wanita'         => $i_wanita,
                'urutan_wanita'    => $urutan_wanita
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image2']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/pernikahan';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image2')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $check = $this->db->get_where('nm_mempelai', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('nm_mempelai', $data);
            } else {
                $this->db->insert('nm_mempelai', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, data mempelai wanita berhasil tersimpan! </div>');
            redirect('Pernikahan/info_lokasi');
        }
    }

    public function info_lokasi()
    {
        $data['title'] = 'Informasi Lokasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lokasi'] = $this->db->get_where('lok_mempelai', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['z_waktu'] = ['WIB', 'WIT', 'WITA'];

        $this->form_validation->set_rules('judul_acara', 'Judul Acara', 'required|trim');
        $this->form_validation->set_rules('alamat_acara', 'Alamat Acara', 'required|trim');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required|trim');
        $this->form_validation->set_rules('tgl_pernikahan', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('w_mulai', 'Waktu Mulai', 'required|trim');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required|trim');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required|trim');
        $this->form_validation->set_rules('sharelok', 'Share Lokasi', 'required|trim');

        $this->form_validation->set_rules('judul_acara2', 'Judul Acara', 'required|trim');
        $this->form_validation->set_rules('alamat_acara2', 'Alamat Acara', 'required|trim');
        $this->form_validation->set_rules('nm_lokasi2', 'Nama Lokasi', 'required|trim');
        $this->form_validation->set_rules('tgl_pernikahan2', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('w_mulai2', 'Waktu Mulai', 'required|trim');
        $this->form_validation->set_rules('w_selesai2', 'Waktu Selesai', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/info_lokasi', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $judul_acara   = $this->input->post('judul_acara', true);
            $alamat_acara   = $this->input->post('alamat_acara', true);
            $nm_lokasi   = $this->input->post('nm_lokasi', true);
            $tgl_pernikahan   = $this->input->post('tgl_pernikahan', true);
            $w_mulai   = $this->input->post('w_mulai', true);
            $w_selesai   = $this->input->post('w_selesai', true);
            $z_waktu   = $this->input->post('z_waktu', true);
            $sharelok   = $this->input->post('sharelok', true);

            $judul_acara2   = $this->input->post('judul_acara2', true);
            $alamat_acara2   = $this->input->post('alamat_acara2', true);
            $nm_lokasi2   = $this->input->post('nm_lokasi2', true);
            $tgl_pernikahan2   = $this->input->post('tgl_pernikahan2', true);
            $w_mulai2   = $this->input->post('w_mulai2', true);
            $w_selesai2   = $this->input->post('w_selesai2', true);
            $z_waktu2   = $this->input->post('z_waktu2', true);

            $data = [
                'id_user'        => $id_user,
                'judul_acara'    => $judul_acara,
                'alamat_acara'   => $alamat_acara,
                'nm_lokasi'      => $nm_lokasi,
                'tgl_pernikahan' => $tgl_pernikahan,
                'w_mulai'        => $w_mulai,
                'w_selesai'      => $w_selesai,
                'z_waktu'        => $z_waktu,
                'sharelok'        => $sharelok,

                'judul_acara2'   => $judul_acara2,
                'alamat_acara2'  => $alamat_acara2,
                'nm_lokasi2'     => $nm_lokasi2,
                'tgl_pernikahan2' => $tgl_pernikahan2,
                'w_mulai2'       => $w_mulai2,
                'w_selesai2'     => $w_selesai2,
                'z_waktu2'       => $z_waktu2
            ];
            $this->db->insert('lok_mempelai', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Info lokasi mempelai berhasil tersimpan!</div>');
            redirect('Pernikahan/cover_pernikahan');
        }
    }

    public function cover_pernikahan()
    {
        $data['title'] = 'Cover Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->db->get_where('cover_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('cover', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/cover_pernikahan', $data);
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
                $config['upload_path']   = './assets/images/pernikahan/cover_pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('cover', $cover);

            $check = $this->db->get_where('cover_pernikahan', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('cover_pernikahan', $data);
            } else {
                $this->db->insert('cover_pernikahan', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, Data anda berhasil diubah! </div>');
            redirect('DashboardPernikahan');
        }
    }
}
