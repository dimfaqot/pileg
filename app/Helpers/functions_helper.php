<?php

use App\Controllers\Tps;

function db($tabel, $db = null)
{
    if ($db == null || $db == 'data') {
        $db = \Config\Database::connect();
    } else {
        $db = \Config\Database::connect(strtolower(str_replace(" ", "_", $db)));
    }
    $db = $db->table($tabel);

    return $db;
}

function get_cols($tabel)
{

    $db = \Config\Database::connect();
    $q = $db->getFieldNames($tabel);

    $data = [];

    foreach ($q as $i) {
        if ($i !== 'id' && $i !== 'updated_at' && $i !== 'created_at' && $i !== 'admin') {
            $data[] = $i;
        }
    }
    return $data;
}

function settings($order = null)
{
    $db = db('settings');

    $q = $db->get()->getRowArray();

    if ($order == null) {
        return $q;
    } else {
        return $q[$order];
    }
}

function clear($text)
{
    $text = trim($text);
    $text = htmlspecialchars($text);
    return $text;
}



function upper_first($text)
{
    $text = clear($text);
    $exp = explode(" ", $text);

    $val = [];
    foreach ($exp as $i) {
        $lower = strtolower($i);
        $val[] = ucfirst($lower);
    }

    return implode(" ", $val);
}

function sukses($url, $pesan)
{
    session()->setFlashdata('sukses', $pesan);
    header("Location: " . $url);
    die;
}

function gagal($url, $pesan)
{
    session()->setFlashdata('gagal', $pesan);
    header("Location: " . $url);
    die;
}

function sukses_js($pesan, $data = null, $data2 = null, $data3 = null, $data4 = null)
{
    $data = [
        'status' => '200',
        'message' => $pesan,
        'data' => $data,
        'data2' => $data2,
        'data3' => $data3,
        'data4' => $data4
    ];

    echo json_encode($data);
    die;
}

function gagal_js($pesan)
{
    $data = [
        'status' => '400',
        'message' => "Gagal!. " . $pesan
    ];

    echo json_encode($data);
    die;
}

function menus()
{

    $db = db('menu');

    $q1[] = ['id' => 0, 'no_urut' => 0, 'role' => session('role'), 'menu' => 'Home', 'tabel' => 'user', 'controller' => 'home', 'icon' => "fa-solid fa-earth-asia", 'url' => 'home', 'is_active' => 1];
    $q2 = $db->where('role', session('role'))->where('is_active', 1)->orderBy('no_urut', 'ASC')->get()->getResultArray();

    $res = array_merge($q1, $q2);

    return $res;
}

function menu($req = null)
{
    if ($req == null) {
        foreach (menus() as $i) {
            if ($i['controller'] == url()) {
                return $i;
            }
        }
    } else {
        foreach (menus() as $i) {
            if ($i['controller'] == $req) {
                return $i;
            }
        }
    }
}
function menus_landing()
{


    $q = [
        ['id' => 0, 'no_urut' => 1, 'role' => '', 'menu' => 'Home', 'tabel' => 'user', 'controller' => 'home', 'icon' => "fa-solid fa-earth-asia", 'url' => 'home', 'is_active' => 1],
        ['id' => 1, 'no_urut' => 2, 'role' => '', 'menu' => 'Kecamatan', 'tabel' => '', 'controller' => 'kecamatan', 'icon' => "fa-solid fa-city", 'url' => 'kecamatan', 'is_active' => 1],
        ['id' => 2, 'no_urut' => 3, 'role' => '', 'menu' => 'Kelurahan', 'tabel' => '', 'controller' => 'kelurahan', 'icon' => "fa-solid fa-building", 'url' => 'kelurahan', 'is_active' => 1],
        ['id' => 3, 'no_urut' => 4, 'role' => '', 'menu' => 'Tps', 'tabel' => '', 'controller' => 'bytps', 'icon' => "fa-solid fa-person-booth", 'url' => 'bytps', 'is_active' => 1]
    ];

    return $q;
}
function menu_landing($req = '')
{

    $res = null;
    if ($req == '') {
        foreach (menus_landing() as $i) {
            if ($i['controller'] == 'home') {
                $res = $i;
            }
        }
    } else {
        foreach (menus_landing() as $i) {
            if ($i['controller'] == $req) {
                $res = $i;
            }
        }
    }

    if ($res == null) {
        foreach (menus_landing() as $i) {
            if ($i['controller'] == 'home') {
                $res = $i;
            }
        }
    }

    return $res;
}

