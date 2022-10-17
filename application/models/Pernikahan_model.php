<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pernikahan_model extends CI_Model
{
    public function getLokasiByid($id)
    {
        return $this->db->get_where('lok_mempelai', ['id_user' => $id])->row_array();
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
            "z_waktu2" => $this->input->post('z_waktu2', true),
            "sharelok" => $this->input->post('sharelok', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('lok_mempelai', $data);
    }

    public function ListUndangan()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('list_undangan', 'list_undangan.id = user.id', 'LEFT');
        $query = $this->db->get();
        return $query;
    }

    public function getAllListUndangan()
    {
        return $this->db->get('list_undangan')->result_array();
    }

    public function getListById($id)
    {
        return $this->db->get_where('list_undangan', ['id' => $id])->row_array();
    }

    public function hapusDataPernikahan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('list_undangan');
    }

    public function editDataList($id)
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "no_hp" => $this->input->post('no_hp', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('list_undangan', $data);
    }

    public function tambahDataListUndangan()
    {
        $noHp = $this->input->post('no_hp', true);
        if (substr($noHp, 0, 1) == "0") {
            $no_hp = substr_replace($noHp, "62", 0, 1);
        } else {
            $no_hp = $noHp;
        }

        $data = [
            "id_user" =>  $this->session->userdata('id_user', true),
            "nama" => $this->input->post('nama', true),
            "no_hp" => $no_hp,
        ];

        $this->db->insert('list_undangan', $data);
    }

    public function tambahHitungMundur()
    {
        $id_user =  $this->session->userdata('id_user', true);
        $tahun = $this->input->post('tahun', true);
        $bulan = $this->input->post('bulan', true);
        $hari = $this->input->post('hari', true);

        $data = [
            "id_user" => $id_user,
            "tahun" => $tahun,
            "bulan" => $bulan,
            "hari" => $hari
        ];

        $this->db->set('tahun', $tahun);

        $check = $this->db->get_where('hitung_mundur', ['id_user' => $id_user])->row();

        if ($check->id_user == $id_user) {
            $this->db->where('id_user',  $id_user);
            $this->db->update('hitung_mundur', $data);
        } else {
            $this->db->insert('hitung_mundur', $data);
        }
    }

    public function tambahAmplop()
    {
        $id_user =  $this->session->userdata('id_user', true);
        $nama_bank = $this->input->post('nama_bank', true);
        $no_rek = $this->input->post('no_rek', true);
        $an = $this->input->post('an', true);
        $alamat = $this->input->post('alamat', true);
        $no_hp = $this->input->post('no_hp', true);

        $data = [
            "id_user" =>  $id_user,
            "nama_bank" => $nama_bank,
            "no_rek" => $no_rek,
            "an" => $an,
            "alamat" => $alamat,
            "no_hp" => $no_hp
        ];

        $this->db->set('nama_bank', $nama_bank);

        $check = $this->db->get_where('hadiah', ['id_user' => $id_user])->row();

        if ($check->id_user == $id_user) {
            $this->db->where('id_user',  $id_user);
            $this->db->update('hadiah', $data);
        } else {
            $this->db->insert('hadiah', $data);
        }
    }

    function simpanTemplate($id)
    {
        $id_user = $this->session->userdata('id_user');
        $cek = $this->db->get_where('template_user', ['id_user' => $id_user]);

        if ($cek->num_rows() > 0) {
            $this->db->where('id_user', $id_user);
            $save_data = $this->db->update('template_user', ['id_template' => $id]);
        } else {
            $save_data = $this->db->insert('template_user', ['id_template' => $id, "id_user" => $id_user]);
        }

        if ($save_data) {
            $result = [
                'success'   => true
            ];
        } else {
            $result = [
                'success'   => false
            ];
        }

        return $result;
    }
}
