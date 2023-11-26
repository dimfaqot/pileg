<?php

namespace App\Controllers;

class Options extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        check_role();
    }
    public function index($kategori = null): string
    {
        $db = db(menu()['tabel']);
        $db;
        if ($kategori !== 'All') {
            $db->where('kategori', ($kategori == null ? 'Role' : $kategori));
        }
        $q = $db->orderBy('no_urut', 'ASC')->orderBy('kategori', 'ASC')->get()->getResultArray();

        $kategori = $db->groupBy('kategori')->orderBy('kategori', 'ASC')->get()->getResultArray();
        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q, 'kategori' => $kategori]);
    }

    public function add()
    {
        $kategori = upper_first(clear($this->request->getVar('kategori')));
        $value = upper_first(clear($this->request->getVar('value')));
        $url = clear($this->request->getVar('url'));
        $no_urut = clear($this->request->getVar('no_urut'));

        $db = db(menu()['tabel']);
        $q = $db->where('kategori', $kategori)->where('value', $value)->get()->getRowArray();

        if ($q) {
            gagal($url, 'Data already exist!.');
        }

        $data = [
            'kategori' => $kategori,
            'value' => $value,
            'no_urut' => $no_urut
        ];


        if ($db->insert($data)) {
            sukses($url, 'Data saved.');
        } else {
            gagal($url, 'Save failed!.');
        }
    }
    public function update()
    {
        $id = clear($this->request->getVar('id'));
        $kategori = upper_first(clear($this->request->getVar('kategori')));
        $value = upper_first(clear($this->request->getVar('value')));
        $url = clear($this->request->getVar('url'));
        $no_urut = clear($this->request->getVar('no_urut'));

        $db = db(menu()['tabel']);
        $exist = $db->whereNotIn('id', [$id])->where('kategori', $kategori)->where('value', $value)->get()->getRowArray();

        if ($exist) {
            gagal($url, 'Data already exist!.');
        }


        $db = db(menu()['tabel']);


        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal($url, 'Id not found.');
        }

        if ($exist) {
            gagal($url, 'Data already exist!.');
        }


        $q['kategori'] = $kategori;
        $q['value'] = $value;
        $q['no_urut'] = $no_urut;


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
