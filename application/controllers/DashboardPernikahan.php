<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardPernikahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pernikahan_model');
    }

    public function index()
    {
        // $cekUser = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->num_rows();

        // if ($cekUser > 0) {
        //     redirect('DashboardPernikahan');
        // }

        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_syukuran', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('pernikahan/dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    // public function akhir()
    // {
    //     $data['title'] = 'Beranda';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/pernikahan/sidebar', $data);
    //     $this->load->view('templates/topbar_user', $data);
    //     $this->load->view('pernikahan/dashboard/index', $data);
    //     $this->load->view('templates/footer');
    // }

    public function pengaturan()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nm_pernikahan'] = $this->db->get_where('nm_mempelai', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['nm_list'] = $this->db->get_where('list_undangan', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['lok_mempelai'] = $this->db->get_where('lok_mempelai', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['cover_mempelai'] = $this->db->get_where('cover_pernikahan', ['id_user' => $this->session->userdata('id_user')])->row();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row();
        error_reporting(0);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('pernikahan/dashboard/pengaturan', $data);
        $this->load->view('templates/footer');
    }

    public function upgrade_paket()
    {
        $data['title'] = 'Upgrade Paket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id'])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('pernikahan/dashboard/upgrade_paket', $data);
        $this->load->view('templates/footer');
    }

    public function metode_pembayaran()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id'])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('pernikahan/dashboard/metode_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function shopeepay()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('pernikahan/dashboard/shopeepay', $data);
        $this->load->view('templates/footer');
    }

    public function bri()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id'])->row_array();
        $data['bayar'] = $this->db->get_where('transfer', ['id'])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('pernikahan/dashboard/bri', $data);
        $this->load->view('templates/footer');
    }

    public function status_pembayaran()
    {
        $data['title'] = 'Status Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bukti'] = $this->db->get_where('pembayaran', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id'])->row_array();
        error_reporting(0);
        $this->form_validation->set_rules('nama_pengirim', 'Nama pengirim', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/status_pembayaran', $data);
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Pembayaran anda akan kami verifikasi, lihat undangan anda dengan cara masuk menu dasboard klik lihat undangan! </div>');
            redirect('DashboardPernikahan/status_pembayaran');
        }
    }

    public function kirim_masukan()
    {
        $data['title'] = 'Kirim Masukan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['ulasan'] = $this->db->get_where('ulasan', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('ulasan', 'Ulasan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/kirim_masukan', $data);
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
            redirect('DashboardPernikahan/kirim_masukan');
        }
    }

    public function edit_mempelai_pria($id)
    {
        $data['title'] = 'Mempelai Pria';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nama'] = $this->db->get_where('nm_mempelai', ['id_user' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('np_pria', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('nl_pria', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('na_pria', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('ni_pria', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('urutan_pria', 'Urutan Anak', 'required');
        $this->form_validation->set_rules('i_pria', 'Instagram', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/edit_mempelai_pria', $data);
            $this->load->view('templates/footer');
        } else {
            $np_pria = $this->input->post('np_pria', true);
            $nl_pria = $this->input->post('nl_pria', true);
            $na_pria = $this->input->post('na_pria', true);
            $ni_pria = $this->input->post('ni_pria', true);
            $urutan_pria = $this->input->post('urutan_pria', true);
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
            $this->db->set('urutan_pria', $urutan_pria);
            $this->db->set('i_pria', $i_pria);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nm_mempelai');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Data Mempelai Pria Berhasil Di Ubah! </div>');
            redirect('DashboardPernikahan/pengaturan');
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
        $this->form_validation->set_rules('urutan_wanita', 'Urutan Anak', 'required');
        $this->form_validation->set_rules('i_wanita', 'Instagram', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/edit_mempelai_wanita', $data);
            $this->load->view('templates/footer');
        } else {
            $np_wanita = $this->input->post('np_wanita', true);
            $nl_wanita = $this->input->post('nl_wanita', true);
            $na_wanita = $this->input->post('na_wanita', true);
            $ni_wanita = $this->input->post('ni_wanita', true);
            $urutan_wanita = $this->input->post('urutan_wanita', true);
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
            $this->db->set('urutan_wanita', $urutan_wanita);
            $this->db->set('i_wanita', $i_wanita);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nm_mempelai');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Data Mempelai Wanita Berhasil Di Ubah! </div>');
            redirect('DashboardPernikahan/pengaturan');
        }
    }

    public function edit_lok_pernikahan($id)
    {
        $data['title'] = 'Edit Data Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pernikahan_model');
        $data['lokasi'] = $this->Pernikahan_model->getLokasiById($id);
        $data['z_waktu'] = ['WIB', 'WIT', 'WITA'];

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
        $this->form_validation->set_rules('sharelok', 'Bagikan Lokasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/edit_lok_pernikahan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->editDataLokasi();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Data Lokasi Pernikahan Berhasil Di Edit! </div>');
            redirect('DashboardPernikahan/pengaturan');
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
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/list_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->tambahDataListUndangan();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Data Kamu Berhasil Disimpan!</div>');
            redirect('DashboardPernikahan/list_undangan');
        }
    }

    public function hapus_list_undangan($id)
    {
        $this->load->model('Pernikahan_model');

        $this->Pernikahan_model->hapusDataPernikahan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('DashboardPernikahan/list_undangan');
    }

    public function edit_list_undangan($id)
    {
        $data['title'] = 'Edit Data Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pernikahan_model');
        $data['list'] = $this->Pernikahan_model->getListById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/edit_list_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->editDataList($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Data Tamu Berhasil Di Ubah! </div>');
            redirect('DashboardPernikahan/list_undangan');
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
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/edit_cover_mempelai', $data);
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
                $config['max_size'] = '3096';
                $config['upload_path'] = './assets/images/pernikahan/cover_pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $check = $this->db->get_where('cover_pernikahan', ['id_user' => $id_user])->row();

            if ($check->id_user == $id_user) {
                $this->db->set('cover', $cover);
                $this->db->where('id_user',  $id_user);
                $this->db->update('cover_pernikahan', $data);
            } else {
                $this->db->insert('cover_pernikahan', $data);
            }

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, cover mempelai berhasil di edit! </div>');
            redirect('DashboardPernikahan/pengaturan');
        }
    }

    public function gallery_mempelai()
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('pernikahan/dashboard/pengaturan/gallery_mempelai', $data);
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
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_gallery1', $data);
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 1 berhasil diperbarui! </div>');
            redirect('DashboardPernikahan/gallery_mempelai');
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
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_gallery2', $data);
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 2 berhasil diperbarui! </div>');
            redirect('DashboardPernikahan/gallery_mempelai');
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
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_gallery3', $data);
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 3 berhasil diperbarui! </div>');
            redirect('DashboardPernikahan/gallery_mempelai');
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
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_gallery4', $data);
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 4 berhasil diperbarui! </div>');
            redirect('DashboardPernikahan/gallery_mempelai');
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
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_gallery5', $data);
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, gambar 5 berhasil diperbarui! </div>');
            redirect('DashboardPernikahan/gallery_mempelai');
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
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_musik', $data);
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, musik anda berhasil ditambahkan! </div>');
            redirect('DashboardPernikahan/pengaturan');
        }
    }

    public function tambah_hitung()
    {
        $data['title'] = 'Tambah Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->db->get_where('hitung_mundur', ['id_user' => $this->session->userdata('id_user')])->row_array();
        error_reporting(0);

        $this->load->model('Pernikahan_model');

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_hitung', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->tambahHitungMundur();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, hitung mundur berhasil ditambahkan! </div>');
            redirect('DashboardPernikahan/pengaturan');
        }
    }

    public function tambah_amplop()
    {
        $data['title'] = 'Tambah Amplop';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['amplop'] = $this->db->get_where('hadiah', ['id_user' => $this->session->userdata('id_user')])->row_array();
        error_reporting(0);

        $this->load->model('Pernikahan_model');

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/pernikahan/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('pernikahan/dashboard/pengaturan/tambah_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pernikahan_model->tambahAmplop();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, amplop anda berhasil ditambahkan! </div>');
            redirect('DashboardPernikahan/pengaturan');
        }
    }

    public function desain()
    {
        $data['title'] = 'Desain Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->db->get_where('gallery', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['template_pernikahan'] = $this->db->get_where('template_pernikahan')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/pernikahan/sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('pernikahan/dashboard/pengaturan/desain', $data);
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

        $result = $this->Pernikahan_model->simpanTemplate($id_template);
        echo json_encode($result);
    }
}
