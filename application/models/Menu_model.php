<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`. *, `user_menu`. `menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`. `menu_id` = `user_menu`. `id` 
        ";
        return $this->db->query($query)->result_array();
    }

    public function getEditSubMenu($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function EditSubMenu()
    {
        $data = [
            "menu_id" => $this->input->post('menu_id', true),
            "title" => $this->input->post('title', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "is_active" => $this->input->post('is_active', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    public function getEditMenu($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function EditMenu()
    {
        $data = [
            "menu" => $this->input->post('menu', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function Pembayaran()
    {
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.id = pembayaran.id_user', 'LEFT');
        $query = $this->db->get();
        return $query;
    }

    public function getStatusByid($id)
    {
        return $this->db->get_where('pembayaran', ['id_user' => $id])->row_array();
    }

    public function EditPembayaran()
    {
        $data = [
            "nama_pengirim" => $this->input->post('nama_pengirim', true),
            "status" => $this->input->post('status', true)
        ];

        $this->db->where('id_user', $this->input->post('id'));
        $this->db->update('pembayaran', $data);
    }
}
