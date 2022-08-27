<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_dash', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'MY PROFILE';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_dash', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'EDIT PROFILE';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Full Nama', 'required|trim');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_dash', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, profil berhasil diperbarui! </div>');
            redirect('user/profile');
        }
    }

    public function gantipassword()
    {
        $data['title'] = 'GANTI PASSWORD';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // set rulesnya 
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password1baru', 'Password Baru', 'required|trim|min_length[3]|matches[password2baru]');
        $this->form_validation->set_rules('password2baru', 'Konfirmasi Password', 'required|trim|min_length[3]|matches[password1baru]');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/gantipassword', $data);
            $this->load->view('templates/footer');
        } else {
            $password_saatini = $this->input->post('password_lama');
            $password_baru = $this->input->post('password1baru');
            if (!password_verify($password_saatini, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Password saat ini salah! </div>');
                redirect('user/gantipassword');
            } else {
                if ($password_saatini == $password_baru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Password tidak boleh sama dengan yang lama ! </div>');
                    redirect('user/gantipassword');
                } else {
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Password anda telah diganti ! </div>');
                    redirect('user/gantipassword');
                }
            }
        }
    }

    public function undangan()
    {
        $data['title'] = 'Undangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->where('id !=', 1);
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/undangan', $data);
        $this->load->view('templates/footer-user');
    }

    public function jenis_undangan($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $this->db->where('id !=', 2);
        $this->db->where('id !=', 3);
        $this->db->where('id !=', 6);
        $this->db->where('id !=', 11);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/jenis-undangan', $data);
        $this->load->view('templates/footer-user');
    }

    public function metode_pembayaran()
    {
        $data['title'] = 'Metode Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/metode_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function bukti_pembayaran()
    {
        $data['title'] = 'Status Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bukti'] = $this->db->get_where('bukti_pembayaran', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Pengirim', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dashboard/bukti_pembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = '2048';
            $config['upload_path']          = './assets/images/pernikahan';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Gambar anda belum ditambahkan </div>');
                redirect('dashboard/bukti_pembayaran');
            } else {
                $id_user =  $this->session->userdata('id_user');
                $gambar    = $this->upload->data();
                $gambar    = $gambar['file_name'];
                $nama_lengkap   = $this->input->post('nama_lengkap', true);

                $data = [
                    'id_user'   => $id_user,
                    'nama_lengkap'   => $nama_lengkap,
                    'image'     => $gambar
                ];
                $check = $this->db->get_where('bukti_pembayaran', ['id_user' => $id_user])->row();

                if ($check->id_user == $id_user) {
                    $this->db->where('id_user',  $id_user);
                    $this->db->update('bukti_pembayaran', $data);
                } else {
                    $this->db->insert('bukti_pembayaran', $data);
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
        Selamat, data kamu berhasil ditambahkan! </div>');
                redirect('dashboard/metode_pembayaran');
            }
        }
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
        $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
        Akses telah dirubah !! </div>');
    }




    public function mempelai()
    {
        $data['title'] = 'Mempelai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['mempelai'] = $this->db->get('nama_mempelai')->result_array();


        $this->form_validation->set_rules('nama_lk', 'Nama laki-Laki', 'required');
        $this->form_validation->set_rules('nama_pr', 'Nama Perempuan', 'required');
        $this->form_validation->set_rules('save_the_date', 'Save The Date', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/mempelai', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/mempelai/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('user/mempelai');
            } else {
                $gambar        = $this->upload->data();
                $gambar        = $gambar['file_name'];
                $nama_lk       = $this->input->post('nama_lk', true);
                $nama_pr       = $this->input->post('nama_pr', true);
                $std           = $this->input->post('save_the_date', true);
                $tanggal       = $this->input->post('tanggal', true);
                $alamat        = $this->input->post('alamat', true);

                $data = [
                    'nama_lk'       => $nama_lk,
                    'image'         => $gambar,
                    'nama_pr'       => $nama_pr,
                    'save_the_date' => $std,
                    'tanggal'       => $tanggal,
                    'alamat'        => $alamat
                ];

                $this->db->insert('nama_mempelai', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Mempelai anda sudah berhasil ditambahkan </div>');
                redirect('user/mempelai');
            }
        }
    }





























    // menu pernikahan
    public function slider_image()
    {
        $data['title'] = 'Slider Image';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['hero_image'] = $this->db->get('hero_image')->result_array();
        $data['hero_judul'] = $this->db->get('hero_judul')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/slider_image', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar Slider belum ditambahkan </div>');
                redirect('user/slider_image');
            } else {
                $gambar     = $this->upload->data();
                $gambar     = $gambar['file_name'];
                $nama       = $this->input->post('nama', true);

                $data = [
                    'nama'      => $nama,
                    'image'     => $gambar
                ];

                $this->db->insert('hero_image', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Gambar Slider sudah berhasil ditambahkan </div>');
                redirect('user/slider_image');
            }
        }
    }

    public function edit_slider($id)
    {
        $data['title'] = 'Edit Slider Image';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hero_image'] = $this->db->get_where('hero_image', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_slider', $data);
            $this->load->view('templates/footer');
        } else {

            $nama     = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['hero_image']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/' . $gambar_lama);
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
            $this->db->update('hero_image');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Banner berhasil diubah! </div>');
            redirect('user/slider_image');
        }
    }




    public function delete_slider($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('hero_image', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Slider Img sudah berhasil dihapus </div>');
        redirect('user/slider_image');
    }

    public function edit_judul($id)
    {
        $data['title'] = 'Edit Judul';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hero_judul'] = $this->db->get_where('hero_judul', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('paragraph', 'Paragraph', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_judul', $data);
            $this->load->view('templates/footer');
        } else {
            $judul     = $this->input->post('judul', true);
            $text      = $this->input->post('text', true);
            $paragraph = $this->input->post('paragraph', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
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

            $this->db->set('judul', $judul);
            $this->db->set('text', $text);
            $this->db->set('paragraph', $paragraph);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('hero_judul');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Hero Judul anda berhasil diubah! </div>');
            redirect('user/slider_image');
        }
    }

    public function social_media()
    {
        $data['title']  = 'Social Media';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['social_media'] = $this->db->get('social_media')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('sosmed', 'Sosmed', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/social_media', $data);
            $this->load->view('templates/footer');
        } else {

            $nama    = $this->input->post('nama', true);
            $sosmed  = $this->input->post('sosmed', true);
            $icon    = $this->input->post('icon', true);

            $data = [
                'nama'        => $nama,
                'sosmed'      => $sosmed,
                'icon'        => $icon
            ];

            $this->db->insert('social_media', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Social Media sudah berhasil ditambahkan </div>');
            redirect('user/social_media');
        }
    }



    public function edit_social($id)
    {
        $data['title'] = 'Edit Social Media';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['social_media'] = $this->db->get_where('social_media', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('sosmed', 'Sosmed', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_social', $data);
            $this->load->view('templates/footer');
        } else {

            $nama    = $this->input->post('nama', true);
            $sosmed  = $this->input->post('sosmed', true);
            $icon    = $this->input->post('icon', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('sosmed', $sosmed);
            $this->db->set('icon', $icon);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('social_media');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Social Media Perusahaan anda berhasil diubah! </div>');
            redirect('user/social_media');
        }
    }

    public function delete_social($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('social_media', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Social Media Perusahaan sudah berhasil dihapus </div>');
        redirect('user/social_media');
    }

    public function contact()
    {
        $data['title']  = 'Contact';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['contact'] = $this->db->get('contact')->result_array();


        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('motto', 'Motto', 'required');
        $this->form_validation->set_rules('pin_maps', 'Pin Maps', 'required');
        $this->form_validation->set_rules('telp', 'Telpon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('embed_maps', 'Embed Maps', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/contact', $data);
            $this->load->view('templates/footer');
        } else {

            $judul      = $this->input->post('judul', true);
            $motto      = $this->input->post('motto', true);
            $pin_maps   = $this->input->post('pin_maps', true);
            $telp       = $this->input->post('telp', true);
            $email      = $this->input->post('email', true);
            $embed_maps = $this->input->post('embed_maps', true);

            $data = [
                'judul'      => $judul,
                'motto'      => $motto,
                'pin_maps'   => $pin_maps,
                'telp'       => $telp,
                'email'      => $email,
                'embed_maps' => $embed_maps
            ];

            $this->db->insert('contact', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Data Contact sudah berhasil ditambahkan </div>');
            redirect('user/contact');
        }
    }



    public function edit_contact($id)
    {
        $data['title'] = 'Edit Contact';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['contact'] = $this->db->get_where('contact', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('motto', 'Motto', 'required');
        $this->form_validation->set_rules('pin_maps', 'Pin Maps', 'required');
        $this->form_validation->set_rules('telp', 'Telpon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('embed_maps', 'Embed Maps', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_contact', $data);
            $this->load->view('templates/footer');
        } else {

            $judul     = $this->input->post('judul', true);
            $motto     = $this->input->post('motto', true);
            $pin_maps  = $this->input->post('pin_maps', true);
            $telp      = $this->input->post('telp', true);
            $email     = $this->input->post('email', true);
            $embed_maps = $this->input->post('embed_maps', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('judul', $judul);
            $this->db->set('motto', $motto);
            $this->db->set('pin_maps', $pin_maps);
            $this->db->set('telp', $telp);
            $this->db->set('pin_maps', $pin_maps);
            $this->db->set('email', $email);
            $this->db->set('embed_maps', $embed_maps);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('contact');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Contact Perusahaan anda berhasil diubah! </div>');
            redirect('user/contact');
        }
    }



    public function delete_contact($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('contact', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Contact Perusahaan sudah berhasil dihapus </div>');
        redirect('user/contact');
    }

    public function hero_link()
    {
        $data['title'] = 'Hero Link';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['banner_1'] = $this->db->get('banner_1')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/hero_link', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('user/hero_link');
            } else {
                $gambar     = $this->upload->data();
                $gambar     = $gambar['file_name'];
                $nama       = $this->input->post('nama', true);
                $link       = $this->input->post('link', true);

                $data = [
                    'nama'      => $nama,
                    'image'     => $gambar,
                    'link'      => $link
                ];

                $this->db->insert('banner_1', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Banner Iklan anda sudah berhasil ditambahkan </div>');
                redirect('user/hero_link');
            }
        }
    }




    public function edit_hero_link($id)
    {
        $data['title'] = 'Edit Hero Link';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['banner_1'] = $this->db->get_where('banner_1', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_hero_link', $data);
            $this->load->view('templates/footer');
        } else {

            $nama       = $this->input->post('nama', true);
            $link       = $this->input->post('link', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 1024;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['banner_1']['image'];
                    if ($gambar_lama != 'bg-1.png') {
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
            $this->db->set('link', $link);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('banner_1');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Hero link anda anda berhasil diubah! </div>');
            redirect('user/hero_link');
        }
    }


    public function delete_hero_link($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('banner_1', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Hero Link sudah berhasil dihapus </div>');
        redirect('user/hero_link');
    }




    public function wedding_detail()
    {
        $data['title']  = 'Wedding Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['wedding_detail'] = $this->db->get('wedding_detail')->result_array();


        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('paragraph', 'Paragraph', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/wedding_detail', $data);
            $this->load->view('templates/footer');
        } else {

            $judul     = $this->input->post('judul', true);
            $text      = $this->input->post('text', true);
            $paragraph = $this->input->post('paragraph', true);

            $data = [
                'judul'        => $judul,
                'text'         => $text,
                'paragraph'    => $paragraph
            ];

            $this->db->insert('wedding_detail', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Wedding Detail sudah berhasil ditambahkan </div>');
            redirect('user/wedding_detail');
        }
    }

    public function edit_wedding_detail($id)
    {
        $data['title'] = 'Edit Wedding Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['wedding_detail'] = $this->db->get_where('wedding_detail', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('paragraph', 'Paragraph', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_wedding_detail', $data);
            $this->load->view('templates/footer');
        } else {

            $judul     = $this->input->post('judul', true);
            $text      = $this->input->post('text', true);
            $paragraph = $this->input->post('paragraph', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('judul', $judul);
            $this->db->set('text', $text);
            $this->db->set('paragraph', $paragraph);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('wedding_detail');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Wedding detail anda berhasil diubah! </div>');
            redirect('user/wedding_detail');
        }
    }

    public function delete_wedding_digital($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('wedding_detail', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        Wedding detail sudah berhasil dihapus </div>');
        redirect('user/wedding_detail');
    }

    public function akad()
    {
        $data['title'] = 'Akad';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['akad'] = $this->db->get('akad')->result_array();


        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
        $this->form_validation->set_rules('link_maps', 'Link Maps', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/akad', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/akad/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('user/akad');
            } else {
                $gambar      = $this->upload->data();
                $gambar      = $gambar['file_name'];
                $judul       = $this->input->post('judul', true);
                $jam         = $this->input->post('jam', true);
                $alamat      = $this->input->post('alamat', true);
                $no_hp       = $this->input->post('no_hp', true);
                $link_maps   = $this->input->post('link_maps', true);

                $data = [
                    'judul'       => $judul,
                    'image'      => $gambar,
                    'jam'         => $jam,
                    'alamat'      => $alamat,
                    'no_hp'       => $no_hp,
                    'link_maps'   => $link_maps
                ];

                $this->db->insert('akad', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Akad anda sudah berhasil ditambahkan </div>');
                redirect('user/akad');
            }
        }
    }




    public function edit_akad($id)
    {
        $data['title'] = 'Edit Akad';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['akad'] = $this->db->get_where('akad', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
        $this->form_validation->set_rules('link_maps', 'Link Maps', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_akad', $data);
            $this->load->view('templates/footer');
        } else {

            $judul       = $this->input->post('judul', true);
            $jam         = $this->input->post('jam', true);
            $alamat      = $this->input->post('alamat', true);
            $no_hp       = $this->input->post('no_hp', true);
            $link_maps   = $this->input->post('link_maps', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/akad/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['akad']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/akad/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('judul', $judul);
            $this->db->set('jam', $jam);
            $this->db->set('alamat', $alamat);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('link_maps', $link_maps);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('akad');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Akad anda anda berhasil diubah! </div>');
            redirect('user/akad');
        }
    }


    public function delete_akad($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('akad', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Akad sudah berhasil dihapus </div>');
        redirect('user/akad');
    }

    public function laki()
    {
        $data['title'] = 'Laki-laki';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['laki'] = $this->db->get('laki-laki')->result_array();


        $this->form_validation->set_rules('nama', 'Nama laki-Laki', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/laki', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/laki-laki/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('user/laki');
            } else {
                $gambar        = $this->upload->data();
                $gambar        = $gambar['file_name'];
                $nama          = $this->input->post('nama', true);

                $data = [
                    'nama'       => $nama,
                    'image'      => $gambar
                ];

                $this->db->insert('laki-laki', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Pihak Laki-laki anda sudah berhasil ditambahkan </div>');
                redirect('user/laki');
            }
        }
    }




    public function edit_laki($id)
    {
        $data['title'] = 'Edit Laki-laki';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['laki'] = $this->db->get_where('laki-laki', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama laki-Laki', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_laki', $data);
            $this->load->view('templates/footer');
        } else {

            $nama       = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/laki-laki/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['laki-laki']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/laki-laki/' . $gambar_lama);
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
            $this->db->update('laki-laki');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Pihak Laki-laki anda anda berhasil diubah! </div>');
            redirect('user/laki');
        }
    }


    public function delete_laki($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('laki-laki', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Pihak Laki-laki sudah berhasil dihapus </div>');
        redirect('user/laki');
    }

    public function perempuan()
    {
        $data['title'] = 'Perempuan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['perempuan'] = $this->db->get('pr')->result_array();


        $this->form_validation->set_rules('nama', 'Nama Perempuan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/perempuan', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/perempuan/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('user/perempuan');
            } else {
                $gambar        = $this->upload->data();
                $gambar        = $gambar['file_name'];
                $nama          = $this->input->post('nama', true);

                $data = [
                    'nama'       => $nama,
                    'image'      => $gambar
                ];

                $this->db->insert('pr', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Pihak Perempuan anda sudah berhasil ditambahkan </div>');
                redirect('user/perempuan');
            }
        }
    }




    public function edit_perempuan($id)
    {
        $data['title'] = 'Edit Perempuan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['perempuan'] = $this->db->get_where('pr', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama Perempuan', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_perempuan', $data);
            $this->load->view('templates/footer');
        } else {

            $nama       = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/perempuan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['pr']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/perempuan/' . $gambar_lama);
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
            $this->db->update('pr');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Pihak Perempuan anda anda berhasil diubah! </div>');
            redirect('user/perempuan');
        }
    }


    public function delete_perempuan($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('pr', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Pihak Perempuan sudah berhasil dihapus </div>');
        redirect('user/perempuan');
    }

    public function mundur()
    {
        $data['title']  = 'Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['hitung_mundur'] = $this->db->get('hitung_mundur')->result_array();


        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/mundur', $data);
            $this->load->view('templates/footer');
        } else {

            $tahun   = $this->input->post('tahun', true);
            $bulan   = $this->input->post('bulan', true);
            $hari    = $this->input->post('hari', true);

            $data = [
                'tahun'        => $tahun,
                'bulan'        => $bulan,
                'hari'         => $hari
            ];

            $this->db->insert('hitung_mundur', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                hitung mundur acara sudah berhasil ditambahkan </div>');
            redirect('user/mundur');
        }
    }



    public function edit_mundur($id)
    {
        $data['title'] = 'Edit Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hitung_mundur'] = $this->db->get_where('hitung_mundur', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_mundur', $data);
            $this->load->view('templates/footer');
        } else {

            $tahun   = $this->input->post('tahun', true);
            $bulan   = $this->input->post('bulan', true);
            $hari    = $this->input->post('hari', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('tahun', $tahun);
            $this->db->set('bulan', $bulan);
            $this->db->set('hari', $hari);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('hitung_mundur');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Hitung mundur acara anda berhasil diubah! </div>');
            redirect('user/mundur');
        }
    }

    public function delete_mundur($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('hitung_mundur', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Hitung Mundur Acara sudah berhasil dihapus </div>');
        redirect('user/mundur');
    }




    public function music()
    {
        $data['title']  = 'Music';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['music'] = $this->db->get_where('music', ['id_user' => $this->session->userdata('id_user')])->row_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('id_music', 'ID Music', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_akhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/music', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user     = $this->input->post('id_user', true);
            $nama      = $this->input->post('nama', true);
            $id_music  = $this->input->post('id_music', true);

            $data = [
                'id_user'          => $id_user,
                'nama'          => $nama,
                'id_music'      => $id_music
            ];

            $this->db->insert('music', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Music sudah berhasil ditambahkan </div>');
            redirect('user/music');
        }
    }



    public function edit_music($id)
    {
        $data['title'] = 'Edit Music';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['music'] = $this->db->get_where('music', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('id_music', 'ID Music', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_music', $data);
            $this->load->view('templates/footer');
        } else {

            $nama      = $this->input->post('nama', true);
            $id_music  = $this->input->post('id_music', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('id_music', $id_music);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('music');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Music anda berhasil diubah! </div>');
            redirect('user/music');
        }
    }

    public function delete_music($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('music', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Music sudah berhasil dihapus </div>');
        redirect('user/music');
    }

    public function whatsapp()
    {
        $data['title'] = 'Whatsapp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hub_kami'] = $this->db->get('hub_kami')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/whatsapp', $data);
        $this->load->view('templates/footer');
    }



    public function edit_whatsapp($id)
    {
        $data['title'] = 'Whatsapp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hub_kami'] = $this->db->get_where('hub_kami', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('desk', 'Deskripsi', 'required');
        $this->form_validation->set_rules('wa', 'Whatsapp', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_whatsapp', $data);
            $this->load->view('templates/footer');
        } else {

            $judul    = $this->input->post('judul', true);
            $desk     = $this->input->post('desk', true);
            $wa       = $this->input->post('wa', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
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
            $this->db->set('judul', $judul);
            $this->db->set('desk', $desk);
            $this->db->set('wa', $wa);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('hub_kami');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Whatsapp anda berhasil diubah! </div>');
            redirect('user/whatsapp');
        }
    }
}
