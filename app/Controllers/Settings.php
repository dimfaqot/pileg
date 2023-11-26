<?php

namespace App\Controllers;

class Settings extends BaseController
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
        $q = $db->get()->getRowArray();

        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $q, 'cols' => get_cols(menu()['tabel'])]);
    }


    public function update()
    {
        $id = clear($this->request->getVar('id'));
        $db = db(menu()['tabel']);

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id not found.');
        }

        foreach (get_cols(menu()['tabel']) as $i) {
            $q[$i] = $this->request->getVar($i);
        }


        $db->where('id', $id);
        if ($db->update($q)) {
            sukses(base_url(menu()['controller']), 'Data updated.');
        } else {
            gagal(base_url(menu()['controller']), 'Update failed!.');
        }
    }
}
