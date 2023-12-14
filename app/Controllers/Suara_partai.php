<?php

namespace App\Controllers;

class Suara_partai extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        check_role();
    }
    public function index($dapil = null): string
    {

        $dapil = ($dapil == null ? 'Karangmalang' : $dapil);
        $data = suara_partai($dapil);
        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $data['data'], 'count' => $data['count']]);
    }

    public function generate()
    {
        lock_data();
        if (session('role') !== 'Root') {
            gagal(base_url(menu()['controller']), 'You are not allowed!.');
        }

        $db = db('tps');
        $q = $db->get()->getResultArray();

        $sp = db(menu()['tabel']);
        $partai = db('partai');
        $par = $partai->get()->getResultArray();

        $error = [];
        foreach ($par as $p) {
            foreach ($q as $i) {
                $data = [
                    'tps_id' => $i['id'],
                    'partai_id' => $p['id'],
                    'suara' => 0
                ];

                if (!$sp->insert($data)) {
                    $e = ['partai_id' => $p['id'], 'tps_id' => $i['id']];
                    $error[] = $e;
                }
            }
        }

        if (count($error) > 0) {
            gagal(base_url(menu()['controller']), count($data) . ' data gagal digenerate!.');
        } else {
            sukses(base_url(menu()['controller']), 'Data sukses digenerate.');
        }
    }
}
