<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardSyukuran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Syukuran_model');
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_syukuran', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('syukuran/dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function pengaturan()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['info'] = $this->db->get_where('nm_syukuran', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row();
        error_reporting(0);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('syukuran/dashboard/pengaturan', $data);
        $this->load->view('templates/footer');
    }

    public function upgrade_paket()
    {
        $data['title'] = 'Upgrade Paket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => 5])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('syukuran/dashboard/upgrade_paket', $data);
        $this->load->view('templates/footer');
    }

    public function metode_pembayaran()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => 5])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('syukuran/dashboard/metode_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function shopeepay()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => 5])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('syukuran/dashboard/shopeepay', $data);
        $this->load->view('templates/footer');
    }

    public function bri()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => 5])->row_array();
        $data['bayar'] = $this->db->get_where('transfer', ['id'])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('syukuran/dashboard/bri', $data);
        $this->load->view('templates/footer');
    }

    public function status_pembayaran()
    {
        $data['title'] = 'Status Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bukti'] = $this->db->get_where('pembayaran', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => 5])->row_array();
        error_reporting(0);
        $this->form_validation->set_rules('nama_pengirim', 'Nama pengirim', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/status_pembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama_pengirim = $this->input->post('nama_pengirim');

            $data = [
                'id_user'        => $id_user,
                'nama_pengirim'        => $nama_pengirim,
                'status'        => 'Menunggu Pembayaran',
                'tanggal' => time()
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '2058';
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Pembayaran anda akan kami verifikasi, lihat undangan anda dengan cara masuk menu dasboard klik lihat undangan! </div>');
            redirect('DashboardSyukuran/status_pembayaran');
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
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/ulasan', $data);
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
            redirect('DashboardSyukuran/ulasan');
        }
    }

    public function edit_info_syukuran($id)
    {
        $data['title'] = 'Edit Info Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->db->get_where('nm_syukuran', ['id_user' => $id])->row_array();
        $data['zona'] = ['WIB', 'WIT', 'WITA'];
        $data['jk'] = ['Putra', 'Putri'];

        $this->form_validation->set_rules('nm_panggilan', 'Nama Panggilan', 'required|trim');
        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('jenkel', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Acara', 'required|trim');
        $this->form_validation->set_rules('w_mulai', 'Waktu Mulai', 'required|trim');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required|trim');
        $this->form_validation->set_rules('z_waktu', 'Zona Waktu', 'required|trim');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required|trim');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/edit_info_syukuran', $data);
            $this->load->view('templates/footer');
        } else {
            $nm_panggilan  = $this->input->post('nm_panggilan', true);
            $nm_lengkap    = $this->input->post('nm_lengkap', true);
            $jenkel        = $this->input->post('jenkel', true);
            $tgl_acara     = $this->input->post('tgl_acara', true);
            $w_mulai       = $this->input->post('w_mulai', true);
            $w_selesai     = $this->input->post('w_selesai', true);
            $z_waktu       = $this->input->post('z_waktu', true);
            $nm_lokasi     = $this->input->post('nm_lokasi', true);
            $alamat        = $this->input->post('alamat', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/images/syukuran/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['foto']['image'];
                    if ($gambar_lama != 'foto.png') {
                        unlink(FCPATH . 'assets/images/syukuran/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nm_panggilan', $nm_panggilan);
            $this->db->set('nm_lengkap', $nm_lengkap);
            $this->db->set('jenkel', $jenkel);
            $this->db->set('tgl_acara', $tgl_acara);
            $this->db->set('w_mulai', $w_mulai);
            $this->db->set('w_selesai', $w_selesai);
            $this->db->set('z_waktu', $z_waktu);
            $this->db->set('nm_lokasi', $nm_lokasi);
            $this->db->set('alamat', $alamat);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nm_syukuran');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Selamat, data undangan berhasil diperbarui! </div>');
            redirect('DashboardSyukuran/pengaturan');
        }
    }

    public function tamu_undangan()
    {
        $data['title'] = 'Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->result();
        $data['list_undangan'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();

        $data['start'] = $this->uri->segment(3);
        $data['list_undangan'] = $this->Syukuran_model->getAllListUndangan();
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
        $this->form_validation->set_rules('no_hp', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/daftar_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_model->tambahDataListUndangan();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Selamat, Data Tamu Berhasil Ditambahkan!</div>');
            redirect('DashboardSyukuran/tamu_undangan');
        }
    }

    public function hapus_tamu_undangan($id)
    {


        $this->Syukuran_model->hapusDataSyukuran($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('DashboardSyukuran/tamu_undangan');
    }

    public function edit_tamu_undangan($id)
    {
        $data['title'] = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $data['list'] = $this->Syukuran_model->getListById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/edit_tamu_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_model->editDataList($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Data Tamu Berhasil Di Ubah! </div>');
            redirect('DashboardSyukuran/tamu_undangan');
        }
    }

    public function edit_cover()
    {
        $data['title'] = 'Edit Cover Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->db->get_where('cover', ['id_user' => $this->session->userdata('id_user')])->row_array();
        error_reporting(0);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/edit_cover', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user =  $this->session->userdata('id_user');
            $nama = $this->input->post('nama', true);

            $data = [
                'id_user'        => $id_user,
                'nama'        => $nama
            ];

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '3096';
                $config['upload_path'] = './assets/images/syukuran/cover/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['image'];
                    if ($gambar_lama != 'default.png') {
                        unlink(FCPATH . 'assets/images/syukuran/cover/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $check = $this->db->get_where('cover', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('nama', $nama);
                $this->db->where('id_user',  $id_user);
                $this->db->update('cover', $data);
            } else {
                $this->db->insert('cover', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, cover undangan berhasil di edit! </div>');
            redirect('DashboardSyukuran/pengaturan');
        }
    }

    public function gallery()
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('syukuran/dashboard/pengaturan/gallery', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_gallery1()
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/tambah_gallery1', $data);
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
                $config['upload_path']   = './assets/images/syukuran/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image']['name'];

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/syukuran/gallery/' . $gambar_lama);
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
        Selamat, gambar 1 berhasil ditambahkan! </div>');
            redirect('DashboardSyukuran/gallery');
        }
    }

    public function tambah_gallery2()
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/tambah_gallery2', $data);
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
                $config['upload_path']   = './assets/images/syukuran/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image2']['name'];

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image2'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/syukuran/gallery/' . $gambar_lama);
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
        Selamat, gambar 2 berhasil ditambahkan! </div>');
            redirect('DashboardSyukuran/gallery');
        }
    }

    public function tambah_gallery3()
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/tambah_gallery3', $data);
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
                $config['upload_path']   = './assets/images/syukuran/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image3']['name'];

                if ($this->upload->do_upload('image3')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image3'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/syukuran/gallery/' . $gambar_lama);
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
        Selamat, gambar 3 berhasil ditambahkan! </div>');
            redirect('DashboardSyukuran/gallery');
        }
    }

    public function tambah_gallery4()
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/tambah_gallery4', $data);
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
                $config['upload_path']   = './assets/images/syukuran/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image4']['name'];

                if ($this->upload->do_upload('image4')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image4'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/syukuran/gallery/' . $gambar_lama);
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
        Selamat, gambar 4 berhasil ditambahkan! </div>');
            redirect('DashboardSyukuran/gallery');
        }
    }

    public function tambah_gallery5()
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/tambah_gallery5', $data);
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
                $config['upload_path']   = './assets/images/syukuran/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image5']['name'];

                if ($this->upload->do_upload('image5')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image5'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/syukuran/gallery/' . $gambar_lama);
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
        Selamat, gambar 5 berhasil ditambahkan! </div>');
            redirect('DashboardSyukuran/gallery');
        }
    }

    public function tambah_musik()
    {
        $data['title'] = 'Tambah Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik_data'] = $this->db->get_where('musik_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row_array();
        error_reporting(0);

        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/tambah_musik', $data);
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
                $config['max_size']      = '7000';
                $config['upload_path']   = './assets/musik/syukuran/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('musik')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['musik'];
                    if ($gambar_lama != '') {
                        unlink(FCPATH . 'assets/musik/syukuran/' . $gambar_lama);
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
            redirect('DashboardSyukuran/pengaturan');
        }
    }

    public function edit_hitung_mundur($id)
    {
        $data['title'] = 'Edit Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        error_reporting(0);


        $data['hitung'] = $this->Syukuran_model->getHitungById($id);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/edit_hitung_mundur', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_model->editHitungMundur();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, hitung mundur berhasil diperbarui! </div>');
            redirect('DashboardSyukuran/pengaturan');
        }
    }

    public function amplop()
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
            $this->load->view('templates/syukuran/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('syukuran/dashboard/pengaturan/amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_model->tambahAmplop();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, Pembayaran anda berhasil ditambahkan! </div>');
            redirect('DashboardSyukuran/pengaturan');
        }
    }

    public function desain()
    {
        $data['title'] = 'Desain Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['template_syukuran'] = $this->db->get_where('template_syukuran')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/syukuran/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('syukuran/dashboard/pengaturan/desain', $data);
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

        $result = $this->Syukuran_model->simpanTemplate($id_template);
        echo json_encode($result);
    }
}
