<?php

class Halal_admin_model extends CI_model
{
    public function getAllUser()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('user')->result_array();
    }

    public function getMenuByid($id)
    {
        return $this->db->get_where('nm_halal', ['id_user' => $id])->row_array();
    }

    public function getHalalById($id)
    {
        return $this->db->get_where('nm_halal', ['id_user' => $id])->row_array();
    }

    public function editDataHalal()
    {
        $data = [
            "nama_grub"       => $this->input->post('nama_grub', true),
            "judul_acara"     => $this->input->post('judul_acara', true),
            "tgl_acara"       => $this->input->post('tgl_acara', true),
            "waktu"           => $this->input->post('waktu', true),
            "zona_waktu"      => $this->input->post('zona_waktu', true),
            "nm_lokasi"       => $this->input->post('nm_lokasi', true),
            "alamat_lengkap"  => $this->input->post('alamat_lengkap', true),
            "sharelok"        => $this->input->post('sharelok', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('nm_halal', $data);
    }

    public function getAllTamuHalal()
    {
        return $this->db->get_where('list_undangan')->result_array();
    }

    public function tambahDataTamu()
    {
        $data = [
            "id_user" =>  $this->session->userdata('id_user', true),
            "nama" => $this->input->post('nama', true)
        ];

        $this->db->insert('list_undangan', $data);
    }

    public function hapusDataTamu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('list_undangan');
    }

    public function getListById($id)
    {
        return $this->db->get_where('list_undangan', ['id' => $id])->row_array();
    }

    public function editDataTamu($id)
    {

        $nama = $this->input->post('nama', true);
        $no_hp = $this->input->post('no_hp', true);

        $this->db->set('nama', $nama);
        $this->db->set('no_hp', $no_hp);
        $this->db->where('id', $id);
        $this->db->update('list_undangan');
    }

    public function getFotoHalalById($id)
    {
        return $this->db->get_where('foto', ['id_user' => $id])->row_array();
    }

    public function editFotoHalal()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('foto', $data);
    }

    public function getGalleryHalalById($id)
    {
        return $this->db->get_where('gallery', ['id_user' => $id])->row_array();
    }

    public function editGalleryHalal()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('gallery', $data);
    }

    public function getMusikHalalById($id)
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

    public function getHitungHalalById($id)
    {
        return $this->db->get_where('hitung_mundur', ['id_user' => $id])->row_array();
    }

    public function editHitungHalal()
    {
        $data = [
            "tahun" => $this->input->post('tahun', true),
            "bulan" => $this->input->post('bulan', true),
            "hari" => $this->input->post('hari', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('hitung_mundur', $data);
    }

    public function getAmplopHalalById($id)
    {
        return $this->db->get_where('hadiah', ['id_user' => $id])->row_array();
    }

    public function editAmplopHalal()
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
