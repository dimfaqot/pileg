<?php

namespace App\Controllers;

class Election extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        check_role();
    }

    public function index($order = null): string
    {
        return view('election', ['judul' => 'Penghitungan Suara', 'data' => get_tps(($order == null ? 1 : $order))]);
    }

    public function update_suara_partai()
    {
        lock_data('js');
        $id = clear($this->request->getVar('id'));
        $value = (int)str_replace(".", "", clear($this->request->getVar('value')));

        $db = db('suara_partai');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Ok', 'Id not found!.');
        }

        $q['suara'] = $value;

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Ok');
        } else {
            gagal_js('Ok', 'Suara gagal diupdate!.');
        }
    }
    public function update_suara_caleg()
    {
        lock_data('js');
        $id = clear($this->request->getVar('id'));
        $value = (int)str_replace(".", "", clear($this->request->getVar('value')));

        $db = db('suara_caleg');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Ok', 'Id not found!.');
        }

        $q['suara'] = $value;

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Ok');
        } else {
            gagal_js('Ok', 'Suara gagal diupdate!.');
        }
    }
}
