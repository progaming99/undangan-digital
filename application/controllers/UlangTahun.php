<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UlangTahun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function info_ultah()
    {
        $cekUser = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->num_rows();

        if ($cekUser > 0) {
            redirect('dashboardultah/akhir');
        }

        $data['title'] = 'Informasi Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['ultah'] = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();

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
            $ultah_ke     = $this->input->post('ultah_ke', true);
            $uc_tambahan  = $this->input->post('uc_tambahan', true);

            $data = [
                'id_user'      => $id_user,
                'nama'         => $nama,
                'nama_lengkap' => $nama_lengkap,
                'ultah_ke'     => $ultah_ke,
                'uc_tambahan'  => $uc_tambahan
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '2048';
                $config['upload_path']          = './assets/images/ultah';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['image'];
                    if ($gambar_lama != 'pria.png') {
                        unlink(FCPATH . 'assets/images/ultah/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                    redirect('ulangtahun/info_ultah');

                    echo $this->upload->display_errors();
                }
            }
            $check = $this->db->get_where('nm_ultah', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('nm_ultah', $data);
            } else {
                $this->db->insert('nm_ultah', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Data Kamu Berhasil Disimpan!</div>');
            redirect('ulangtahun/info_lokasi');
        }
    }


    public function info_lokasi()
    {
        $data['title'] = 'Informasi Lokasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

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
            $data = [
                'judul_acara' => $this->input->post('judul_acara'),
                'alamat' => $this->input->post('alamat'),
                'nm_lokasi' => $this->input->post('nm_lokasi'),
                'tgl_acara' => $this->input->post('tgl_acara'),
                'w_mulai' => $this->input->post('w_mulai'),
                'w_selesai' => $this->input->post('w_selesai'),
                'z_waktu' => $this->input->post('z_waktu'),
                'sharelok' => $this->input->post('sharelok')
            ];
            $this->db->insert('lok_ultah', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data Kamu Berhasil Disimpan!</div>');
            redirect('ulangtahun/tambah_cover');
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

            $this->db->set('cover', $cover);

            $check = $this->db->get_where('cover_ultah', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('cover_ultah', $data);
            } else {
                $this->db->insert('cover_ultah', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Data anda berhasil diubah! </div>');
            redirect('dashboardultah/akhir');
        }
    }

    public function pengaturan()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nama'] = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['lokasi'] = $this->db->get_where('lok_ultah', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['cover'] = $this->db->get_where('cover_ultah', ['id_user' => $this->session->userdata('id_user')])->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_ultah', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/pengaturan', $data);
        $this->load->view('templates/footer');
    }

    public function edit_nama($id)
    {
        $data['title'] = 'Edit Nama';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_ultah', ['id_user' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('ultah_ke', 'Ulang Tahun', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/edit_nama', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama', true);
            $nama_lengkap = $this->input->post('nama_lengkap', true);
            $ultah_ke = $this->input->post('ultah_ke', true);
            $uc_tambahan = $this->input->post('uc_tambahan', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/images/ultah/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['foto']['image'];
                    if ($gambar_lama != 'foto.png') {
                        unlink(FCPATH . 'assets/images/ultah/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);
            $this->db->set('nama_lengkap', $nama_lengkap);
            $this->db->set('ultah_ke', $ultah_ke);
            $this->db->set('uc_tambahan', $uc_tambahan);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nm_ultah');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
    Selamat, nama berhasil diperbarui! </div>');
            redirect('ulangtahun/pengaturan');
        }
    }

    public function edit_lokasi($id)
    {
        $data['title'] = 'Edit Lokasi Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Ultah_model');
        $data['lokasi'] = $this->Ultah_model->getLokasiById($id);
        $data['zona'] = ['WIB (Indonesia Barat)', 'WIT (Indonesia Timur)', 'WITA (Indonesia Tengah)'];

        $this->form_validation->set_rules('judul_acara', 'Judul Acara', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Acara', 'required');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Pernikahan', 'required');
        $this->form_validation->set_rules('w_mulai', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('z_waktu', 'Zona Waktu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/edit_lokasi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->editDataLokasi();
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
    Selamat, lokasi ulang tahun berhasil diperbarui! </div>');
            redirect('ulangtahun/pengaturan');
        }
    }

    function update_status_kirim_wa()
    {
        $this->db->where('id', $this->input->get('id'));
        $this->db->update('list_undangan', ['status' => 1]);
    }

    public function tambah_list()
    {
        $data['title'] = 'Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->result();
        $data['list_undangan'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();
        $this->load->model('Ultah_model');
        $data['start'] = $this->uri->segment(3);
        $data['list_undangan'] = $this->Ultah_model->getAllListUndangan();
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
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/list_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->tambahDataListUndangan();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Selamat, Data Tamu Berhasil Ditambahkan!</div>');
            redirect('ulangtahun/tambah_list');
        }
    }

    public function hapus_tamu($id)
    {
        $this->load->model('Ultah_model');

        $this->Ultah_model->hapusDataUlangtahun($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('ulangtahun/tambah_list');
    }

    public function edit_tamu($id)
    {
        $data['title'] = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Ultah_model');
        $data['list'] = $this->Ultah_model->getListById($id);

        $this->form_validation->set_rules('Nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/edit_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->editDataList($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
    Data Tamu Berhasil Di Ubah! </div>');
            redirect('ulangtahun/tambah_list');
        }
    }

    public function edit_cover()
    {
        $data['title'] = 'Edit Cover Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->db->get_where('cover_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('cover', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/edit_cover', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $cover = $this->input->post('cover');

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '3096';
                $config['upload_path'] = './assets/images/ultah/cover_ultah/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['cover']['image'];
                    if ($gambar_lama != '$cover') {
                        unlink(FCPATH . 'assets/images/ultah/cover_ultah/' . $gambar_lama);
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
            $this->db->update('cover_ultah');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, cover undangan berhasil diperbarui! </div>');
            redirect('ulangtahun/pengaturan');
        }
    }

    public function gallery()
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_ultah', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/gallery', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_gallery1()
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_gallery1', $data);
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
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image'];
                    if ($gambar_lama != '$gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('nama',  $nama);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('ulangtahun/gallery');
        }
    }

    public function tambah_gallery2()
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_gallery2', $data);
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
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image2'];
                    if ($gambar_lama != '$gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('nama',  $nama);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('ulangtahun/gallery');
        }
    }

    public function tambah_gallery3()
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_gallery3', $data);
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
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image3')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image3'];
                    if ($gambar_lama != '$gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image3', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('nama',  $nama);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('ulangtahun/gallery');
        }
    }

    public function tambah_gallery4()
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_gallery4', $data);
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
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image4')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image4'];
                    if ($gambar_lama != '$gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image4', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('nama',  $nama);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('ulangtahun/gallery');
        }
    }

    public function tambah_gallery5()
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_gallery5', $data);
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
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image5')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image5'];
                    if ($gambar_lama != '$gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image5', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $check = $this->db->get_where('gallery', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('id_user', $id_user);
                $this->db->where('nama',  $nama);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('ulangtahun/gallery');
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
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_musik', $data);
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
                $config['max_size']      = '5000';
                $config['upload_path']   = './assets/musik/ulangtahun/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('musik')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['musik'];
                    if ($gambar_lama != '') {
                        unlink(FCPATH . 'assets/musik/ulangtahun/' . $gambar_lama);
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
            redirect('ulangtahun/pengaturan');
        }
    }

    public function tambah_hitung()
    {
        $data['title'] = 'Tambah Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Ultah_model');

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_hitung', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->tambahHitungMundur();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, hitung mundur berhasil ditambahkan! </div>');
            redirect('ulangtahun/pengaturan');
        }
    }

    public function tambah_amplop()
    {
        $data['title'] = 'Tambah Amplop';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Ultah_model');

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/tambah_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->tambahAmplop();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, amplop anda berhasil ditambahkan! </div>');
            redirect('ulangtahun/pengaturan');
        }
    }
}