function check_role()
{
    $db = db('menu');

    $q = $db->where('role', session('role'))->where('controller', url())->get()->getRowArray();

    if (!$q) {
        gagal(base_url('home'), 'You are not allowed.');
    }
}

function url($req = null)
{

    $url = service('uri');
    $res = $url->getPath();
    if ($req == null) {
        if (settings()['online'] == 0) {
            $req = 2;
        } else {
            $req = 3;
        }
    } else {
        if (settings()['online'] == 0) {
            $req = $req - 1;
        }
    }

    $exp = explode("/", $res);

    if (array_key_exists($req, $exp)) {
        return $exp[$req];
    }


    return '';
}


function options($req = 'Role')
{

    $db = db('options');

    $q = $db->where('kategori', $req)->orderBy(($req == 'Pekerjaan' ? 'value' : 'no_urut'), 'ASC')->get()->getResultArray();
    return $q;
}

function merge_cols($tabel1, $tabel2, $tabel3 = null, $tabel4 = null)
{
    if ($tabel3 == null) {
        $col1 = get_cols($tabel1);
        $col1[] = $tabel1 . '.id as id';
        $col2 = get_cols($tabel2);

        $res = array_merge($col1, $col2);
    } elseif ($tabel4 == null) {
        $col1 = get_cols($tabel1);
        $col1[] = $tabel1 . '.id as id';
        $col2 = get_cols($tabel2);
        $col3 = get_cols($tabel3);

        $res = array_merge($col1, $col2, $col3);
    } else {
        $col1 = get_cols($tabel1);
        $col1[] = $tabel1 . '.id as id';
        $col2 = get_cols($tabel2);
        $col3 = get_cols($tabel3);
        $col4 = get_cols($tabel4);

        $res = array_merge($col1, $col2, $col3, $col4);
    }

    $data = [];
    foreach ($res as $i) {
        if ($i !== 'id') {
            if (!in_array($i, $data)) {
                $data[] = $i;
            }
        }
    }


    return $data;
}

function get_partai($id, $partai = null)
{
    $db = db('partai');

    if ($partai == null) {
        $q = $db->where('id', $id)->get()->getRowArray();
    } else {
        $q = $db->where('partai', $partai)->get()->getRowArray();
    }

    return $q;
}


function suara_partai($dapil)
{
    $cols = merge_cols('suara_partai', 'tps', 'partai');
    $db = db('suara_partai');
    $db->select($cols)->join('tps', 'tps_id=tps.id')->join('partai', 'partai_id=partai.id');
    if ($dapil !== 'All') {
        if ($dapil == null) {
            $db->where('kecamatan', 'Karangmalang');
        } else {
            $db->where('kecamatan', $dapil);
        }
    }
    $q = $db->orderBy('no_partai', 'ASC')->get()->getResultArray();

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

    $res = ['data' => $data, 'count' => count($q)];
    return $res;
}




