<?php



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
