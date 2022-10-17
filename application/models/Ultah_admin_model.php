<?php

class Ultah_admin_model extends CI_model
{
    public function getAllUser()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('user')->result_array();
    }

    public function getMenuByid($id)
    {
        return $this->db->get_where('nm_ultah', ['id_user' => $id])->row_array();
    }

    public function getUltahById($id)
    {
        return $this->db->get_where('nm_ultah', ['id_user' => $id])->row_array();
    }

    public function editDataUltah()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nama_lengkap" => $this->input->post('nama_lengkap', true),
            "nm_ayah" => $this->input->post('nm_ayah', true),
            "nm_ibu" => $this->input->post('nm_ibu', true),
            "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
            "urutan" => $this->input->post('urutan', true),
            "ultah_ke" => $this->input->post('ultah_ke', true),
            "uc_tambahan" => $this->input->post('uc_tambahan', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('nm_ultah', $data);
    }

    public function getLokasiUltahById($id)
    {
        return $this->db->get_where('lok_ultah', ['id_user' => $id])->row_array();
    }

    public function editDataLokasiUltah($id)
    {
        $data = [
            "judul_acara" => $this->input->post('judul_acara', true),
            "alamat" => $this->input->post('alamat', true),
            "nm_lokasi" => $this->input->post('nm_lokasi', true),
            "tgl_acara" => $this->input->post('tgl_acara', true),
            "w_mulai" => $this->input->post('w_mulai', true),
            "w_selesai" => $this->input->post('w_selesai', true),
            "z_waktu" => $this->input->post('z_waktu', true),
            "sharelok" => $this->input->post('sharelok', true)
        ];
        $this->db->where('id', $id);
        $this->db->update('lok_ultah', $data);
    }

    public function getAllTamuUltah()
    {
        return $this->db->get_where('list_undangan')->result_array();
    }

    public function getListByid($id)
    {
        return $this->db->get_where('list_undangan', ['id' => $id])->row_array();
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

    public function getCoverUltahByid($id)
    {
        return $this->db->get_where('cover_ultah', ['id_user' => $id])->row_array();
    }

    public function editCoverUltah()
    {
        $data = [
            "cover" => $this->input->post('cover', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('cover_ultah', $data);
    }

    public function getGalleryUltahByid($id)
    {
        return $this->db->get_where('gallery', ['id_user' => $id])->row_array();
    }

    public function editGalleryUltah()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('gallery', $data);
    }

    public function getMusikUltahById($id)
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

    public function getHitungUltahById($id)
    {
        return $this->db->get_where('hitung_mundur', ['id_user' => $id])->row_array();
    }

    public function editHitungUltah()
    {
        $data = [
            "tahun" => $this->input->post('tahun', true),
            "bulan" => $this->input->post('bulan', true),
            "hari" => $this->input->post('hari', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('hitung_mundur', $data);
    }

    public function getAmplopUltahById($id)
    {
        return $this->db->get_where('hadiah', ['id_user' => $id])->row_array();
    }

    public function editAmplopUltah()
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
