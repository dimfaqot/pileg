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
    public function index(): string
    {
        $db = db(menu()['tabel']);
        $q = $db->orderBy('kecamatan', 'ASC')->get()->getResultArray();
        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q]);
    }

    public function add()
    {
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
        $id = clear($this->request->getVar('id'));
        $tps = upper_first(clear($this->request->getVar('tps')));
        $alamat = upper_first(clear($this->request->getVar('alamat')));
        $kelurahan = upper_first(clear($this->request->getVar('kelurahan')));
        $kecamatan = upper_first(clear($this->request->getVar('kecamatan')));
        $pj = upper_first(clear($this->request->getVar('pj')));
        $url = clear($this->request->getVar('url'));


        $db = db(menu()['tabel']);

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal($url, 'Id not found.');
        }

        $q['tps'] = $tps;
        $q['alamat'] = $alamat;
        $q['kelurahan'] = $kelurahan;
        $q['kecamatan'] = $kecamatan;
        $q['pj'] = $pj;


        $db->where('id', $id);
        if ($db->update($q)) {
            sukses($url, 'Data updated.');
        } else {
            gagal($url, 'Update failed!.');
        }
    }

    public function delete()
    {
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
