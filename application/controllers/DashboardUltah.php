<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUltah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_dash', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function akhir()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get_where('nm_ultah', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_ultah', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('dashboard_ultah/ultah', $data);
        $this->load->view('templates/footer');
    }

    public function upgrade_paket()
    {
        $data['title'] = 'Upgrade Paket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('3')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_ultah', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('dashboard_ultah/upgrade_paket', $data);
        $this->load->view('templates/footer');
    }

    public function metode_pembayaran()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('3')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_ultah', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('dashboard_ultah/metode_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function shopeepay()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_ultah', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('dashboard_ultah/shopeepay', $data);
        $this->load->view('templates/footer');
    }

    public function bri()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['harga'] = $this->db->get_where('harga', ['id' => ('3')])->row_array();
        $data['bayar'] = $this->db->get_where('transfer', ['id'])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_ultah', $data);
        $this->load->view('templates//topbar_user', $data);
        $this->load->view('dashboard_ultah/bri', $data);
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
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates//topbar_user', $data);
            $this->load->view('dashboard_ultah/status_pembayaran', $data);
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
            $this->load->view('templates/sidebar_ultah', $data);
            $this->load->view('templates//topbar_user', $data);
            $this->load->view('dashboard_ultah/ulasan', $data);
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
}
