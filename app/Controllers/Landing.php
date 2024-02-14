<?php

namespace App\Controllers;

use Faker\Core\Number;

class Landing extends BaseController
{
    public function index(): string
    {
        // $db = db('tps');
        // $q = $db->get()->getResultArray();

        // $data = [];

        // foreach ($q as $i) {
        //     $val = $i['tps'] . ' ' . $i['kelurahan'] . '' . $i['kecamatan'];
        //     if (in_array($val, $data)) {
        //         dd($i);
        //     } else {
        //         $data[] = $val;
        //     }
        // }

        return view('landing', ['judul' => 'Jiwa']);
    }
    public function login(): string
    {

        return view('login', ['judul' => 'Login']);
    }
    public function auth()
    {
        $username = clear($this->request->getVar('username'));
        $password = clear($this->request->getVar('password'));

        $db = db('user');

        $q = $db->where('username', $username)->get()->getRowArray();

        if (!$q) {
            gagal(base_url('login'), 'Username not found!.');
        }

        if ($q['is_login'] == 1) {
            gagal(base_url('login'), 'Someone has been login!.');
        }

        if (!password_verify($password, $q['password'])) {
            gagal(base_url('login'), 'Wrong password!.');
        }

        $data = [
            'id' => $q['id'],
            'username' => $q['username'],
            'nama' => $q['nama'],
            'role' => $q['role']
        ];


        session()->set($data);
        $q['is_login'] = 1;
        $db->where('id', $q['id']);
        $db->update($q);
        sukses(base_url('home'), 'Login sukses.');
    }

    public function logout()
    {
        $db = db('user');
        $q = $db->where('id', session('id'))->get()->getRowArray();
        $q['is_login'] = 0;
        $db->where('id', $q['id']);
        $db->update($q);

        session()->remove('id');
        session()->remove('username');
        session()->remove('role');
        session()->remove('nama');

        sukses(base_url('login'), 'Logout sukses!.');
    }

    public function suara_partai()
    {
        $dapil = clear($this->request->getVar('dapil'));

        sukses_js('Koneksi sukses.', suara_partai($dapil));
    }
    public function kecamatan()
    {
        return view('kecamatan', ['judul' => 'Suara Menurut Kecamatan']);
    }
    public function kelurahan()
    {
        return view('kelurahan', ['judul' => 'Suara Menurut Kelurahan']);
    }
    public function bytps($kecamatan = null, $kelurahan = null, $tps_id = null)
    {

        $kecamatan = ($kecamatan == null ? 'Karangmalang' : $kecamatan);
        $kelurahan = get_default_kelurahan($kecamatan, $kelurahan);
        $tps = get_default_tps($kecamatan, $kelurahan, $tps_id);

        return view('bytps', ['judul' => 'Suara Menurut Tps', 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'tps' => $tps]);
    }

    public function suara_belum_masuk($order = 'partai', $kecamatan = 'Karangmalang', $kelurahan = 'Plumbungan', $ket = 'belum')
    {
        $kelurahan = get_default_kelurahan($kecamatan, $kelurahan);
        $data = suara_belum_masuk($order, $kecamatan, $kelurahan, $ket);
        return view('suara_belum_masuk', ['judul' => 'Tps Suara Belum Masuk', 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'order' => $order, 'data' => $data, 'ket' => $ket]);
    }
    public function c1_belum_masuk($kecamatan = 'Karangmalang', $kelurahan = 'Plumbungan', $ket = 'belum')
    {
        $kelurahan = get_default_kelurahan($kecamatan, $kelurahan);
        $data = c1_belum_masuk($kecamatan, $kelurahan, $ket);
        return view('c1_belum_masuk', ['judul' => 'C1 Belum Masuk', 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'data' => $data, 'ket' => $ket]);
    }
    public function suara_tertinggi($order = 'partai', $ket = 'DESC', $kecamatan = 'Karangmalang', $kelurahan = 'Plumbungan')
    {
        $kelurahan = get_default_kelurahan($kecamatan, $kelurahan);
        $data = suara_tertinggi($order, $ket, $kecamatan, $kelurahan);
        return view('suara_tertinggi', ['judul' => 'Suara Tertinggi ' . upper_first($order), 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'data' => $data, 'ket' => $ket, 'order' => $order]);
    }

    public function total_suara(): string
    {

        return view('total_suara', ['judul' => 'Total Suara']);
    }
    public function kursi(): string
    {
        return view('total_suara', ['judul' => 'Total Suara']);
    }
    public function caleg_pkb(): string
    {
        dd(kirka_vs_jiwa());
        return view('caleg_pkb', ['judul' => 'Caleg Pkb', 'data' => get_all_caleg_partai('Pkb')]);
    }
}
