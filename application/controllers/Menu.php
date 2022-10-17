<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'MENU';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get_where('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Menu sudah berhasil ditambahkan </div>');
            redirect('menu');
        }
    }

    public function edit_menu($id)
    {
        $data['title'] = 'MENU';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->Menu_model->getEditMenu($id);

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_model->EditMenu();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            SubMenu sudah berhasil ditambahkan </div>');
            redirect('menu');
        }
    }

    public function delete_menu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Submenu sudah berhasil dihapus </div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'SUBMENU';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Menu', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            SubMenu sudah berhasil ditambahkan </div>');
            redirect('menu/submenu');
        }
    }

    public function delete_sub_menu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Submenu sudah berhasil dihapus </div>');
        redirect('menu/submenu');
    }

    public function edit_sub_menu($id)
    {
        $data['title'] = 'SUBMENU';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['submenu'] = $this->Menu_model->getEditSubMenu($id);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');
        $this->form_validation->set_rules('title', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_model->EditSubMenu();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            SubMenu sudah berhasil ditambahkan </div>');
            redirect('menu/submenu');
        }
    }

    public function status_pembayaran()
    {
        $data['title'] = 'Status Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['user_pembayaran'] = $this->Menu_model->Pembayaran()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/status_pembayaran', $data);
        $this->load->view('templates/footer_akses');
    }

    public function edit_pembayaran($id)
    {
        $data['title'] = 'Edit Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['pembayaran'] = $this->Menu_model->getStatusById($id);
        $data['pembayaran'] = $this->Menu_model->getEditPembayaran($id);
        $data['status'] = ['Menunggu Pembayaran', 'Lunas'];
        $data['role_id'] = ['2', '3'];

        $this->form_validation->set_rules('status', 'Status Pembayaran', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_pembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_model->editPembayaran();
            $this->Menu_model->EditRoleUser();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('menu/status_pembayaran');
        }
    }
}
