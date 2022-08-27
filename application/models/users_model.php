<?php
class Users_model extends CI_Model
{
    public function get_image($user_id)
    {
        $sql = "SELECT * FROM gallery WHERE user_id='$user_id' order by id DESC";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function getUsersByid($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function hapusDataUsers($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function editDataUser()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "email" => $this->input->post('email', true),
            "is_active" => $this->input->post('is_active', true),
            "created_at" => $this->input->post('created_at', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
    }
}
