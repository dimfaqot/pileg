<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
    }
    public function index(): string
    {
        // $db = db('tps');

        // $q = $db->get()->getResultArray();

        // foreach ($q as $i) {
        //     $i['c1'] = 'file-not-found.jpg';
        //     $db->where('id', $i['id']);
        //     $db->update($i);
        // }
        // dd('ok');
        // $db = db('tps');
        // $q = $db->orderBy('kelurahan', 'ASC')->groupBy('kelurahan')->get()->getResultArray();
        // $dbu = db('user');

        // foreach ($q as $i) {
        //     $data = [
        //         'username' => strtolower($i['kelurahan']),
        //         'nama' => 'Admin ' . $i['kelurahan'],
        //         'password' => password_hash('jiwa_' . strtolower($i['kelurahan']), PASSWORD_DEFAULT),
        //         'role' => 'Admin'
        //     ];

        //     $dbu->insert($data);
        // }
        return view('home', ['judul' => 'Home']);
    }
}
