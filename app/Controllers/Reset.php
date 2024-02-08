<?php

namespace App\Controllers;

class Reset extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        if (session('role') !== 'Root') {
            gagal(base_url('home'), 'You are not allowed!.');
        }
        if (date('Y') == 2024 && date('n') == 2 && date('j') > 13) {
            gagal(base_url('home'), 'Out of date!.');
        }
    }



    public function reset_tps()
    {
        lock_data();

        $db = db('tps');
        $q = $db->get()->getResultArray();

        foreach ($q as $i) {
            $i['c1'] = 'file-not-found.jpg';

            $db->where('id', $i['id']);
            $db->update($i);
        }

        sukses(base_url('home'), 'Reset TPS sukses.');
    }
    public function reset_suara_partai()
    {
        lock_data();

        $db = db('suara_partai');
        $kecs = ['Karangmalang', 'Kedawung', 'Ngrampal'];

        foreach ($kecs as $k) {
            $q = $db->select('suara_partai.id as id, suara,partai_id,tps_id')->join('tps', 'tps_id=tps.id')->where('kecamatan', $k)->get()->getResultArray();

            foreach ($q as $i) {
                $data['tps_id'] = $i['tps_id'];
                $data['partai_id'] = $i['partai_id'];
                $data['suara'] = 0;

                $db->where('id', $i['id']);
                $db->update($data);
            }
        }

        sukses(base_url('home'), 'Reset suara partai sukses.');
    }
    public function reset_suara_caleg()
    {
        lock_data();

        $db = db('suara_caleg');
        $kecs = ['Karangmalang', 'Kedawung', 'Ngrampal'];

        foreach ($kecs as $k) {
            $q = $db->select('suara_caleg.id as id, suara,caleg_id,tps_id')->join('tps', 'tps_id=tps.id')->where('kecamatan', $k)->get()->getResultArray();

            foreach ($q as $i) {
                $data['tps_id'] = $i['tps_id'];
                $data['caleg_id'] = $i['caleg_id'];
                $data['suara'] = 0;

                $db->where('id', $i['id']);
                $db->update($data);
            }
        }

        sukses(base_url('home'), 'Reset suara caleg sukses.');
    }
}
