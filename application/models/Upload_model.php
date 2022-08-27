<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_model extends CI_Model
{
    public function upload_image($data, $type)
    {
        if ($type == 'add') {
            $this->db->insert('upload_image', $data);
        } else {
            $this->db->update('upload_image', $data, ['id' => $data['id']]);
        }
        return $this->db->affected_rows();
    }

    public function getData()
    {
        return $this->db->get('upload_image')->result_array();
    }

    public function getImageById($id)
    {
        return $this->db->get_where('upload_image', ['id' => $id])->row_array();
    }

    public function delete($id)
    {
        $this->db->delete('upload_image', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