// pileg
function get_tps($order = null)
{
    $db = db('tps');
    $tps = $db->where('kelurahan', upper_first(session('username')))->orderBy('id', 'ASC')->get()->getResultArray();

    $db = db('suara_caleg');
    $caleg = $db->select('suara_caleg.id as id, caleg_id,suara,nama,no_caleg,partai_id,partai,no_partai,color,tps,tps_id,alamat,kelurahan,kecamatan,pj,c1')->join('tps', 'tps_id=tps.id')->join('caleg', 'caleg_id=caleg.id')->join('partai', 'partai_id=partai.id')->where('kelurahan', upper_first(session('username')))->orderBy('tps', 'ASC')->orderBy('no_partai', 'ASC')->orderBy('no_caleg', 'ASC')->get()->getResultArray();
    $db = db('suara_partai');
    $partai = $db->select('suara_partai.id as id,partai_id,partai,no_partai,color,tps,tps_id,alamat,kelurahan,kecamatan,pj,suara,c1')->join('tps', 'tps_id=tps.id')->join('partai', 'partai_id=partai.id')->where('kelurahan', upper_first(session('username')))->orderBy('tps', 'ASC')->orderBy('no_partai', 'ASC')->get()->getResultArray();

    if ($order == null) {
        $data = ['caleg' => $caleg, 'partai' => $partai, 'tps' => $tps];
        return $data;
    }

    $calegs = [];
    $partais = [];

    foreach ($caleg as $i) {
        $val = explode(" ", $i['tps']);
        if ($val[0] == $order) {
            $calegs[] = $i;
        }
    }
    foreach ($partai as $i) {
        $val = explode(" ", $i['tps']);
        if ($val[0] == $order) {
            $partais[] = $i;
        }
    }

    $data = ['caleg' => $calegs, 'partai' => $partais, 'tps' => $tps];
    return $data;
}

function get_all_partai()
{
    $db = db('partai');

    $q = $db->orderBy('no_partai', 'ASC')->get()->getResultArray();

    return $q;
}
function get_all_caleg()
{
    $db = db('caleg');

    $q = $db->orderBy('partai_id', 'ASC')->orderBy('no_caleg', 'ASC')->get()->getResultArray();

    return $q;
}

function angka($uang)
{
    return number_format($uang, 0, ",", ".");
}

function total_suara($order, $id, $kel = null)
{

    if (session('role') == 'Admin') {
        $kel = upper_first(session('username'));
    }
    $db = db('suara_' . $order);

    $db->join('tps', 'tps_id=tps.id');
    if ($kel !== null) {
        $db->where('kelurahan', $kel);
    }

    $q = $db->where($order . '_id', $id)->get()->getResultArray();

    $total = 0;

    foreach ($q as $i) {
        $total += $i['suara'];
    }

    return $total;
}

function lock_data($order = null)
{
    if (settings('lock_data') == 1) {
        if ($order == null) {
            gagal(base_url('home'), 'Data locked!.');
        } else {
            gagal_js('Data locked!.');
        }
    }
}


function get_suara_by_kecamatan($order, $id, $kecamatan)
{

    $db = db('suara_' . $order);

    $q = $db->join('tps', 'tps_id=tps.id')->where('kecamatan', $kecamatan)->where($order . '_id', $id)->get()->getResultArray();

    $total = 0;

    foreach ($q as $i) {
        $total += $i['suara'];
    }

    return $total;
}

function get_all_kelurahan($kecamatan)
{
    $db = db('tps');
    $q = $db->where('kecamatan', $kecamatan)->orderBy('kelurahan', 'ASC')->groupBy('kelurahan')->get()->getResultArray();


    return $q;
}
function get_all_tps($kecamatan, $kelurahan)
{
    $db = db('tps');
    $q = $db->where('kecamatan', $kecamatan)->where('kelurahan', $kelurahan)->orderBy('id', 'ASC')->get()->getResultArray();


    return $q;
}
function get_suara_by_kelurahan($order, $id, $kecamatan, $kelurahan)
{

    $db = db('suara_' . $order);

    $q = $db->join('tps', 'tps_id=tps.id')->where('kecamatan', $kecamatan)->where('kelurahan', $kelurahan)->where($order . '_id', $id)->get()->getResultArray();

    $total = 0;

    foreach ($q as $i) {
        $total += $i['suara'];
    }

    return $total;
}
function get_suara_by_tps($order, $id, $kecamatan, $kelurahan, $tps)
{
    $db = db('suara_' . $order);

    $q = $db->join('tps', 'tps_id=tps.id')->where('kecamatan', $kecamatan)->where('kelurahan', $kelurahan)->where($order . '_id', $id)->get()->getResultArray();

    $data = [];
    foreach ($q as $i) {
        if ($i['tps_id'] == $tps['id']) {
            $data[] = $i;
        }
    }

    $total = 0;

    foreach ($data as $i) {
        $total += $i['suara'];
    }

    return $total;
}

