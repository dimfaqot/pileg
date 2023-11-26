<?php

namespace App\Controllers;

class Search extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
    }
    public function indonesia(): string
    {
        $indonesia_id = clear($this->request->getVar('indonesia_id'));
        $order = clear($this->request->getVar('order'));
        $col = clear($this->request->getVar('col'));
        $kecamatan = clear($this->request->getVar('kecamatan'));
        $val = clear($this->request->getVar('val'));
        $db = db($col, 'indonesia');
        $db;
        if ($order == 'add') {
            if ($col == 'kecamatan') {
                $db->where('kabupaten_id', $indonesia_id);
            }
            if ($col == 'kelurahan') {
                $db->where('kecamatan_id', $indonesia_id);
            }
        }
        if ($order == 'update') {
            $db_kec = db('kecamatan', 'indonesia');
            $kec_id = $db_kec->where('kabupaten_id', 3314)->where('name', $kecamatan)->get()->getRowArray();
            if ($col == 'kecamatan') {
                $db->where('kabupaten_id', $indonesia_id);
            }
            if ($col == 'kelurahan') {
                $db->where('kecamatan_id', $kec_id['id']);
            }
        }
        $data = $db->like('name', $val, 'both')->limit(10)->orderBy('name', 'ASC')->get()->getResultArray();

        sukses_js('Koneksi ok', $data);
    }

    public function suara()
    {
        $id = clear($this->request->getVar('id'));
        $tabel = clear($this->request->getVar('tabel'));
        $val = clear($this->request->getVar('val'));

        $db = db($tabel);
        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id not found!.');
        }

        $q['suara'] = $val;

        $db->where('id', $id);

        if ($db->update($q)) {
            sukses_js('Suara berhasil diupdate.');
        } else {
            gagal_js('Suara gagal diupdate.');
        }
    }
}
