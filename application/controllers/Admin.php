<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Ultah_admin_model');
        $this->load->model('Halal_admin_model');
        $this->load->model('Syukuran_admin_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title']  = 'Dashboard';
        $data['title5'] = 'Data User';
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('id !=', 1);
        $data['nama'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    //menu pernikahan start
    public function daftar_mempelai()
    {
        $data['title']  = 'Daftar Mempelai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('id !=', 1);
        $data['pengguna'] = $this->Admin_model->getAllUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_pernikahan/index', $data);
        $this->load->view('templates/footer');
    }

    public function menu_pernikahan($id)
    {
        $data['title']  = 'Menu Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        error_reporting(0);

        // $data['pria'] = $this->db->get_where('nm_mempelai', ['id_user' => 'id'])->row_array();
        $data['menu'] = $this->Admin_model->getMenuById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_pernikahan/menu', $data);
        $this->load->view('templates/footer');
    }

    public function edit_mempelai_pria($id)
    {
        $data['title'] = 'Edit Data Mempelai Pria';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mempelai'] = $this->Admin_model->getMempelaiById($id);

        $this->form_validation->set_rules('np_pria', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('nl_pria', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('na_pria', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('ni_pria', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('urutan_pria', 'Urutan Anak', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_mempelai_pria', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/images/pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['pernikahan']['image'];
                    if ($gambar_lama != 'mempelai.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Admin_model->editDataMempelaiPria();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }

    public function hapus_mempelai($id)
    {
        $this->Admin_model->hapusDataMempelai($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Admin/mempelai_wanita');
    }

    public function edit_mempelai_wanita($id)
    {
        $data['title'] = 'Edit Data Mempelai Wanita';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mempelai'] = $this->Admin_model->getMempelaiById($id);

        $this->form_validation->set_rules('np_wanita', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('nl_wanita', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('na_wanita', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('ni_wanita', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('urutan_wanita', 'Urutan Anak', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_mempelai_wanita', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image2']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets/images/pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['pernikahan']['image2'];
                    if ($gambar_lama != 'mempelai.png') {
                        unlink(FCPATH . 'assets/images/pernikahan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Admin_model->editDataMempelaiWanita();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }

    public function edit_lokasi_mempelai($id)
    {
        $data['title'] = 'Form edit Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lokasi'] = $this->Admin_model->getLokasiById($id);
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

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_lokasi_mempelai', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editDataLokasi();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }

    public function list_undangan()
    {
        $data['title']  = 'List Undangan Mempelai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['list'] = $this->Admin_model->getAllListUndangan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_pernikahan/list_undangan', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_tamu($id)
    {
        $this->Admin_model->hapusDataTamu($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Admin/list_undangan');
    }

    public function edit_tamu($id)
    {
        $data['title']  = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->Admin_model->getListById($id);

        $this->form_validation->set_rules('nama', 'Nama Tamu', 'required');
        $this->form_validation->set_rules('no_hp', 'Nama Tamu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editDataTamu($id);
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/list_undangan');
        }
    }

    public function tambah_tamu()
    {
        $data['title']  = 'Tambah Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/tambah_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->tambahDataTamu();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Admin/list_undangan');
        }
    }

    public function edit_cover_pernikahan($id)
    {
        $data['title'] = 'Informasi Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->Admin_model->getCoverPernikahanByid($id);

        $this->form_validation->set_rules('cover', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_cover', $data);
            $this->load->view('templates/footer');
        } else {
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
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->Admin_model->editCoverPernikahan();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }

    // public function gallery($id)
    // {
    //     $data['title']  = 'Menu Gallery';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     // $data['pria'] = $this->db->get_where('nm_mempelai', ['id_user' => 'id'])->row_array();
    //     error_reporting(0);
    //     $data['gallery'] = $this->Admin_model->getGalleryPernikahanByid($id);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/menu_pernikahan/gallery', $data);
    //     $this->load->view('templates/footer');
    // }

    public function gallery($id)
    {
        $data['title'] = 'Informasi Pernikahan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Admin_model->getGalleryPernikahanByid($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/gallery', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '3096';
                $config['upload_path'] = './assets/images/pernikahan/gallery/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->Admin_model->editGalleryPernikahan();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }

    public function edit_musik($id)
    {
        $data['title'] = 'Edit Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik_data'] = $this->Admin_model->getMusikById($id);

        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_musik', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['musik']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'mp3';
                $config['max_size']      = '8000';
                $config['upload_path']   = './assets/musik/pernikahan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('musik')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['pernikahan']['musik'];
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
            $this->Admin_model->editMusik();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }

    public function edit_hitung($id)
    {
        $data['title'] = 'Tambah Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pernikahan_model');
        $data['hitung'] = $this->Admin_model->getHitungByid($id);
        // error_reporting(0);


        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_hitung', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editHitungMundur();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }

    public function edit_amplop($id)
    {
        $data['title'] = 'Tambah Amplop';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['amplop'] = $this->Admin_model->getAmplopByid($id);
        error_reporting(0);

        $this->load->model('Pernikahan_model');

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editAmplop();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_mempelai');
        }
    }
    //menu pernikahan end

    //MENU ULTAH START--------------------------------------------------------------------->
    public function daftar_ultah()
    {
        $data['title']  = 'Daftar Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->where('id !=', 1);
        $data['pengguna'] = $this->Ultah_admin_model->getAllUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_ultah/index', $data);
        $this->load->view('templates/footer');
    }

    public function menu_ultah($id)
    {
        $data['title']  = 'Menu Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->Ultah_admin_model->getMenuById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_ultah/menu', $data);
        $this->load->view('templates/footer');
    }

    public function edit_nama_ultah($id)
    {
        $data['title'] = 'Edit Data Mempelai Wanita';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenkel'] = ['Putra', 'Putri'];

        $data['ultah'] = $this->Ultah_admin_model->getUltahById($id);

        $this->form_validation->set_rules('nama', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('ultah_ke', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('uc_tambahan', 'Nama Ayah', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_nama_ultah', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets/images/ultah/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['ultah']['image'];
                    if ($gambar_lama != 'default.png') {
                        unlink(FCPATH . 'assets/images/ultah/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Ultah_admin_model->editDataUltah();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_lokasi_ultah($id)
    {
        $data['title'] = 'Form edit Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lokasi'] = $this->Ultah_admin_model->getLokasiUltahById($id);
        $data['zona'] = ['WIB', 'WIT', 'WITA'];

        $this->form_validation->set_rules('judul_acara', 'Judul Acara', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Acara', 'required');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Pernikahan', 'required');
        $this->form_validation->set_rules('w_mulai', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('w_selesai', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('z_waktu', 'Zona Waktu', 'required');
        $this->form_validation->set_rules('sharelok', 'Share Lokasi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_lokasi_ultah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_admin_model->editDataLokasiUltah($id);
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function list_undangan_ultah()
    {
        $data['title']  = 'List Undangan Mempelai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        error_reporting(0);

        $data['list'] = $this->Ultah_admin_model->getAllTamuUltah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_ultah/list_undangan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_tamu_ultah()
    {
        $data['title']  = 'Tambah Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/tambah_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_admin_model->tambahDataTamu();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Admin/list_undangan_ultah');
        }
    }

    public function hapus_tamu_ultah($id)
    {
        $this->Ultah_admin_model->hapusDataTamu($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Admin/list_undangan_ultah');
    }

    public function edit_tamu_ultah($id)
    {
        $data['title']  = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->Ultah_admin_model->getListById($id);

        $this->form_validation->set_rules('nama', 'Nama Tamu', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP Tamu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_admin_model->editDataTamu($id);
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/list_undangan_ultah');
        }
    }

    public function edit_cover_ultah($id)
    {
        $data['title'] = 'Edit Cover Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->Ultah_admin_model->getCoverUltahById($id);

        $this->form_validation->set_rules('cover', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_cover_ultah', $data);
            $this->load->view('templates/footer');
        } else {
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

            $this->Ultah_admin_model->editCoverUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function gallery_ultah($id)
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['gallery'] = $this->Ultah_admin_model->getAllGalleryUltah($id);
        $data['gallery'] = $this->Ultah_admin_model->getGalleryUltahById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_ultah/edit_gallery_ultah', $data);
        $this->load->view('templates/footer');
    }

    public function edit_gallery1($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Ultah_admin_model->getGalleryUltahById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_gallery1', $data);
            $this->load->view('templates/footer');
        } else {
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

            $this->Ultah_admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery2($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Ultah_admin_model->getGalleryUltahById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_gallery2', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image2']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image2']['name'];

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image2'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Ultah_admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery3($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Ultah_admin_model->getGalleryUltahById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_gallery3', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image3']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image3']['name'];

                if ($this->upload->do_upload('image3')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image3'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image3', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Ultah_admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery4($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Ultah_admin_model->getGalleryUltahById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_gallery4', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image4']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image4']['name'];

                if ($this->upload->do_upload('image4')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image4'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image4', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Ultah_admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery5($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Ultah_admin_model->getGalleryUltahById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_gallery5', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image5']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2058';
                $config['upload_path']   = './assets/images/ultah/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image5']['name'];

                if ($this->upload->do_upload('image5')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image5'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/ultah/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image5', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Ultah_admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_musik_ultah($id)
    {
        $data['title'] = 'Tambah Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik'] = $this->Ultah_admin_model->getMusikUltahById($id);

        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_musik_ultah', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['musik']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'mp3';
                $config['max_size']      = '7000';
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
            $this->Ultah_admin_model->editMusik();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_hitung_ultah($id)
    {
        $data['title'] = 'Edit Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->Ultah_admin_model->getHitungUltahById($id);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_hitung_mundur', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_admin_model->editHitungUltah();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_amplop_ultah($id)
    {
        $data['title'] = 'Edit Amplop Ultah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['amplop'] = $this->Ultah_admin_model->getAmplopUltahById($id);

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Ultah_admin_model->editAmplopUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    //menu ultah end
    public function edit_user($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title']  = 'Dashboard';
        $data['title1'] = 'Total Visitor Web';
        $data['title2'] = 'Social Media';
        $data['title3'] = 'Home';
        $data['title4'] = 'Judul & Slogan';
        $data['title5'] = 'Data Ucapan Tamu';
        $this->load->model('users_model');
        $data['user'] = $this->users_model->getUsersById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_user', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->users_model->editDataUser();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('admin');
        }
    }

    public function hapus_user($id)
    {
        $this->load->model('Users_model');
        $this->Users_model->hapusDataUsers($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin');
    }

    public function role()
    {
        $data['title'] = 'Akses Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
        Akses telah dirubah !! </div>');
    }

    // metode pembayaran
    public function metode_pembayaran()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['pembayaran'] = $this->db->get('pembayaran')->result_array();

        $this->form_validation->set_rules('nama_pembayaran', 'Nama Pembayaran', 'required');
        $this->form_validation->set_rules('no_rek', 'No Rek', 'required');
        $this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'required');
        $this->form_validation->set_rules('wa', 'Whatsapp', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/metode_pembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './front-end/assets/img/pembayaran/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
                Metode Pembayaran belum ditambahkan </div>');
                redirect('admin/metode_pembayaran');
            } else {
                $gambar             = $this->upload->data();
                $gambar             = $gambar['file_name'];
                $nama_pembayaran    = $this->input->post('nama_pembayaran', true);
                $no_rek             = $this->input->post('no_rek', true);
                $metode             = $this->input->post('metode_pembayaran', true);
                $wa                 = $this->input->post('wa', true);

                $data = [
                    'nama_pembayaran'   => $nama_pembayaran,
                    'image'             => $gambar,
                    'no_rek'            => $no_rek,
                    'metode_pembayaran' => $metode,
                    'wa'                => $wa
                ];


                $this->db->insert('pembayaran', $data);
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">
                Metode Pembayaran sudah berhasil ditambahkan </div>');
                redirect('admin/metode_pembayaran');
            }
        }
    }

    public function edit_metode($id)
    {
        $data['title'] = 'Edit Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pembayaran'] = $this->db->get_where('pembayaran', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama_pembayaran', 'Nama Pembayaran', 'required');
        $this->form_validation->set_rules('no_rek', 'No Rek', 'required');
        $this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'required');
        $this->form_validation->set_rules('wa', 'Whatsapp', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_metode', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_pembayaran    = $this->input->post('nama_pembayaran', true);
            $no_rek             = $this->input->post('no_rek', true);
            $metode             = $this->input->post('metode_pembayaran', true);
            $wa                 = $this->input->post('wa', true);

            // cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './front-end/assets/img/pembayaran/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['pembayaran']['image'];
                    if ($gambar_lama != '') {
                        unlink(FCPATH . './front-end/assets/img/pembayaran/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama_pembayaran', $nama_pembayaran);
            $this->db->set('no_rek', $no_rek);
            $this->db->set('metode_pembayaran', $metode);
            $this->db->set('wa', $wa);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('pembayaran');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Metode Pembayaran berhasil diubah! </div>');
            redirect('admin/metode_pembayaran');
        }
    }

    public function delete_metode($id)
    {
        $data['title'] = 'Delete Metode';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('pembayaran', ['id' => $id]);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
        1 Data Metode Pembayaran sudah berhasil didelete </div>');
        redirect('admin/metode_pembayaran');
    }

    // menu ulang tahun
    public function ultah_setting()
    {
        $data['title'] = 'Ultah Setting';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nm_ultah'] = $this->db->get('nm_ultah')->result_array();
        $data['lokasi'] = $this->db->get('lok_ultah')->result_array();
        $data['foto'] = $this->db->get('cover_ultah')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_ultah', $data);
        $this->load->view('templates/footer');
    }

    public function lok_ultah($id)
    {
        $data['title'] = 'Logo Web';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['lokasi'] = $this->db->get_where('lok_ultah', ['id' => $id])->row_array();

        $this->form_validation->set_rules('judul_acara', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Nama', 'required');
        $this->form_validation->set_rules('nm_lokasi', 'Nama', 'required');
        $this->form_validation->set_rules('tgl_acara', 'Nama', 'required');
        $this->form_validation->set_rules('w_mulai', 'Nama', 'required');
        $this->form_validation->set_rules('w_selesai', 'Nama', 'required');
        $this->form_validation->set_rules('z_waktu', 'Nama', 'required');
        $this->form_validation->set_rules('sharelok', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_lok_ultah', $data);
            $this->load->view('templates/footer');
        } else {
            $judul_acara = $this->input->post('judul_acara', true);
            $alamat = $this->input->post('alamat', true);
            $nm_lokasi = $this->input->post('nm_lokasi', true);
            $tgl_acara = $this->input->post('tgl_acara', true);
            $w_mulai = $this->input->post('w_mulai', true);
            $w_selesai = $this->input->post('w_selesai', true);
            $z_waktu = $this->input->post('z_waktu', true);
            $sharelok = $this->input->post('sharelok', true);

            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets1/images/hero-image/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['hero_image']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/hero-image/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('judul_acara', $judul_acara);
            $this->db->set('alamat', $alamat);
            $this->db->set('nm_lokasi', $nm_lokasi);
            $this->db->set('tgl_acara', $tgl_acara);
            $this->db->set('w_mulai', $w_mulai);
            $this->db->set('w_selesai', $w_selesai);
            $this->db->set('z_waktu', $z_waktu);
            $this->db->set('sharelok', $sharelok);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('lok_ultah');
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
    Logo Web anda berhasil diubah! </div>');
            redirect('admin/ultah_setting');
        }
    }

    public function edit_cover($id)
    {
        $data['title'] = 'Nama Setting';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['foto'] = $this->db->get_where('cover_ultah', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('cover', 'Nama', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/cover_ultah', $data);
            $this->load->view('templates/footer');
        } else {
            $cover = $this->input->post('cover', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];
            $upload_gambar = $_FILES['image2']['name'];
            $upload_gambar = $_FILES['image3']['name'];
            $upload_gambar = $_FILES['image4']['name'];
            $upload_gambar = $_FILES['image5']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/img/cover_ultah/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['logo_web']['image'];
                    if ($gambar_lama != 'yaemiko.png') {
                        unlink(FCPATH . 'assets/img/cover_ultah/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                    $this->db->set('image2', $gambar_baru);
                    $this->db->set('image3', $gambar_baru);
                    $this->db->set('image4', $gambar_baru);
                    $this->db->set('image5', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('cover', $cover);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('cover_ultah');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
    Logo Web anda berhasil diubah! </div>');
            redirect('admin/ultah_setting');
        }
    }
    //ULTAH END--------------------------------------------------------------------------------------

    public function daftar_halal()
    {
        $data['title']  = 'Daftar User Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->where('id !=', 1);
        $data['pengguna'] = $this->Halal_admin_model->getAllUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_halal/index', $data);
        $this->load->view('templates/footer');
    }

    public function menu_halal($id)
    {
        $data['title']  = 'Menu Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        error_reporting(0);

        // $data['pria'] = $this->db->get_where('nm_mempelai', ['id_user' => 'id'])->row_array();
        $data['menu'] = $this->Halal_admin_model->getMenuById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_halal/menu', $data);
        $this->load->view('templates/footer');
    }

    public function edit_info_halal($id)
    {
        $data['title'] = 'Edit Info Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->Halal_admin_model->getHalalById($id);
        $data['zona'] = ['WIB', 'WIT', 'WITA'];

        $this->form_validation->set_rules('nama_grub', 'Nama', 'required|trim');
        $this->form_validation->set_rules('judul_acara', 'Judul Acara', 'required|trim');
        $this->form_validation->set_rules('tgl_acara', 'Tanggal Acara', 'required|trim');
        $this->form_validation->set_rules('waktu', 'Waktu Acara', 'required|trim');
        $this->form_validation->set_rules('zona_waktu', 'Zona Waktu', 'required|trim');
        $this->form_validation->set_rules('nm_lokasi', 'Nama Lokasi', 'required|trim');
        $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|trim');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_info_halal', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/images/halal/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['foto']['image'];
                    if ($gambar_lama != 'foto.png') {
                        unlink(FCPATH . 'assets/images/halal/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Halal_admin_model->editDataHalal();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function tamu_halal()
    {
        $data['title']  = 'Tamu Undangan Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['list'] = $this->Halal_admin_model->getAllTamuHalal();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_halal/tamu_halal', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_tamu_halal($id)
    {
        $this->Halal_admin_model->hapusDataTamu($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Admin/tamu_halal');
    }

    public function edit_tamu_halal($id)
    {
        $data['title']  = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->Halal_admin_model->getListById($id);

        $this->form_validation->set_rules('nama', 'Nama Tamu', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Halal_admin_model->editDataTamu($id);
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/tamu_halal');
        }
    }

    public function tambah_tamu_halal()
    {
        $data['title']  = 'Tambah Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/tambah_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Halal_admin_model->tambahDataTamu();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Admin/tamu_halal');
        }
    }

    public function edit_foto_halal($id)
    {
        $data['title'] = 'Informasi Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['foto'] = $this->Halal_admin_model->getFotoHalalById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_foto', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '3096';
                $config['upload_path'] = './assets/images/halal/foto/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->Halal_admin_model->editFotoHalal();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function gallery_halal($id)
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Halal_admin_model->getGalleryHalalById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_halal/gallery', $data);
        $this->load->view('templates/footer');
    }

    public function edit_gallery_halal1($id)
    {
        $data['title'] = 'Gallery Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Halal_admin_model->getGalleryHalalById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_gallery1', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/halal/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image']['name'];

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/halal/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Halal_admin_model->editGalleryHalal();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function edit_gallery_halal2($id)
    {
        $data['title'] = 'Gallery Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Halal_admin_model->getGalleryHalalById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_gallery2', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image2']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/halal/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image2']['name'];

                if ($this->upload->do_upload('image2')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image2'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/halal/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image2', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Halal_admin_model->editGalleryHalal();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function edit_gallery_halal3($id)
    {
        $data['title'] = 'Gallery Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Halal_admin_model->getGalleryHalalById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_gallery3', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image3']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/halal/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image3']['name'];

                if ($this->upload->do_upload('image3')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image3'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/halal/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image3', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Halal_admin_model->editGalleryHalal();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function edit_gallery_halal4($id)
    {
        $data['title'] = 'Gallery Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Halal_admin_model->getGalleryHalalById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_gallery4', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image4']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/halal/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image4']['name'];

                if ($this->upload->do_upload('image4')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image4'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/halal/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image4', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Halal_admin_model->editGalleryHalal();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function edit_gallery_halal5($id)
    {
        $data['title'] = 'Gallery Halal bi Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Halal_admin_model->getGalleryHalalById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_gallery5', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image5']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/images/halal/gallery/';

                $this->load->library('upload', $config);

                //cek jika ada gambar yang akan diupload
                $upload_gambar = $_FILES['image5']['name'];

                if ($this->upload->do_upload('image5')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['gallery']['image5'];
                    if ($gambar_lama != 'gallery') {
                        unlink(FCPATH . 'assets/images/halal/gallery/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image5', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Halal_admin_model->editGalleryHalal();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function edit_musik_halal($id)
    {
        $data['title'] = 'Tambah Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik'] = $this->Halal_admin_model->getMusikHalalById($id);

        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_musik', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['musik']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'mp3';
                $config['max_size']      = '7000';
                $config['upload_path']   = './assets/musik/halal/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('musik')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama']['musik'];
                    if ($gambar_lama != '') {
                        unlink(FCPATH . 'assets/musik/halal/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('musik', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->Halal_admin_model->editMusik();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function edit_hitung_halal($id)
    {
        $data['title'] = 'Edit Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->Halal_admin_model->getHitungHalalById($id);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_hitung_mundur', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Halal_admin_model->editHitungHalal();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    public function edit_amplop_Halal($id)
    {
        $data['title'] = 'Edit Amplop Halal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['amplop'] = $this->Halal_admin_model->getAmplopHalalById($id);

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_halal/edit_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Halal_admin_model->editAmplopHalal();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_halal');
        }
    }

    // End halal--------------------------------------------------------->

    public function daftar_syukuran()
    {
        $data['title']  = 'Daftar User Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->where('id !=', 1);

        $data['pengguna'] = $this->Syukuran_admin_model->getAllUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_syukuran/index', $data);
        $this->load->view('templates/footer');
    }

    public function menu_syukuran($id)
    {
        $data['title']  = 'Menu Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        error_reporting(0);

        // $data['pria'] = $this->db->get_where('nm_mempelai', ['id_user' => 'id'])->row_array();
        $data['menu'] = $this->Syukuran_admin_model->getMenuById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_syukuran/menu', $data);
        $this->load->view('templates/footer');
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
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('admin/menu_syukuran/edit_info_syukuran', $data);
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
            redirect('Admin/daftar_syukuran');
        }
    }

    public function tamu_syukuran()
    {
        $data['title'] = 'Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->Syukuran_admin_model->getAllTamuSyukuran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_syukuran/daftar_tamu', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_tamu_syukuran($id)
    {


        $this->Syukuran_admin_model->hapusDataSyukuran($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Admin/tamu_syukuran');
    }

    public function edit_tamu_undangan($id)
    {
        $data['title'] = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->Syukuran_admin_model->getListById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar_user', $data);
            $this->load->view('admin/menu_syukuran/edit_tamu_undangan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_admin_model->editDataTamu($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Data Tamu Berhasil Di Ubah! </div>');
            redirect('Admin/tamu_syukuran');
        }
    }

    public function tambah_tamu_syukuran()
    {
        $data['title']  = 'Tambah Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/tambah_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_admin_model->tambahDataTamu();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Admin/tamu_syukuran');
        }
    }

    public function edit_cover_syukuran($id)
    {
        $data['title'] = 'Cover Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->Syukuran_admin_model->getCoverById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_cover', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '3096';
                $config['upload_path'] = './assets/images/syukuran/cover/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->Syukuran_admin_model->editCover();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function gallery_syukuran($id)
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Syukuran_admin_model->getGalleryById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_syukuran/gallery', $data);
        $this->load->view('templates/footer');
    }

    public function edit_gallery_syukuran1($id)
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Syukuran_admin_model->getGalleryById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_gallery1', $data);
            $this->load->view('templates/footer');
        } else {
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

            $this->Syukuran_admin_model->editGallery();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function edit_gallery_syukuran2($id)
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Syukuran_admin_model->getGalleryById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_gallery2', $data);
            $this->load->view('templates/footer');
        } else {
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

            $this->Syukuran_admin_model->editGallery();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function edit_gallery_syukuran3($id)
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Syukuran_admin_model->getGalleryById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_gallery3', $data);
            $this->load->view('templates/footer');
        } else {
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

            $this->Syukuran_admin_model->editGallery();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function edit_gallery_syukuran4($id)
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Syukuran_admin_model->getGalleryById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_gallery4', $data);
            $this->load->view('templates/footer');
        } else {
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

            $this->Syukuran_admin_model->editGallery();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function edit_gallery_syukuran5($id)
    {
        $data['title'] = 'Gallery Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Syukuran_admin_model->getGalleryById($id);

        $this->form_validation->set_rules('nama', 'Nama cover', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_gallery5', $data);
            $this->load->view('templates/footer');
        } else {
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

            $this->Syukuran_admin_model->editGallery();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function edit_musik_syukuran($id)
    {
        $data['title'] = 'Tambah Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik'] = $this->Syukuran_admin_model->getMusikById($id);

        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_musik', $data);
            $this->load->view('templates/footer');
        } else {
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
            $this->Syukuran_admin_model->editMusik();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function edit_hitung_mundur_syukuran($id)
    {
        $data['title'] = 'Edit Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->Syukuran_admin_model->getHitungById($id);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_hitung_mundur', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_admin_model->editHitung();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }

    public function edit_amplop_syukuran($id)
    {
        $data['title'] = 'Edit Amplop Syukuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['amplop'] = $this->Syukuran_admin_model->getAmplopById($id);

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('an', 'Atas Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_syukuran/edit_amplop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Syukuran_admin_model->editAmplop();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_syukuran');
        }
    }
}
