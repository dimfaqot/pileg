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
        $q = $db->get()->getResultArray();

        foreach ($q as $i) {
            $i['suara'] = 0;

            $db->where('id', $i['id']);
            $db->update($i);
        }

        sukses(base_url('home'), 'Reset suara partai sukses.');
    }
    public function reset_suara_caleg()
    {
        lock_data();

        $db = db('suara_caleg');
        $q = $db->get()->getResultArray();

        foreach ($q as $i) {
            $i['suara'] = 0;

            $db->where('id', $i['id']);
            $db->update($i);
        }

        sukses(base_url('home'), 'Reset suara caleg sukses.');
    }
}
