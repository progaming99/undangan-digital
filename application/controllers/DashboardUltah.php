<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUltah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Ultah_model');
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    // public function akhir()
    // {
    //     $data['title'] = 'Beranda';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['nama'] = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/ultah/sidebar', $data);
    //     $this->load->view('templates/topbar_user', $data);
    //     $this->load->view('ultah/dashboard/ultah', $data);
    //     $this->load->view('templates/footer');
    // }

    public function pengaturan()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nama'] = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['lokasi'] = $this->db->get_where('lok_ultah', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['cover'] = $this->db->get_where('cover_ultah', ['id_user' => $this->session->userdata('id_user')])->row();
        error_reporting(0);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/pengaturan', $data);
        $this->load->view('templates/footer');
    }

    public function upgrade_paket()
    {
        $data['title'] = 'Upgrade Paket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('3')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/upgrade_paket', $data);
        $this->load->view('templates/footer');
    }

    public function metode_pembayaran()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('3')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/metode_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function shopeepay()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/shopeepay', $data);
        $this->load->view('templates/footer');
    }

    public function bri()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('3')])->row_array();
        $data['bayar'] = $this->db->get_where('transfer', ['id'])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/bri', $data);
        $this->load->view('templates/footer');
    }

    public function status_pembayaran()
    {
        $data['title'] = 'Status Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bukti'] = $this->db->get_where('pembayaran', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('3')])->row_array();
        error_reporting(0);
        $this->form_validation->set_rules('nama_pengirim', 'Nama pengirim', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/status_pembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama_pengirim = $this->input->post('nama_pengirim');

            $data = [
                'id_user'        => $id_user,
                'nama_pengirim'        => $nama_pengirim,
                'tanggal' => time(),
                'status' => 'Menunggu Verifikasi'
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/images/pembayaran/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['pembayaran']['image'];
                    if ($gambar_lama != 'pria.png') {
                        unlink(FCPATH . 'assets/images/pembayaran/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama_pengirim', $nama_pengirim);

            $check = $this->db->get_where('pembayaran', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('pembayaran', $data);
            } else {
                $this->db->insert('pembayaran', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, Pembayaran anda akan kami verifikasi, lihat undangan anda dengan cara masuk menu dasboard klik lihat undangan! </div>');
            redirect('dashboardultah/status_pembayaran');
        }
    }

    public function ulasan()
    {
        $data['title'] = 'Kirim Masukan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['ulasan'] = $this->db->get_where('ulasan', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('ulasan', 'Ulasan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/ulasan', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $ulasan   = $this->input->post('ulasan', true);

            $data = [
                'id_user'        => $id_user,
                'ulasan'    => $ulasan
            ];
            $check = $this->db->get_where('ulasan', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->where('id_user',  $id_user);
                $this->db->update('ulasan', $data);
            } else {
                $this->db->insert('ulasan', $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Ulasan Kamu Berhasil Di Tambahkan!</div>');
            redirect('dashboardultah/ulasan');
        }
    }

    public function edit_nama($id)
    {
        $data['title'] = 'Edit Nama';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_ultah', ['id_user' => $id])->row_array();
        $data['jenkel'] = ['Putra', 'Putri'];

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('ultah_ke', 'Ulang Tahun', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/edit_nama', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama', true);
            $nama_lengkap = $this->input->post('nama_lengkap', true);
            $nm_ayah = $this->input->post('nm_ayah', true);
            $nm_ibu = $this->input->post('nm_ibu', true);
            $jenis_kelamin = $this->input->post('jenis_kelamin', true);
            $urutan = $this->input->post('urutan', true);
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
            $this->db->set('nm_ayah', $nm_ayah);
            $this->db->set('nm_ibu', $nm_ibu);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->set('urutan', $urutan);
            $this->db->set('ultah_ke', $ultah_ke);
            $this->db->set('uc_tambahan', $uc_tambahan);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nm_ultah');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Selamat, data undangan berhasil diperbarui! </div>');
            redirect('DashboardUltah/pengaturan');
        }
    }

    public function edit_lokasi($id)
    {
        $data['title'] = 'Edit Lokasi Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Ultah_model');
        $data['lokasi'] = $this->Ultah_model->getLokasiById($id);
        $data['zona'] = ['WIB', 'WIT', 'WITA'];

        $this->form_validation->set_rules('judul_acara', 'Judul Acara', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Acara', 'required');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Pernikahan', 'required');
        $this->form_validation->set_rules('w_mulai', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('z_waktu', 'Zona Waktu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/edit_lokasi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->editDataLokasi();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Selamat, lokasi ulang tahun berhasil diperbarui! </div>');
            redirect('DashboardUltah/pengaturan');
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
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/list_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->tambahDataListUndangan();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Selamat, Data Tamu Berhasil Ditambahkan!</div>');
            redirect('DashboardUltah/tambah_list');
        }
    }

    public function hapus_tamu($id)
    {
        $this->load->model('Ultah_model');

        $this->Ultah_model->hapusDataUlangtahun($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('DashboardUltah/tambah_list');
    }

    public function edit_tamu($id)
    {
        $data['title'] = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Ultah_model');
        $data['list'] = $this->Ultah_model->getListById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/edit_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->editDataList($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Data Tamu Berhasil Di Ubah! </div>');
            redirect('DashboardUltah/tambah_list');
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
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/edit_cover', $data);
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
            $this->db->where('id_user', $id_user);
            $this->db->update('cover_ultah');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, cover undangan berhasil diperbarui! </div>');
            redirect('DashboardUltah/pengaturan');
        }
    }

    public function gallery()
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/pengaturan/gallery', $data);
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
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_gallery1', $data);
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

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image']['name'];

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image'];
                    if ($gambar_lama != 'gallery') {
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
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('DashboardUltah/gallery');
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
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_gallery2', $data);
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
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 2 berhasil diperbarui! </div>');
            redirect('DashboardUltah/gallery');
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
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_gallery3', $data);
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
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 3 berhasil diperbarui! </div>');
            redirect('DashboardUltah/gallery');
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
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_gallery4', $data);
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
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 4 berhasil diperbarui! </div>');
            redirect('DashboardUltah/gallery');
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
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_gallery5', $data);
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
                $this->db->where('id_user',  $id_user);
                $this->db->update('gallery', $data);
            } else {
                $this->db->insert('gallery', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 5 berhasil diperbarui! </div>');
            redirect('DashboardUltah/gallery');
        }
    }

    public function tambah_musik()
    {
        $data['title'] = 'Tambah Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik'] = $this->db->get_where('musik_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();
        error_reporting(0);

        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_musik', $data);
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
                $config['max_size']      = '8000';
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, musik anda berhasil ditambahkan! </div>');
            redirect('DashboardUltah/pengaturan');
        }
    }

    public function tambah_hitung()
    {
        $data['title'] = 'Tambah Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row_array();
        error_reporting(0);

        $this->load->model('Ultah_model');

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_hitung', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->tambahHitungMundur();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, hitung mundur berhasil ditambahkan! </div>');
            redirect('DashboardUltah/pengaturan');
        }
    }

    public function tambah_amplop()
    {
        $data['title'] = 'Tambah Amplop';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['amplop'] = $this->db->get_where('hadiah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        error_reporting(0);



        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/ultah/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('ultah/dashboard/pengaturan/tambah_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_model->tambahAmplop();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, amplop anda berhasil ditambahkan! </div>');
            redirect('DashboardUltah/pengaturan');
        }
    }

    public function desain()
    {
        $data['title'] = 'Desain Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['template_ultah'] = $this->db->get_where('template_ultah')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/ultah/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('ultah/dashboard/pengaturan/desain', $data);
        $this->load->view('templates/footer');
    }

    function simpanTemplate()
    {
        $id_template = $this->input->post('id_template');

        if (!$id_template) {
            $result = [
                'success' => false
            ];
            echo json_encode($result);
            exit;
        }

        $result = $this->Ultah_model->simpanTemplate($id_template);
        echo json_encode($result);
    }
}
