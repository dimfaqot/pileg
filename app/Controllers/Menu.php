<?php

namespace App\Controllers;

class Menu extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        check_role();
    }
    public function index($role = null): string
    {
        $db = db('suara_partai');
        $q = $db->where('tps_id', 473)->get()->getResultArray();

        foreach ($q as $i) {
            $i['tps_id'] = 651;
            $db->where('id', $i['id']);
            $db->update($i);
        }

        $db = db(menu()['tabel']);
        $db->where('role', ($role == null ? 'Admin' : $role));
        if (session('role') !== 'Root') {
            $db->whereNotIn('role', ['Root']);
        }
        $q = $db->orderBy('no_urut', 'ASC')->get()->getResultArray();
        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q]);
    }

    public function add()
    {
        $role = clear($this->request->getVar('role'));
        $menu = upper_first(clear($this->request->getVar('menu')));
        $tabel = clear($this->request->getVar('tabel'));
        $controller = clear($this->request->getVar('controller'));
        $icon = clear($this->request->getVar('icon'));
        $url = clear($this->request->getVar('url'));
        $db = db(menu()['tabel']);
        $q = $db->where('role', $role)->where('menu', $menu)->get()->getRowArray();

        if ($q) {
            gagal($url, 'Data already exist!.');
        }

        $no_urut = 1;
        $last = $db->where('role', $role)->orderBy('no_urut', 'DESC')->get()->getRowArray();
        if ($last) {
            $no_urut = $last['no_urut'] + 1;
        }
        $data = [
            'role' => $role,
            'menu' => $menu,
            'tabel' => $tabel,
            'controller' => $controller,
            'icon' => $icon,
            'no_urut' => $no_urut,
            'is_active' => 1
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
