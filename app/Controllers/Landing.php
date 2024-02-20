<?php

namespace App\Controllers;

class Landing extends BaseController
{
    public function index(): string
    {
        return view((mode_landing() == 1 ? 'new_landing' : 'landing'), ['judul' => 'Jiwa', 'data' => kursi()]);
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
    public function download()
    {
        // dd(rekap_seluruh_caleg());
        return view('download', ['judul' => 'Download']);
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
        return view('total_suara', ['judul' => 'Total Suara', 'data' => kursi()]);
    }

    public function caleg_pkb(): string
    {
        return view('caleg_pkb', ['judul' => 'Caleg Pkb', 'data' => get_all_caleg_partai('Pkb')]);
    }
    public function kirka_per_kecamatan($kec = 'Karangmalang'): string
    {
        return view('kirka_per_kecamatan', ['judul' => 'Kirka Per Kecamatan', 'data' => kirka_per_kecamatan($kec), 'kec' => $kec]);
    }
    public function suara_partai_dan_suara_jiwa($kecamatan = 'Karangmalang'): string
    {
        return view('suara_partai_dan_suara_jiwa', ['judul' => 'Suara Partai dan Suara Jiwa', 'data' => suara_partai_dan_jiwa($kecamatan), 'kecamatan' => $kecamatan]);
    }

    public function cetak_pdf($order = 'Karangmalang')
    {
        $judul = strtoupper('data jiwa 2024 Wilayah ' . str_replace("_", " ", $order));

        $set = [
            'mode' => 'utf-8',
            'format' => [215, 330],
            'orientation' => 'L',
            'margin_left' => 20,
            'margin_right' => 10,
            'margin_top' => 20,
            'margin_bottom' => 20,
        ];

        $mpdf = new \Mpdf\Mpdf($set);


        $data = suara_partai_dan_jiwa($order);

        foreach ($data as $i) {

            $html = view('cetak/suara_partai_dan_suara_jiwa_pdf', ['judul' => $judul, 'data' => $i, 'kecamatan' => $order]);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
        }
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($judul . '.pdf', 'I');
    }
}
