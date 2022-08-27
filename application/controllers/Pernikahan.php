<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pernikahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
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

    public function info_pernikahan()
    {
        $data['title'] = 'Informasi Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('np_pria', 'Nama Panggilan', 'required|trim');
        $this->form_validation->set_rules('nl_pria', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('na_pria', 'Nama Ayah', 'required|trim');
        $this->form_validation->set_rules('ni_pria', 'Nama Ibu', 'required|trim');
        $this->form_validation->set_rules('i_pria', 'Instagram', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/info_pernikahan', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user   = $this->session->userdata('id_user', true);
            $np_pria   = $this->input->post('np_pria', true);
            $nl_pria   = $this->input->post('nl_pria', true);
            $na_pria   = $this->input->post('na_pria', true);
            $ni_pria   = $this->input->post('ni_pria', true);
            $i_pria    = $this->input->post('i_pria', true);

            $data = [
                'id_user'   => $id_user,
                'np_pria'   => $np_pria,
                'nl_pria'   => $nl_pria,
                'na_pria'   => $na_pria,
                'ni_pria'   => $ni_pria,
                'i_pria'    => $i_pria
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/pernikahan';

                $this->load->library('upload', $config);

                // hapus gambar user lama
                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'pria.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Gambar anda belum ditambahkan </div>');
                    redirect('pernikahan/info_pernikahan');

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
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, data mempelai pria berhasil tersimpan! </div>');
            redirect('pernikahan/nm_mempelai_wanita');
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
        $this->form_validation->set_rules('i_wanita', 'Instagram', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/nm_mempelai_wanita', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user   = $this->session->userdata('id_user', true);
            $np_wanita   = $this->input->post('np_wanita', true);
            $nl_wanita   = $this->input->post('nl_wanita', true);
            $na_wanita   = $this->input->post('na_wanita', true);
            $ni_wanita   = $this->input->post('ni_wanita', true);
            $i_wanita    = $this->input->post('i_wanita', true);

            $data = [
                'id_user'   => $id_user,
                'np_wanita'   => $np_wanita,
                'nl_wanita'   => $nl_wanita,
                'na_wanita'   => $na_wanita,
                'ni_wanita'   => $ni_wanita,
                'i_wanita'    => $i_wanita
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image2']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/pernikahan';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nm_mempelai']['image2'];
                    if ($gambar_lama != 'wanita.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);

                    // $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    // Gambar anda belum ditambahkan </div>');
                    // redirect('pernikahan/nm_mempelai_wanita');
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, data mempelai wanita berhasil tersimpan! </div>');
            redirect('pernikahan/info_lokasi');
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
            $this->load->view('templates/topbar', $data);
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
            $check = $this->db->get_where('lok_mempelai', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('lok_mempelai', $data);
            } else {
                $this->db->insert('lok_mempelai', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Info lokasi mempelai berhasil tersimpan!</div>');
            redirect('pernikahan/cover_pernikahan');
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
            $this->load->view('templates/topbar', $data);
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
                    // hapus gambar user lama
                    $gambar_lama = $data['cover']['image'];
                    if ($gambar_lama != 'pria.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/cover_pernikahan/' . $gambar_lama);
                    }

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
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Data anda berhasil diubah! </div>');
            redirect('dashboard/akhir');
        }
    }

    public function pengaturan()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nm_pernikahan'] = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['nm_list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['lok_mempelai'] = $this->db->get_where('lok_mempelai', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['cover_mempelai'] = $this->db->get_where('cover_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_akhir', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pernikahan/pengaturan', $data);
        $this->load->view('templates/footer');
    }

    public function edit_nama_mempelai($id)
    {
        $data['title'] = 'Mempelai Pria';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('np_pria', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('nl_pria', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('na_pria', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('ni_pria', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('i_pria', 'Instagram', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/edit_nama_mempelai', $data);
            $this->load->view('templates/footer');
        } else {
            $np_pria = $this->input->post('np_pria', true);
            $nl_pria = $this->input->post('nl_pria', true);
            $na_pria = $this->input->post('na_pria', true);
            $ni_pria = $this->input->post('ni_pria', true);
            $i_pria = $this->input->post('i_pria', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/images/pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['logo_web']['image'];
                    if ($gambar_lama != 'logo-web.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('np_pria', $np_pria);
            $this->db->set('nl_pria', $nl_pria);
            $this->db->set('na_pria', $na_pria);
            $this->db->set('ni_pria', $ni_pria);
            $this->db->set('i_pria', $i_pria);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nm_mempelai');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
    Data Mempelai Pria Berhasil Di Ubah! </div>');
            redirect('pernikahan/pengaturan');
        }
    }

    public function edit_mempelai_wanita($id)
    {
        $data['title'] = 'Mempelai Wanita';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('np_wanita', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('nl_wanita', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('na_wanita', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('ni_wanita', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('i_wanita', 'Instagram', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/edit_mempelai_wanita', $data);
            $this->load->view('templates/footer');
        } else {
            $np_wanita = $this->input->post('np_wanita', true);
            $nl_wanita = $this->input->post('nl_wanita', true);
            $na_wanita = $this->input->post('na_wanita', true);
            $ni_wanita = $this->input->post('ni_wanita', true);
            $i_wanita = $this->input->post('i_wanita', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image2']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/images/pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['logo_web']['image2'];
                    if ($gambar_lama != 'logo-web.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('np_wanita', $np_wanita);
            $this->db->set('nl_wanita', $nl_wanita);
            $this->db->set('na_wanita', $na_wanita);
            $this->db->set('ni_wanita', $ni_wanita);
            $this->db->set('i_wanita', $i_wanita);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nm_mempelai');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
    Data Mempelai Wanita Berhasil Di Ubah! </div>');
            redirect('pernikahan/pengaturan');
        }
    }

    public function edit_lok_pernikahan($id)
    {
        $data['title'] = 'Edit Data Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pernikahan_model');
        $data['lokasi'] = $this->Pernikahan_model->getLokasiById($id);
        $data['zona'] = ['WIB (Indonesia Barat)', 'WIT (Indonesia Timur)', 'WITA (Indonesia Tengah)'];

        $this->form_validation->set_rules('judul_acara', 'Judul Acara', 'required');
        $this->form_validation->set_rules('alamat_acara', 'Alamat Acara', 'required');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('tgl_pernikahan', 'Tanggal Pernikahan', 'required');
        $this->form_validation->set_rules('w_mulai', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('z_waktu', 'Zona Waktu', 'required');

        $this->form_validation->set_rules('judul_acara2', 'Judul Acara', 'required');
        $this->form_validation->set_rules('alamat_acara2', 'Alamat Acara', 'required');
        $this->form_validation->set_rules('nm_lokasi2', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('tgl_pernikahan2', 'Tanggal Pernikahan', 'required');
        $this->form_validation->set_rules('w_mulai2', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('w_selesai2', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('z_waktu2', 'Zona Waktu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/edit_lok_pernikahan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->editDataLokasi();
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
    Data Lokasi Pernikahan Berhasil Di Edit! </div>');
            redirect('pernikahan/pengaturan');
        }
    }

    function update_status_kirim_wa()
    {
        $this->db->where('id', $this->input->get('id'));
        $this->db->update('list_undangan', ['status' => 1]);
    }

    public function list_undangan()
    {
        $data['title'] = 'List Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->result();
        $data['list_undangan'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();
        $this->load->model('Pernikahan_model');
        $data['start'] = $this->uri->segment(3);
        $data['list_undangan'] = $this->Pernikahan_model->getAllListUndangan();
        error_reporting(0);

        foreach ($data['list'] as $list) {
            $data['undangan'][] = [
                'id' => $list->id,
                'id_user' => $list->id_user,
                'nama' => $list->nama,
                'no_hp' => $list->no_hp,
                'status' => $list->status,
                // 'wa' => '<button type="button" onclick="sendWa(' . $list->no_hp . ',\'' . $list->nama . '\')" class="btn btn-success">Success</button>'s
            ];
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/list_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->tambahDataListUndangan();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Data Kamu Berhasil Disimpan!</div>');
            redirect('pernikahan/list_undangan');
        }
    }

    public function hapus_list_undangan($id)
    {
        $this->load->model('Pernikahan_model');

        $this->Pernikahan_model->hapusDataPernikahan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('pernikahan/list_undangan');
    }

    public function edit_list_undangan($id)
    {
        $data['title'] = 'Edit Data Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pernikahan_model');
        $data['list'] = $this->Pernikahan_model->getListById($id);

        $this->form_validation->set_rules('Nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/edit_list_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->editDataList($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
    Data Tamu Berhasil Di Ubah! </div>');
            redirect('pernikahan/list_undangan');
        }
    }

    public function edit_cover_mempelai()
    {
        $data['title'] = 'Informasi Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['cover'] = $this->db->get_where('cover_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('cover', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/edit_cover_mempelai', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $cover = $this->input->post('cover');

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '3096';
                $config['upload_path'] = './assets/images/pernikahan/cover_pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['cover_pernikahan']['image'];
                    if ($gambar_lama != 'default.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/cover_pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('id_user',  $id_user);
            $this->db->where('cover', $cover);
            $this->db->update('cover_pernikahan');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, cover mempelai berhasil di edit! </div>');
            redirect('pernikahan/pengaturan');
        }
    }

    public function gallery_mempelai()
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_akhir', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pernikahan/gallery_mempelai', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_gallery1()
    {
        $data['title'] = 'Gallery Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_gallery1', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama');

            $data = [
                'id_user'        => $id_user,
                'nama'        => $nama
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '1024';
                $config['upload_path']   = './assets/images/pernikahan/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['image'];
                    if ($gambar_lama != 'plus.png|jpeg') {
                        unlink(FCPATH . 'assets/images/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);

            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('pernikahan/gallery_mempelai');
        }
    }
    public function tambah_gallery2()
    {
        $data['title'] = 'Gallery Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_gallery2', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama');

            $data = [
                'id_user'        => $id_user,
                'nama'        => $nama
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image2']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = '1024';
                $config['upload_path']   = './assets/images/pernikahan/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['image2'];
                    if ($gambar_lama != 'plus.png') {
                        unlink(FCPATH . 'assets/images/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);

            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 2 berhasil diperbarui! </div>');
            redirect('pernikahan/gallery_mempelai');
        }
    }
    public function tambah_gallery3()
    {
        $data['title'] = 'Gallery Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_gallery3', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama');

            $data = [
                'id_user'        => $id_user,
                'nama'        => $nama
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image3']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = '1024';
                $config['upload_path']   = './assets/images/pernikahan/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image3')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['image3'];
                    if ($gambar_lama != 'plus.png') {
                        unlink(FCPATH . 'assets/images/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image3', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);

            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 3 berhasil diperbarui! </div>');
            redirect('pernikahan/gallery_mempelai');
        }
    }
    public function tambah_gallery4()
    {
        $data['title'] = 'Gallery Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_gallery4', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama');

            $data = [
                'id_user'        => $id_user,
                'nama'        => $nama
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image4']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = '1024';
                $config['upload_path']   = './assets/images/pernikahan/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image4')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['image4'];
                    if ($gambar_lama != 'plus.png') {
                        unlink(FCPATH . 'assets/images/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image4', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);

            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 4 berhasil diperbarui! </div>');
            redirect('pernikahan/gallery_mempelai');
        }
    }
    public function tambah_gallery5()
    {
        $data['title'] = 'Gallery Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_gallery5', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama');

            $data = [
                'id_user'        => $id_user,
                'nama'        => $nama
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image5']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = '1024';
                $config['upload_path']   = './assets/images/pernikahan/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image5')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['image5'];
                    if ($gambar_lama != 'plus.png') {
                        unlink(FCPATH . 'assets/images/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image5', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);

            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 5 berhasil diperbarui! </div>');
            redirect('pernikahan/gallery_mempelai');
        }
    }

    public function tambah_musik()
    {
        $data['title'] = 'Tambah Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik_data'] = $this->db->get_where('musik_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_musik', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama');

            $data = [
                'id_user'        => $id_user,
                'nama'        => $nama
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['musik']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'mp3';
                $config['max_size']      = '6000';
                $config['upload_path']   = './assets/musik/pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('musik')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['musik'];
                    if ($gambar_lama != '') {
                        unlink(FCPATH . 'assets/musik/pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('musik', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);

            $check = $this->db->get_where('musik_pernikahan', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('musik_pernikahan', $data);
            } else {
                $this->db->insert('musik_pernikahan', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, musik anda berhasil ditambahkan! </div>');
            redirect('pernikahan/pengaturan');
        }
    }

    public function tambah_hitung()
    {
        $data['title'] = 'Tambah Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pernikahan_model');

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_hitung', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->tambahHitungMundur();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, hitung mundur berhasil ditambahkan! </div>');
            redirect('pernikahan/pengaturan');
        }
    }

    public function tambah_amplop()
    {
        $data['title'] = 'Tambah Amplop';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pernikahan_model');

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pernikahan/tambah_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->tambahAmplop();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, amplop anda berhasil ditambahkan! </div>');
            redirect('pernikahan/pengaturan');
        }
    }
}