function get_detail_tps($tps)
{
    $db = db('tps');

    $q = $db->where('id', $tps['id'])->get()->getRowArray();

    return $q;
}

function get_default_kelurahan($kecamatan, $kelurahan)
{
    $db = db('tps');
    $q = $db->where('kecamatan', $kecamatan)->where('kelurahan', $kelurahan)->get()->getRowArray();

    if (!$q) {
        $kelurahan = '';
        if ($kecamatan == 'Karangmalang') {
            $kelurahan = 'Plumbungan';
        } elseif ($kecamatan == 'Kedawung') {
            $kelurahan = 'Bendungan';
        } elseif ($kecamatan == 'Ngrampal') {
            $kelurahan = 'Kebonromo';
        }

        return $kelurahan;
    }

    return $kelurahan;
}

function get_suara_partai_by_kelurahan($kecamatan, $kelurahan)
{

    $cols = merge_cols('suara_partai', 'tps', 'partai');
    $db = db('suara_partai');
    $db->select($cols)->join('tps', 'tps_id=tps.id')->join('partai', 'partai_id=partai.id');
    $db->where('kecamatan', $kecamatan);
    $db->where('kelurahan', $kelurahan);
    $q = $db->orderBy('no_partai', 'ASC')->orderBy('kelurahan', 'ASC')->orderBy('tps_id', 'ASC')->get()->getResultArray();

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

    $res = ['data' => $data, 'count' => count($q)];
    return $res;
}
function get_suara_caleg_by_kelurahan($kecamatan, $kelurahan)
{

    $cols = merge_cols(menu()['tabel'], 'tps', 'partai', 'caleg');
    $db = db(menu()['tabel']);
    $db->select($cols)->join('tps', 'tps_id=tps.id')->join('caleg', 'caleg_id=caleg.id')->join('partai', 'caleg.partai_id=partai.id');

    $db->where('kecamatan', $kecamatan);
    $db->where('kelurahan', $kelurahan);
    $q = $db->orderBy('no_partai', 'ASC')->orderBy('kelurahan', 'ASC')->orderBy('tps_id', 'ASC')->orderBy('no_caleg', 'ASC')->get()->getResultArray();


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

    $res = ['data' => $data, 'count' => count($q)];
    return $res;
}

function get_default_tps($kecamatan, $kelurahan, $tps_id)
{

    $db = db('tps');
    $q = $db->where('kecamatan', $kecamatan)->where('kelurahan', $kelurahan)->where('id', $tps_id)->orderBy('id', 'ASC')->get()->getRowArray();

    if (!$q) {
        $q = $db->where('kecamatan', $kecamatan)->where('kelurahan', $kelurahan)->orderBy('id', 'ASC')->get()->getRowArray();
    }

    return $q;
}


// suara mustawa

