<?php

namespace App\Controllers;

class User extends BaseController
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

        $q = $db->orderBy('id', 'ASC')->get()->getResultArray();
        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q]);
    }

    public function add()
    {

        $username = clear(strtolower($this->request->getVar('username')));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $role = upper_first(clear($this->request->getVar('role')));

        $url = clear($this->request->getVar('url'));
        $db = db(menu()['tabel']);

        $exist = $db->where('username', $username)->get()->getRowArray();

        if ($exist) {
            gagal($url, 'Username already exist!.');
        }

        $data = [
            'username' => $username,
            'nama' => $nama,
            'password' => password_hash('jiwa_2024', PASSWORD_DEFAULT),
            'role' => $role,
            'is_login' => 0
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
        $username = clear(strtolower($this->request->getVar('username')));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $role = upper_first(clear($this->request->getVar('role')));
        $is_login = clear($this->request->getVar('is_login'));
        $url = clear($this->request->getVar('url'));

        $db = db(menu()['tabel']);

        $exist = $db->whereNotIn('id', [$id])->where('username', $username)->get()->getRowArray();
        if ($exist) {
            gagal($url, 'Username already exist!.');
        }

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal($url, 'Id not found.');
        }


        $q['username'] = $username;
        $q['nama'] = $nama;
        $q['role'] = $role;
        $q['is_login'] = $is_login;


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
