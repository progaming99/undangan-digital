<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        // function untuk membuat user tidak bisa berpindah halamn, kecuali tekan tombol logout
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        // function untuk login user dan admin
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer', $data);
        } else {
            // validasinya sukses
            $this->_login();
        }
    }
    //kondisi agar tidak kembali login/register tambahkan $this->goToDefaultPage();
    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else 
      if ($this->session->userdata('role_id') == 2) {
            redirect('dashboard');
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika ada user
        if ($user) {
            // jika user aktiv
            if ($user['is_active'] == 1) {
                // cek passwordnya benar atau tidak
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user' => $user['id'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {

                        redirect('User');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Password anda salah!!! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email anda belum aktif </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email anda belum terdaftar </div>');
            redirect('auth');
        }
    }


    public function registrasi()
    {
        // function untuk membuat user tidak bisa berpindah halamn, kecuali tekan tombol logout
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        // function untuk mengisi form registrasi user dan admin
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            ['is_unique' => 'email ini sudah terdaftar']
        );
        $this->form_validation->set_rules(
            'password1',
            'Password1',
            'required|trim|min_length[3]|matches[password2]',
            ['matches' => 'password tidak sama']
        );
        $this->form_validation->set_rules(
            'password2',
            'Password2',
            'required|trim|min_length[3]|matches[password1]',
            ['matches' => 'password tidak sama']
        );
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi', $data);
            $this->load->view('templates/auth_footer', $data);
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'created_at' => time()
            ];
            // siapkan token(angka random) untuk aktifasi user
            $token = base64_encode(random_bytes(32));
            //    siapkan user tokennya
            $user_token = [
                'email'         => $email,
                'token'         => $token,
                'date_created'  => time()
            ];
            // insert data user ke database
            $this->db->insert('user', $data);
            // insert data user token
            $this->db->insert('user_token', $user_token);
            // fitur untuk kirim data ke email
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Akun anda sudah berhasil terdaftar!! Silahkan cek email anda untuk aktivasi akun atau periksa pada menu spam email! </div>');
            redirect('auth');
        }
    }
    // akses modifier private (kalau pakai _ )
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'kreativamediaprinting99@gmail.com',
            'smtp_pass' => 'urukelyxfjwqbgqh',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        // tambahan baris jika muncul error ketika mengirim email
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->load->library('email');

        // siapkan emailnya
        $this->email->from('kreativamediaprinting99@gmail.com', 'Kreativa');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {

            $this->email->subject('Verifikasi Akun');
            $this->email->message('Silahkan klik link dibawah ini untuk aktivasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Aktivasi</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    // tampilkan pesan jika sukses
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">' . $email . ' telah aktif! silahkan login! </div>');
                    redirect('auth');
                } else {
                    // hapus 'email' data user yang tidak aktifasi akun
                    $this->db->delete('user', ['email' => $email]);
                    // hapus 'token' data user yang tidak aktifasi akun
                    $this->db->delete('user_token', ['email' => $email]);

                    // tampilkan pesan jika error
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    masa aktivasi akun anda telah habis! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                aktivasi akun anda gagal! token salah! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            aktivasi akun anda gagal! Email salah! </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('pesan', '<div class="alert alert-info" role="alert">
            Anda sudah Logout!! </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Validasi';

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/auth_footer');
    }
}