function total_suara_mustawa($kecamatan = null)
{
    $dbc = db('caleg');
    $mustawa = $dbc->where('nama', 'Muhammad Bahrul Mustawa')->get()->getRowArray();

    $db = db('suara_caleg');
    $db->where('caleg_id', $mustawa['id']);
    if ($kecamatan !== null) {

        $db->join('tps', 'tps.id=tps_id');
        $db->where('kecamatan', $kecamatan);
    }
    $q = $db->get()->getResultArray();

    // $cols = merge_cols('suara_caleg', 'tps', 'partai', 'caleg');
    // $db->select($cols)->where('caleg_id', $mustawa['id'])->join('tps', 'tps_id=tps.id')->join('caleg', 'caleg_id=caleg.id')->join('partai', 'caleg.partai_id=partai.id');
    // $q = $db->orderBy('no_partai', 'ASC')->orderBy('kelurahan', 'ASC')->orderBy('tps_id', 'ASC')->orderBy('no_caleg', 'ASC')->get()->getResultArray();

    $total_suara = 0;

    foreach ($q as $i) {
        $total_suara += $i['suara'];
    }


    return $total_suara;
}
function total_suara_pkb($kecamatan = null)
{
    $dbc = db('partai');
    $pkb = $dbc->where('partai', 'Pkb')->get()->getRowArray();

    $db = db('suara_partai');
    $db->where('partai_id', $pkb['id']);
    if ($kecamatan !== null) {
        $db->join('tps', 'tps.id=tps_id');
        $db->where('kecamatan', $kecamatan);
    }
    $q = $db->get()->getResultArray();
    $total_suara = 0;

    foreach ($q as $i) {
        $total_suara += $i['suara'];
    }


    return $total_suara;
}

function target_suara($order = 'jiwa')
{
    if ($order == 'jiwa') {
        return 7000;
    }
    if ($order == 'partai') {
        return 10000;
    }
}

function format_persen($angka)
{
    return number_format((float)$angka, 1, '.', '');
}

function suara_belum_masuk($order, $kecamatan = null, $kelurahan = null, $ket = 'belum')
{
    $cols = merge_cols('suara_' . $order, 'tps', $order);

    $dbc = db($order);
    if ($order == 'caleg') {
        $data = $dbc->where('nama', 'Muhammad Bahrul Mustawa')->get()->getRowArray();
    }
    if ($order == 'partai') {
        $data = $dbc->where('partai', 'Pkb')->get()->getRowArray();
    }

    $db = db('suara_' . $order);
    $db->select($cols)->where($order . '_id', $data['id']);
    if ($ket == 'belum') {
        $db->where('suara', 0);
    }
    if ($ket == 'sudah') {
        $db->whereNotIn('suara', [0]);
    }

    $db->join('tps', 'tps_id=tps.id')->join($order, $order . '_id=' . $order . '.id');
    if ($kecamatan !== null) {

        $db->where('kecamatan', $kecamatan);
    }
    if ($kelurahan !== null) {
        $db->where('kelurahan', $kelurahan);
    }

    $q = $db->orderBy('kecamatan', 'ASC')->orderBy('kelurahan', 'ASC')->orderBy('tps_id', 'ASC')->orderBy('no_' . $order, 'ASC')->get()->getResultArray();

    return $q;
}
function c1_belum_masuk($kecamatan = null, $kelurahan = null, $ket = 'belum')
{
    $db = db('tps');

    $db;
    if ($kecamatan !== null) {

        $db->where('kecamatan', $kecamatan);
    }
    if ($kelurahan !== null) {
        $db->where('kelurahan', $kelurahan);
    }
    if ($ket == 'belum') {
        $db->where('c1', 'file-not-found.jpg');
    }
    if ($ket == 'sudah') {
        $db->whereNotIn('c1', ['file-not-found.jpg']);
    }

    $q = $db->orderBy('kecamatan', 'ASC')->orderBy('kelurahan', 'ASC')->orderBy('id', 'ASC')->get()->getResultArray();

    return $q;
}

function jumlah_tps()
{
    $db = db('tps');
    $q = $db->countAllResults();
    return $q;
}

