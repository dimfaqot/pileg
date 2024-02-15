<?php

namespace App\Controllers;

class Tps extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        check_role();
    }
    public function index($dapil = null, $kelurahan = null): string
    {

        if (session('role') == 'Root') {
            $dapil = ($dapil == null ? 'Karangmalang' : $dapil);
            $kelurahan = get_default_kelurahan($dapil, $kelurahan);
        } else {
            $kelurahan = upper_first(session('username'));
        }
        $db = db(menu()['tabel']);
        $db;
        if (session('role') == 'Root') {
            $db->where('kecamatan', $dapil);
        }
        $q = $db->where('kelurahan', $kelurahan)->orderBy('id', 'ASC')->get()->getResultArray();
        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q, 'kelurahan' => $kelurahan, 'kelurahans' => get_all_kelurahan($dapil), 'kecamatan' => $dapil]);
    }

    public function add()
    {
        lock_data();
        $tps = upper_first(clear($this->request->getVar('tps')));
        $alamat = upper_first(clear($this->request->getVar('alamat')));
        $kelurahan = upper_first(clear($this->request->getVar('kelurahan')));
        $kecamatan = upper_first(clear($this->request->getVar('kecamatan')));
        $pj = upper_first(clear($this->request->getVar('pj')));
        $url = clear($this->request->getVar('url'));

        $data = [
            'tps' => $tps,
            'alamat' => $alamat,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'pj' => $pj
        ];

        $db = db(menu()['tabel']);
        if ($db->insert($data)) {
            sukses($url, 'Data saved.');
        } else {
            gagal($url, 'Save failed!.');
        }
    }
    public function update()
    {
        lock_data();
        $id = clear($this->request->getVar('id'));
        $tps = upper_first($this->request->getVar('tps'));
        $alamat = upper_first(clear($this->request->getVar('alamat')));
        $kelurahan = upper_first(clear($this->request->getVar('kelurahan')));
        $kecamatan = upper_first(clear($this->request->getVar('kecamatan')));
        $pj = upper_first(clear($this->request->getVar('pj')));
        $url = clear($this->request->getVar('url'));

        if (session('role') == 'Admin') {
            $hp_saksi = upper_first(clear($this->request->getVar('hp_saksi')));
        }


        $db = db(menu()['tabel']);

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal($url, 'Id not found.');
        }

        $q['tps'] = $tps;
        $q['alamat'] = $alamat;
        if (session('role') == 'Root') {
            $q['kelurahan'] = $kelurahan;
            $q['kecamatan'] = $kecamatan;
        }
        if (session('role') == 'Admin') {
            $q['hp_saksi'] = $hp_saksi;
        }
        $q['pj'] = $pj;


        $db->where('id', $id);
        if ($db->update($q)) {
            sukses($url, 'Data updated.');
        } else {
            gagal($url, 'Update failed!.');
        }
    }

    public function update_kirka()
    {
        $id = clear($this->request->getVar('id'));
        $val = clear($this->request->getVar('val'));
        $db = db('tps');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q['kirka'] = $val;

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Update sukses.');
        } else {
            gagal_js('Update gagal!.');
        }
    }
    public function update_saksi()
    {
        $id = clear($this->request->getVar('id'));
        $val = upper_first($this->request->getVar('val'));

        $db = db('tps');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q['pj'] = $val;

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Update sukses.');
        } else {
            gagal_js('Update gagal!.');
        }
    }
    public function update_hp_saksi()
    {
        $id = clear($this->request->getVar('id'));
        $val = clear($this->request->getVar('val'));
        $db = db('tps');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q['hp_saksi'] = $val;

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Update sukses.');
        } else {
            gagal_js('Update gagal!.');
        }
    }
    public function update_dpt()
    {
        $id = clear($this->request->getVar('id'));
        $val = clear($this->request->getVar('val'));
        $db = db('tps');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q['dpt'] = $val;

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Update sukses.');
        } else {
            gagal_js('Update gagal!.');
        }
    }

    public function delete()
    {
        if (session('role') !== 'Root') {
            gagal_js('You are not allowed!');
        }
        lock_data('js');
        $id = clear($this->request->getVar('id'));
        $tabel = clear($this->request->getVar('tabel'));
        $db = db($tabel);

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id not found!.');
        }

        $db->where('id', $id);
        if ($db->delete()) {
            sukses_js('Deleted success.');
        } else {
            gagal_js('Delete failed!.');
        }
    }
}
