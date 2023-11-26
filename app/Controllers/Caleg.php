<?php

namespace App\Controllers;

class Caleg extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        check_role();
    }
    public function index($partai = null): string
    {
        $db = db(menu()['tabel']);
        $cols = merge_cols('caleg', 'partai');
        $db->select($cols)->join('partai', 'partai_id=partai.id')->where('partai_id', ($partai == null ? get_partai(null, 'Pkb')['id'] : $partai));

        $q = $db->orderBy('no_caleg', 'ASC')->get()->getResultArray();

        $db = db('partai');
        $partai = $db->orderBy('no_partai', 'ASC')->get()->getResultArray();

        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q, 'partai' => $partai]);
    }

    public function add()
    {
        $partai_id = clear($this->request->getVar('partai_id'));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $no_caleg = clear($this->request->getVar('no_caleg'));
        $url = clear($this->request->getVar('url'));

        $data = [
            'partai_id' => $partai_id,
            'nama' => $nama,
            'no_caleg' => $no_caleg
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
        $role = clear($this->request->getVar('role'));
        $menu = upper_first(clear($this->request->getVar('menu')));
        $tabel = clear($this->request->getVar('tabel'));
        $controller = clear($this->request->getVar('controller'));
        $icon = clear($this->request->getVar('icon'));
        $no_urut = clear($this->request->getVar('no_urut'));
        $url = clear($this->request->getVar('url'));


        $db = db(menu()['tabel']);


        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal($url, 'Id not found.');
        }

        $exist = $db->whereNotIn('id', [$id])->where('role', $role)->where('menu', $menu)->get()->getRowArray();

        if ($exist) {
            gagal($url, 'Data already exist!.');
        }


        $q['role'] = $role;
        $q['menu'] = $menu;
        $q['tabel'] = $tabel;
        $q['controller'] = $controller;
        $q['icon'] = $icon;
        $q['no_urut'] = $no_urut;


        $db->where('id', $id);
        if ($db->update($q)) {
            sukses($url, 'Data updated.');
        } else {
            gagal($url, 'Update failed!.');
        }
    }
    public function copy()
    {
        $id = clear($this->request->getVar('id'));
        $role = clear($this->request->getVar('role'));
        $url = clear($this->request->getVar('url'));


        $db = db(menu()['tabel']);


        $q = $db->where('id', $id)->get()->getRowArray();


        $exist = $db->where('role', $role)->where('menu', $q['menu'])->get()->getRowArray();

        if ($exist) {
            gagal($url, 'Data already exist!.');
        }

        $no_urut = 1;
        $last = $db->where('role', $role)->orderBy('no_urut', 'DESC')->get()->getRowArray();
        if ($last) {
            $no_urut = $last['no_urut'] + 1;
        }

        $data = [
            'role' => $role,
            'menu' => $q['menu'],
            'tabel' => $q['tabel'],
            'controller' => $q['controller'],
            'icon' => $q['icon'],
            'no_urut' => $no_urut,
            'is_active' => 1
        ];


        if ($db->insert($data)) {
            sukses($url, 'Data copied.');
        } else {
            gagal($url, 'Copy failed!.');
        }
    }
    public function update_check()
    {
        $id = clear($this->request->getVar('id'));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $tabel = clear($this->request->getVar('tabel'));
        $col = clear($this->request->getVar('col'));
        $db = db($tabel);

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id not found!.');
        }

        $q[$col] = ($q[$col] == 1 ? 0 : 1);


        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Deleted updated.');
        } else {
            gagal_js('Update failed!.');
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
