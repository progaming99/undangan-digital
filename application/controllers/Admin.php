<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title']  = 'Dashboard';
        $data['title1'] = 'Total Visitor Web';
        $data['title5'] = 'Data User';
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('id !=', 11);
        $data['nama'] = $this->db->get('user')->result_array();


        // Mendapatkan IP user
        $ip    = $this->input->ip_address();

        // Mendapatkan tanggal sekarang
        $date  = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");

        // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $s = $this->db->query("SELECT * FROM visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
        $ss = isset($s) ? ($s) : 0;


        // Kalau belum ada, simpan data user tersebut ke database
        if ($ss == 0) {
            $this->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $waktu . "','" . $timeinsert . "')");
        }

        // Jika sudah ada, update
        else {
            $this->db->query("UPDATE visitor SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }

        // Hitung jumlah pengunjung
        $pengunjunghariini  = $this->db->query("SELECT * FROM visitor WHERE date='" . $date . "' GROUP BY ip")->num_rows();

        $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row();

        // hitung total pengunjung
        $totalpengunjung = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0;

        $bataswaktu = time() - 300;

        // hitung pengunjung online
        $pengunjungonline  = $this->db->query("SELECT * FROM visitor WHERE online > '" . $bataswaktu . "'")->num_rows();


        $data['pengunjunghariini']  = $pengunjunghariini;
        $data['totalpengunjung']    = $totalpengunjung;
        $data['pengunjungonline']   = $pengunjungonline;

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

        $this->form_validation->set_rules('Nama', 'Nama Tamu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_pernikahan/edit_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editDataTamu();
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

    public function gallery($id)
    {
        $data['title']  = 'Menu Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['pria'] = $this->db->get_where('nm_mempelai', ['id_user' => 'id'])->row_array();
        $data['gallery'] = $this->Admin_model->getGalleryById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_pernikahan/gallery', $data);
        $this->load->view('templates/footer');
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
                $config['max_size']      = '3072';
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, musik anda berhasil ditambahkan! </div>');
            redirect('Admin/daftar_mempelai');
        }
    }
    //menu pernikahan end

    //menu ultah start
    public function daftar_ultah()
    {
        $data['title']  = 'Daftar Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pengguna'] = $this->Admin_model->getAllUser();

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

        $data['menu'] = $this->Admin_model->getMenuUltahById($id);

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
        $data['ultah'] = $this->Admin_model->getUltahById($id);

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

            $this->Admin_model->editDataUltah();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_lokasi_ultah($id)
    {
        $data['title'] = 'Form edit Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lokasi'] = $this->Admin_model->getLokasiUltahById($id);
        $data['zona'] = ['WIB (Indonesia Barat)', 'WIT (Indonesia Timur)', 'WITA (Indonesia Tengah)'];

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
            $this->Admin_model->editDataLokasiUltah();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/daftar_ultah');
        }
    }

    public function list_undangan_ultah($id)
    {
        $data['title']  = 'List Undangan Mempelai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['list'] = $this->Admin_model->getAllListUndanganUltah($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_ultah/list_undangan', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_tamu_ultah($id)
    {
        $this->Admin_model->hapusDataTamu($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Admin/list_undangan_ultah');
    }

    public function edit_tamu_ultah($id)
    {
        $data['title']  = 'Edit Tamu Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->Admin_model->getListById($id);

        $this->form_validation->set_rules('Nama', 'Nama Tamu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/menu_ultah/edit_tamu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editDataTamu();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Admin/list_undangan_ultah');
        }
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
            $this->Admin_model->tambahDataTamu();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Admin/list_undangan_ultah');
        }
    }

    public function edit_cover_ultah($id)
    {
        $data['title'] = 'Edit Cover Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cover'] = $this->Admin_model->getCoverUltahById($id);

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

            $this->Admin_model->editCoverUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat, cover undangan berhasil diperbarui! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function gallery_ultah($id)
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Admin_model->getAllGalleryUltah($id);

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
        $data['gallery'] = $this->Admin_model->getGalleryUltahById($id);

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

            $this->Admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Selamat, foto 1 berhasil diperbarui! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery2($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Admin_model->getGalleryUltahById($id);

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

            $this->Admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Selamat, foto 2 berhasil diperbarui! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery3($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Admin_model->getGalleryUltahById($id);

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

            $this->Admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Selamat, foto 3 berhasil diperbarui! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery4($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Admin_model->getGalleryUltahById($id);

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

            $this->Admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Selamat, foto 4 berhasil diperbarui! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_gallery5($id)
    {
        $data['title'] = 'Gallery Ulang Tahun';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gallery'] = $this->Admin_model->getGalleryUltahById($id);

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

            $this->Admin_model->editGalleryUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Selamat, foto 5 berhasil diperbarui! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_musik_ultah($id)
    {
        $data['title'] = 'Tambah Musik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['musik'] = $this->Admin_model->getMusikUltahById($id);

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
            $this->Admin_model->editMusikUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, musik anda berhasil ditambahkan! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_hitung_ultah($id)
    {
        $data['title'] = 'Edit Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hitung'] = $this->Admin_model->getHitungUltahById($id);

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
            $this->Admin_model->editHitungUltah();
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, hitung mundur berhasil ditambahkan! </div>');
            redirect('Admin/daftar_ultah');
        }
    }

    public function edit_amplop_ultah($id)
    {
        $data['title'] = 'Edit Amplop Ultah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['amplop'] = $this->Admin_model->getAmplopUltahById($id);

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
            $this->Admin_model->editAmplopUltah();
            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, amplop anda berhasil ditambahkan! </div>');
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Selamat, Data user berhasil diubah! </div>');
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

    public function user_akses($akses_id)
    {
        $data['title'] = 'Akses User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['akses'] = $this->db->get_where('user', ['id' => $akses_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/user_akses', $data);
        $this->load->view('templates/footer_akses');
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
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Akses telah dirubah !! </div>');
    }

    public function ubah_akses()
    {
        $menu_id = $this->input->post('menuId');
        $user_id = $this->input->post('userId');

        $data = [
            'user_id' => $user_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Akses menu berhasil diberikan!! </div>');
    }

    public function logo_web()
    {
        $data['title'] = 'Logo Web';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['logo_web'] = $this->db->get('logo_web')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/logo_web', $data);
        $this->load->view('templates/footer');
    }

    public function edit_logo_web($id)
    {
        $data['title'] = 'Logo Web';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['logo_web'] = $this->db->get_where('logo_web', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_logo_web', $data);
            $this->load->view('templates/footer');
        } else {

            $nama    = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 1024;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/logo/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['logo_web']['image'];
                    if ($gambar_lama != 'logo-web.png') {
                        unlink(FCPATH . 'wedding-2/images/wedding/wedding-1/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('logo_web');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Logo Web anda berhasil diubah! </div>');
            redirect('admin/logo_web');
        }
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
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
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
                $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center" role="alert">
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Metode Pembayaran berhasil diubah! </div>');
            redirect('admin/metode_pembayaran');
        }
    }




    public function delete_metode($id)
    {
        $data['title'] = 'Delete Metode';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('pembayaran', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        1 Data Metode Pembayaran sudah berhasil didelete </div>');
        redirect('admin/metode_pembayaran');
    }





    public function download()
    {
        $data['title'] = 'Download';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');
        $data['download'] = $this->db->get('download')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/download', $data);
        $this->load->view('templates/footer');
    }



    public function tambahdownload()
    {
        $data['title'] = 'Tambah Download';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['download'] = $this->db->get('download')->result_array();


        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambahdownload', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './assets/img/download/';
            $config['allowed_types']        = 'pdf|doc|docx';
            $config['max_size']             = 4024;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Data download belum ditambahkan </div>');
                redirect('admin/download');
            } else {
                $file           = $this->upload->data();
                $file           = $file['file_name'];
                $judul           = $this->input->post('judul', true);

                $data = [
                    'judul'                    => $judul,
                    'file'                     => $file,
                    'created_at'                => time()
                ];

                $this->db->insert('download', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Data download sudah berhasil ditambahkan </div>');
                redirect('admin/download');
            }
        }
    }



    public function editdownload($id)
    {
        $data['title'] = 'Edit Download';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['download'] = $this->db->get_where('download', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editdownload', $data);
            $this->load->view('templates/footer');
        } else {
            $judul             = $this->input->post('judul', true);

            // cek jika ada gambar yang akan diupload
            $upload_file = $_FILES['file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = 4024;
                $config['upload_path'] = './assets/img/download/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    // hapus gambar user lama
                    $file_lama = $data['download']['file'];
                    if ($file_lama != '') {
                        unlink(FCPATH . '/assets/img/download/' . $file_lama);
                    }

                    // upload gambar user baru
                    $file_baru = $this->upload->data('file_name');
                    $this->db->set('file', $file_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('judul', $judul);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('download');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Selamat, Data Download berhasil diubah! </div>');
            redirect('admin/download');
        }
    }


    public function deletedownload($id)
    {
        $data['title'] = 'Delete Download';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('download', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        1 Data Download sudah berhasil didelete </div>');
        redirect('admin/download');
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
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
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Logo Web anda berhasil diubah! </div>');
            redirect('admin/ultah_setting');
        }
    }
}