function suara_tertinggi($order, $ket = 'DESC', $kecamatan = null, $kelurahan = null)
{
    $cols = merge_cols('suara_' . $order, 'tps', $order);

    $dbc = db($order);
    if ($order == 'caleg') {
        $data = $dbc->where('nama', 'Muhammad Bahrul Mustawa')->get()->getRowArray();
    }
    if ($order == 'partai') {
        $data = $dbc->where('partai', 'Pkb')->get()->getRowArray();
    }

    $db = db('suara_' . $order);
    $db->select($cols)->where($order . '_id', $data['id']);

    $db->join('tps', 'tps_id=tps.id')->join($order, $order . '_id=' . $order . '.id');
    if ($kecamatan !== null) {

        $db->where('kecamatan', $kecamatan);
    }
    if ($kelurahan !== null) {
        $db->where('kelurahan', $kelurahan);
    }

    $q = $db->orderBy('suara', $ket)->orderBy('kecamatan', 'ASC')->orderBy('kelurahan', 'ASC')->orderBy('tps_id', 'ASC')->orderBy('no_' . $order, 'ASC')->get()->getResultArray();

    return $q;
}

function suara_partai_dari_caleg($kecamatan = null)
{
    $dbc = db('partai');
    $pkb = $dbc->where('partai', 'Pkb')->get()->getRowArray();

    $db = db('suara_caleg');
    $db->where('partai_id', $pkb['id'])->join('caleg', 'caleg_id=caleg.id');
    if ($kecamatan !== null) {
        $db->join('tps', 'tps.id=tps_id');
        $db->where('kecamatan', $kecamatan);
    }
    $q = $db->get()->getResultArray();
    $total_suara = 0;

    foreach ($q as $i) {
        $total_suara += $i['suara'];
    }


    return $total_suara;
}

function per_kecamatan()
{
    $kar = suara_partai_dari_caleg('Karangmalang') + total_suara_pkb('Karangmalang');
    $ked = suara_partai_dari_caleg('Kedawung') + total_suara_pkb('Kedawung');
    $ngr = suara_partai_dari_caleg('Ngrampal') + total_suara_pkb('Ngrampal');

    if ($kar > 0 && $ked > 0 && $ngr > 0) {
        $total = $kar + $ked + $ngr;

        $karangmalang = round($kar / ($total) * 100);
        $kedawung = round(($ked / $total) * 100);
        $ngrampal = round(($ngr / $total) * 100);

        $q = ($karangmalang + $kedawung + $ngrampal) - 100;
        if ($q > 0) {
            $ngrampal = $ngrampal - $q;
        }

        $data = [
            ['kec' => 'Karangmalang', 'persen' => $karangmalang, 'suara' => $kar, 'jiwa' => total_suara_mustawa('Karangmalang'), 'partai' => total_suara_pkb('Karangmalang'), 'partai_caleg' => suara_partai_dari_caleg('Karangmalang'), 'bg' => 'bg_purple', 'segment' => 'Segment one'],
            ['kec' => 'Kedawung', 'persen' => $kedawung, 'suara' => $ked, 'jiwa' => total_suara_mustawa('Kedawung'), 'partai' => total_suara_pkb('Kedawung'), 'partai_caleg' => suara_partai_dari_caleg('Kedawung'), 'bg' => 'bg_success', 'segment' => 'Segment two'],
            ['kec' => 'Ngrampal', 'persen' => $ngrampal, 'suara' => $ngr, 'jiwa' => total_suara_mustawa('Ngrampal'), 'partai' => total_suara_pkb('Ngrampal'), 'partai_caleg' => suara_partai_dari_caleg('Ngrampal'), 'bg' => 'bg_main', 'segment' => 'Segment three']
        ];
    } else {

        $data = [
            ['kec' => 'Karangmalang', 'persen' => 0, 'suara' => 0, 'jiwa' => 0, 'partai' => 0, 'partai_caleg' => 0, 'bg' => 'bg_purple', 'segment' => 'Segment one'],
            ['kec' => 'Kedawung', 'persen' => 0, 'suara' => 0, 'jiwa' => 0, 'partai' => 0, 'partai_caleg' => 0, 'bg' => 'bg_success', 'segment' => 'Segment two'],
            ['kec' => 'Ngrampal', 'persen' => 0, 'suara' => 0, 'jiwa' => 0, 'partai' => 0, 'partai_caleg' => 0, 'bg' => 'bg_main', 'segment' => 'Segment three']
        ];
    }
    return $data;
}
