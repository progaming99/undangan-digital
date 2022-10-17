<?php

class Syukuran_admin_model extends CI_model
{
    public function getAllUser()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('user')->result_array();
    }

    public function getMenuByid($id)
    {
        return $this->db->get_where('nm_syukuran', ['id_user' => $id])->row_array();
    }

    public function getSyukuranById($id)
    {
        return $this->db->get_where('nm_syukuran', ['id_user' => $id])->row_array();
    }

    public function getAllTamuSyukuran()
    {
        return $this->db->get('list_undangan')->result_array();
    }

    public function getListById($id)
    {
        return $this->db->get_where('list_undangan', ['id' => $id])->row_array();
    }

    public function hapusDataSyukuran($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('list_undangan');
    }

    public function editDataTamu($id)
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "no_hp" => $this->input->post('no_hp', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('list_undangan', $data);
    }

    public function tambahDataTamu()
    {
        $data = [
            "id_user" =>  $this->session->userdata('id_user', true),
            "nama" => $this->input->post('nama', true),
            "no_hp" => $this->input->post('no_hp', true)
        ];

        $this->db->insert('list_undangan', $data);
    }

    public function getCoverByid($id)
    {
        return $this->db->get_where('cover', ['id_user' => $id])->row_array();
    }

    public function editCover()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('cover', $data);
    }

    public function getGalleryById($id)
    {
        return $this->db->get_where('gallery', ['id_user' => $id])->row_array();
    }

    public function editGallery()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('gallery', $data);
    }

    public function getMusikById($id)
    {
        return $this->db->get_where('musik_pernikahan', ['id_user' => $id])->row_array();
    }

    public function editMusik()
    {
        $data = [
            "nama" => $this->input->post('nama', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('musik_pernikahan', $data);
    }

    public function getHitungById($id)
    {
        return $this->db->get_where('hitung_mundur', ['id_user' => $id])->row_array();
    }

    public function editHitung()
    {
        $data = [
            "tahun" => $this->input->post('tahun', true),
            "bulan" => $this->input->post('bulan', true),
            "hari" => $this->input->post('hari', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('hitung_mundur', $data);
    }

    public function getAmplopById($id)
    {
        return $this->db->get_where('hadiah', ['id_user' => $id])->row_array();
    }

    public function editAmplop()
    {
        $data = [
            "nama_bank" => $this->input->post('nama_bank', true),
            "no_rek" => $this->input->post('no_rek', true),
            "an" => $this->input->post('an', true),
            "no_hp" => $this->input->post('no_hp', true),
            "alamat" => $this->input->post('alamat', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('hadiah', $data);
    }
}
