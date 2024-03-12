<?php

function sub_wilayah($wilayah = null)
{
    $ked = get_all_kelurahan('Kedawung');
    $kedawung = [];
    foreach ($ked as $i) {
        $kedawung[] = $i['kelurahan'];
    }
    $ngram = get_all_kelurahan('Ngrampal');
    $ngrampal = [];
    foreach ($ngram as $i) {
        $ngrampal[] = $i['kelurahan'];
    }
    $data = [
        ['text' => 'Karangmalang Barat', 'url' => 'Karangmalang_Barat', 'wilayah' => 'Plosokerep,Saradan,Kedungwaduk,Guworejo,Jurangjero'],
        ['text' => 'Karangmalang Tengah', 'url' => 'Karangmalang_Tengah', 'wilayah' => 'Puro,Kroyo'],
        ['text' => 'Karangmalang Timur', 'url' => 'Karangmalang_Timur', 'wilayah' => 'Mojorejo,Pelemgadung,Plumbungan'],
        ['text' => 'Kedawung', 'url' => 'Kedawung', 'wilayah' => implode(",", $kedawung)],
        ['text' => 'Ngrampal', 'url' => 'Ngrampal', 'wilayah' => implode(",", $ngrampal)],
    ];

    if ($wilayah == null) {
        return $data;
    } else {
        foreach ($data as $i) {
            if ($i['url'] == $wilayah) {
                return $i;
            }
        }
    }
}


function tps($kelurahan)
{

    $db = db('tps');
    $q = $db->where('kelurahan', $kelurahan)->get()->getResultArray();
    $data = [];
    foreach ($q as $i) {
        $i['no_tps'] = explode(" ", $i['tps'])[0];
        $data[] = $i;
    }
    $short_by = SORT_ASC;

    $keys = array_column($data, 'no_tps');
    array_multisort($keys, $short_by, $data);
    return $data;
}

function kordes($kelurahan, $tps, $wilayah)
{

    $db = db('kirka');
    $db->where('kelurahan', $kelurahan)->where('tps', $tps);
    if ($wilayah !== 'All') {
        $db->where('wilayah', $wilayah);
    }
    $q = $db->groupBy('kordes')->orderBy('kordes', 'ASC')->get()->getResultArray();
    $data = [];
    foreach ($q as $i) {
        if ($i['kordes'] == '') {
            $i['url'] = 'Kosong';
        }
        $data[] = $i;
    }
    return $data;
}

function pengkirka($kelurahan, $tps, $kordes, $wilayah)
{
    $db = db('kirka');
    $db->where('kelurahan', $kelurahan)->where('tps', $tps)->where('kordes', $kordes);
    if ($wilayah !== 'All') {
        $db->where('wilayah', $wilayah);
    }
    $q = $db->groupBy('pengkirka')->orderBy('pengkirka', 'ASC')->get()->getResultArray();
    $data = [];
    foreach ($q as $i) {
        if ($i['pengkirka'] == '') {
            $i['url'] = 'Kosong';
        }
        $data[] = $i;
    }
    return $data;
}
function konstituen($kelurahan, $tps, $kordes, $pengkirka, $wilayah)
{
    $db = db('kirka');
    $db->where('kelurahan', $kelurahan)->where('tps', $tps)->where('kordes', $kordes)->where('pengkirka', $pengkirka);
    if ($wilayah !== 'All') {
        $db->where('wilayah', $wilayah);
    }
    $q = $db->orderBy('dukuh', 'ASC')->orderBy('rt', 'ASC')->orderBy('nama_konstituen', 'ASC')->get()->getResultArray();
    $data = [];
    foreach ($q as $i) {
        if ($i['nama_konstituen'] == '') {
            $i['url'] = 'Kosong';
        }
        $data[] = $i;
    }
    return $data;
}
function konstituen_by_kordes($kelurahan, $tps, $kordes, $wilayah)
{
    $db = db('kirka');
    $db->where('kelurahan', $kelurahan)->where('tps', $tps)->where('kordes', $kordes);
    if ($wilayah !== 'All') {
        $db->where('wilayah', $wilayah);
    }
    $q = $db->countAllResults();

    return $q;
}


function total_konstituen($kelurahan, $tps, $wilayah)
{
    $db = db('kirka');
    $db->where('kelurahan', $kelurahan)->where('tps', $tps);
    if ($wilayah !== 'All') {
        $db->where('wilayah', $wilayah);
    }
    $q = $db->countAllResults();
    return $q;
}

function suara_jiwa($tps_id)
{
    $db = db('suara_caleg');

    $q = $db->join('caleg', 'caleg_id=caleg.id')->where('tps_id', $tps_id)->where('caleg_id', caleg_mustawa()['id'])->get()->getRowArray();
    return $q;
}
function suara_pkb($tps_id)
{
    $db = db('suara_partai');

    $q = $db->join('partai', 'partai_id=partai.id')->where('tps_id', $tps_id)->where('partai_id', partai_pkb()['id'])->get()->getRowArray();
    return $q;
}

function kompetitor($tps_id)
{
    $db = db('suara_caleg');

    $q = $db->join('caleg', 'caleg_id=caleg.id')->where('tps_id', $tps_id)->whereNotIn('caleg_id', [caleg_mustawa()['id']])->orderBy('suara', 'DESC')->limit(3)->get()->getResultArray();
    return $q;
}

function data_kirka()
{
}
