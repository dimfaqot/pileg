<?php

namespace App\Controllers;

class Partai extends BaseController
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

        $q = $db->orderBy('no_partai', 'ASC')->get()->getResultArray();
        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q]);
    }

    public function add()
    {
        lock_data();
        $partai = upper_first(clear($this->request->getVar('partai')));
        $no_partai = clear($this->request->getVar('no_partai'));
        $color = clear($this->request->getVar('color'));
        $url = clear($this->request->getVar('url'));
        $db = db(menu()['tabel']);

        $exist = $db->where('partai', $partai)->get()->getRowArray();

        if ($exist) {
            gagal($url, 'Partai already exist!.');
        }

        $data = [
            'partai' => $partai,
            'no_partai' => $no_partai,
            'color' => $color
        ];


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
        $partai = upper_first(clear($this->request->getVar('partai')));
        $no_partai = clear($this->request->getVar('no_partai'));
        $color = clear($this->request->getVar('color'));
        $url = clear($this->request->getVar('url'));

        $db = db(menu()['tabel']);

        $exist = $db->whereNotIn('id', [$id])->where('partai', $partai)->get()->getRowArray();
        if ($exist) {
            gagal($url, 'Partai already exist!.');
        }

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal($url, 'Id not found.');
        }


        $q['partai'] = $partai;
        $q['no_partai'] = $no_partai;
        $q['color'] = $color;


        $db->where('id', $id);
        if ($db->update($q)) {
            sukses($url, 'Data updated.');
        } else {
            gagal($url, 'Update failed!.');
        }
    }

    public function delete()
    {
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
