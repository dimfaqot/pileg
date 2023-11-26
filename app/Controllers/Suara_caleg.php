<?php

namespace App\Controllers;

class Suara_caleg extends BaseController
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
        $cols = merge_cols(menu()['tabel'], 'tps', 'partai', 'caleg');
        $db = db(menu()['tabel']);
        $db->select($cols)->join('tps', 'tps_id=tps.id')->join('caleg', 'caleg_id=caleg.id')->join('partai', 'caleg.partai_id=partai.id');
        if ($dapil !== 'All') {
            if ($dapil == null) {
                $db->where('kecamatan', 'Karangmalang');
            } else {
                $db->where('kecamatan', $dapil);
            }
        }
        $q = $db->orderBy('no_partai', 'ASC')->orderBy('kelurahan', 'ASC')->orderBy('tps', 'ASC')->orderBy('no_caleg', 'ASC')->get()->getResultArray();


        $db = db('partai');
        $partai = $db->orderBy('no_partai', 'ASC')->get()->getResultArray();

        $data = [];
        foreach ($partai as $p) {
            $suara = 0;
            $val = [];
            foreach ($q as $i) {
                if ($i['partai_id'] == $p['id']) {
                    $val[] = $i;
                    $suara += $i['suara'];
                }
            }
            $data[] = ['data' => $val, 'total' => $suara];
        }

        return view(menu()['controller'], ['judul' => menu()['menu'], 'data' => $data, 'count' => count($q)]);
    }

    public function generate()
    {
        if (session('role') !== 'Root') {
            gagal(base_url(menu()['controller']), 'You are not allowed!.');
        }

        $db = db('tps');
        $q = $db->get()->getResultArray();

        $sp = db(menu()['tabel']);
        $caleg = db('caleg');
        $cal = $caleg->get()->getResultArray();

        $error = [];
        foreach ($cal as $p) {
            foreach ($q as $i) {
                $data = [
                    'tps_id' => $i['id'],
                    'caleg_id' => $p['id'],
                    'suara' => 0
                ];

                if (!$sp->insert($data)) {
                    $e = ['caleg_id' => $p['id'], 'tps_id' => $i['id']];
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
