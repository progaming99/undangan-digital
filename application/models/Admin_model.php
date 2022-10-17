<?php

class Admin_model extends CI_model
{
    public function getAllUser()
    {
        $this->db->where('id !=', 11);
        return $this->db->get('user')->result_array();
    }

    public function getMenuByid($id)
    {
        return $this->db->get_where('nm_mempelai', ['id_user' => $id])->row_array();
    }

    public function getMempelaiByid($id)
    {
        return $this->db->get_where('nm_mempelai', ['id_user' => $id])->row_array();
    }

    public function getAllMempelai()
    {
        return $this->db->get('nm_mempelai')->result_array();
    }

    public function hapusDataMempelai($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('nm_mempelai');
    }

    public function editDataMempelaiPria()
    {
        $data = [
            "np_pria" => $this->input->post('np_pria', true),
            "nl_pria" => $this->input->post('nl_pria', true),
            "na_pria" => $this->input->post('na_pria', true),
            "ni_pria" => $this->input->post('ni_pria', true),
            "urutan_pria" => $this->input->post('urutan_pria', true),
            "i_pria" => $this->input->post('i_pria', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('nm_mempelai', $data);
    }

    public function editDataMempelaiWanita()
    {
        $data = [
            "np_wanita" => $this->input->post('np_wanita', true),
            "nl_wanita" => $this->input->post('nl_wanita', true),
            "na_wanita" => $this->input->post('na_wanita', true),
            "ni_wanita" => $this->input->post('ni_wanita', true),
            "urutan_wanita" => $this->input->post('urutan_wanita', true),
            "i_wanita" => $this->input->post('i_wanita', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('nm_mempelai', $data);
    }

    public function getLokasiByid($id)
    {
        return $this->db->get_where('lok_mempelai', ['id_user' => $id])->row_array();
    }

    public function getAllLokasi()
    {
        return $this->db->get('lok_mempelai')->result_array();
    }

    public function editDataLokasi()
    {
        $data = [
            "judul_acara" => $this->input->post('judul_acara', true),
            "alamat_acara" => $this->input->post('alamat_acara', true),
            "nm_lokasi" => $this->input->post('nm_lokasi', true),
            "tgl_pernikahan" => $this->input->post('tgl_pernikahan', true),
            "w_mulai" => $this->input->post('w_mulai', true),
            "w_selesai" => $this->input->post('w_selesai', true),
            "z_waktu" => $this->input->post('z_waktu', true),

            "judul_acara2" => $this->input->post('judul_acara2', true),
            "alamat_acara2" => $this->input->post('alamat_acara2', true),
            "nm_lokasi2" => $this->input->post('nm_lokasi2', true),
            "tgl_pernikahan2" => $this->input->post('tgl_pernikahan2', true),
            "w_mulai2" => $this->input->post('w_mulai2', true),
            "w_selesai2" => $this->input->post('w_selesai2', true),
            "z_waktu2" => $this->input->post('z_waktu2', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('lok_mempelai', $data);
    }

    public function getAllListUndangan()
    {
        return $this->db->get('list_undangan')->result_array();
    }

    public function getListByid($id)
    {
        return $this->db->get_where('list_undangan', ['id' => $id])->row_array();
    }

    public function hapusDataTamu($id)
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
            "nama" => $this->input->post('nama', true)
        ];

        $this->db->insert('list_undangan', $data);
    }

    public function getCoverPernikahanByid($id)
    {
        return $this->db->get_where('cover_pernikahan', ['id_user' => $id])->row_array();
    }

    public function editCoverPernikahan()
    {
        $data = [
            "cover" => $this->input->post('cover', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('cover_pernikahan', $data);
    }

    public function getGalleryPernikahanByid($id)
    {
        return $this->db->get_where('gallery', ['id_user' => $id])->row_array();
    }

    public function editGalleryPernikahan()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('gallery', $data);
    }

    public function getMusikByid($id)
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

    public function getHitungByid($id)
    {
        return $this->db->get_where('hitung_mundur', ['id_user' => $id])->row_array();
    }

    public function editHitungMundur()
    {
        $data = [
            "tahun" => $this->input->post('tahun', true),
            "bulan" => $this->input->post('bulan', true),
            "hari" => $this->input->post('hari', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('hitung_mundur', $data);
    }

    public function getAmplopByid($id)
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
