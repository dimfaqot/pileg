<?php

namespace App\Controllers\Kirka;

use App\Controllers\BaseController;

class Kirka extends BaseController
{

    public function index(): string
    {
        // $file = fopen('data.csv', 'r');
        // $data = [];
        // $i = 0;
        // while (($line = fgetcsv($file)) !== FALSE) {

        //     $exp = explode(';', $line[0]);
        //     if ($i !== 0 && $i !== 15687) {

        //         if ($i == 4385) {
        //             $datas = [
        //                 'nama_konstituen' => 'LIS WIJI HARSIWI, SE.',
        //                 'wilayah' => 'EKSTERNAL',
        //                 'sub_wilayah' => 'NGRAMPAL',
        //                 'divisi' => 'BENER',
        //                 'kordes' => 'DIDIK SUDARMANTO',
        //                 'pengkirka' => 'APIN',
        //                 'nik' => '3314084305780000',
        //                 'tps' => '16',
        //                 'rt' => '24',
        //                 'dukuh' => 'BANGOAN',
        //                 'kelurahan' => 'BENER',
        //                 'kecamatan' => 'NGRAMPAL',
        //                 'cek_dpt' => 'OK',
        //                 'provinsi' => '',
        //                 'ri' => 'GUS SOFWAN'
        //             ];
        //         } elseif ($i == 5755) {
        //             $datas = [
        //                 'nama_konstituen' => 'SUPARNO',
        //                 'wilayah' => 'EKSTERNAL',
        //                 'sub_wilayah' => 'NGRAMPAL',
        //                 'divisi' => 'NGARUM',
        //                 'kordes' => 'ROIS',
        //                 'pengkirka' => 'SUPARNO',
        //                 'nik' => '',
        //                 'tps' => '14',
        //                 'rt' => '31',
        //                 'dukuh' => 'TUNGGUL SARI',
        //                 'kelurahan' => 'NGARUM',
        //                 'kecamatan' => 'NGRAMPAL',
        //                 'cek_dpt' => 'OK',
        //                 'provinsi' => '',
        //                 'ri' => 'BU LULUK'
        //             ];
        //         } elseif ($i == 6418) {
        //             $datas = [
        //                 'nama_konstituen' => 'MUHAMMAD EFENDI, SE.',
        //                 'wilayah' => 'EKSTERNAL',
        //                 'sub_wilayah' => 'KARANGAMALANG TIMUR',
        //                 'divisi' => 'PELEMGADUNG',
        //                 'kordes' => 'AHMAD ALIIF KHUMAID',
        //                 'pengkirka' => 'ANANG WARSITO',
        //                 'nik' => '3314091012730000',
        //                 'tps' => '7',
        //                 'rt' => '7',
        //                 'dukuh' => 'GUMANTAR',
        //                 'kelurahan' => 'PELEMGADUNG',
        //                 'kecamatan' => 'KARANGMALANG',
        //                 'cek_dpt' => 'OK',
        //                 'provinsi' => 'PAK MUKAFI',
        //                 'ri' => 'GUS SOFWAN'
        //             ];
        //         } elseif ($i == 9515) {
        //             $datas = [
        //                 'nama_konstituen' => 'VITA OKTARINA, SE.',
        //                 'wilayah' => 'EKSTERNAL',
        //                 'sub_wilayah' => 'KARANGAMALANG TIMUR',
        //                 'divisi' => 'PLUMBUNGAN',
        //                 'kordes' => 'AHMAD ALIIF KHUMAID',
        //                 'pengkirka' => 'LAMTO',
        //                 'nik' => '',
        //                 'tps' => '21',
        //                 'rt' => '26',
        //                 'dukuh' => 'PLUMBUNGAN INDAH',
        //                 'kelurahan' => 'PLUMBUNGAN',
        //                 'kecamatan' => 'KARANGMALANG',
        //                 'cek_dpt' => 'SUSULAN',
        //                 'provinsi' => 'PAK NUR MUHAMMAD',
        //                 'ri' => 'GUS SOFWAN'
        //             ];
        //         } elseif ($i == 11635) {
        //             $datas = [
        //                 'nama_konstituen' => 'SUPARMAN, A.Md, T.SH, M.Si.',
        //                 'wilayah' => 'EKSTERNAL',
        //                 'sub_wilayah' => 'KARANGAMALANG TENGAH',
        //                 'divisi' => 'PURO',
        //                 'kordes' => 'DALIMAN',
        //                 'pengkirka' => 'EKO SUGIYONO',
        //                 'nik' => '',
        //                 'tps' => '9',
        //                 'rt' => '8',
        //                 'dukuh' => 'KARAS',
        //                 'kelurahan' => 'PURO',
        //                 'kecamatan' => 'KARANGMALANG',
        //                 'cek_dpt' => 'OK',
        //                 'provinsi' => 'PAK NUR MUHAMMAD',
        //                 'ri' => ''
        //             ];
        //         } elseif ($i == 12407) {
        //             $datas = [
        //                 'nama_konstituen' => 'SUGENG SUNARYO, S.Pd',
        //                 'wilayah' => 'EKSTERNAL',
        //                 'sub_wilayah' => 'KARANGAMALANG TENGAH',
        //                 'divisi' => 'PURO',
        //                 'kordes' => 'EKO SRI SUPARMI',
        //                 'pengkirka' => 'SRI LESTARI',
        //                 'nik' => '',
        //                 'tps' => '1',
        //                 'rt' => '41',
        //                 'dukuh' => 'MARGOMULYO',
        //                 'kelurahan' => 'PURO',
        //                 'kecamatan' => 'KARANGMALANG',
        //                 'cek_dpt' => 'OK',
        //                 'provinsi' => 'PAK MUKAFI',
        //                 'ri' => 'GUS SOFWAN'
        //             ];
        //         } elseif ($i == 12435) {
        //             $datas = [
        //                 'nama_konstituen' => 'YEFDA GUSTRI, S.Sos.',
        //                 'wilayah' => 'EKSTERNAL',
        //                 'sub_wilayah' => 'KARANGAMALANG TENGAH',
        //                 'divisi' => 'PURO',
        //                 'kordes' => 'FARIDA SUMNGATULAILA',
        //                 'pengkirka' => 'FARIDA SUMNGATULAILA',
        //                 'nik' => '1311016808860000',
        //                 'tps' => '13',
        //                 'rt' => '12',
        //                 'dukuh' => 'MARGOREJO',
        //                 'kelurahan' => 'PURO',
        //                 'kecamatan' => 'KARANGMALANG',
        //                 'cek_dpt' => 'OK',
        //                 'provinsi' => 'PAK NUR MUHAMMAD',
        //                 'ri' => 'GUS SOFWAN'
        //             ];
        //         } elseif ($i == 12961) {
        //             $datas = [
        //                 'nama_konstituen' => 'YEFDA GUSTRI, S.Sos.',
        //                 'wilayah' => 'INTERNAL',
        //                 'sub_wilayah' => 'SDI',
        //                 'divisi' => 'WALI SANTRI',
        //                 'kordes' => 'KHUMAIDI MUSTHOFA',
        //                 'pengkirka' => 'FARIDA HAPSARI',
        //                 'nik' => '1311016808860000',
        //                 'tps' => '13',
        //                 'rt' => '12',
        //                 'dukuh' => 'MARGOREJO',
        //                 'kelurahan' => 'PURO',
        //                 'kecamatan' => 'KARANGMALANG',
        //                 'cek_dpt' => 'OK',
        //                 'provinsi' => 'PAK NUR MUHAMMAD',
        //                 'ri' => ''
        //             ];
        //         } else {
        //             $datas = [
        //                 'nama_konstituen' => $exp[1],
        //                 'wilayah' => $exp[2],
        //                 'sub_wilayah' => $exp[3],
        //                 'divisi' => $exp[4],
        //                 'kordes' => $exp[5],
        //                 'pengkirka' => $exp[6],
        //                 'nik' => $exp[7],
        //                 'tps' => $exp[8],
        //                 'rt' => $exp[9],
        //                 'dukuh' => $exp[10],
        //                 'kelurahan' => $exp[11],
        //                 'kecamatan' => $exp[12],
        //                 'cek_dpt' => $exp[13],
        //                 'provinsi' => $exp[14],
        //                 'ri' => $exp[15]
        //             ];
        //         }
        //         $data[] = $datas;

        //         $nama_konstituen = '';
        //         $wilayah = '';
        //         $sub_wilayah = '';
        //         $divisi = '';
        //         $kordes = '';
        //         $pengkirka = '';
        //         $nik = '';
        //         $tps = '';
        //         $rt = '';
        //         $dukuh = '';
        //         $kelurahan = '';
        //         $kecamatan = '';
        //         $cek_dpt = '';
        //         $provinsi = '';
        //         $ri = '';
        //     }
        //     $i++;
        // }
        // $db = db('kirka');
        // $err = [];
        // fclose($file);

        // $kirka = $db->get()->getResultArray();


        // foreach ($kirka as $i) {
        //     if ($i['wilayah'] == 'Ekstern') {
        //         $i['wilayah'] = 'Eksternal';
        //         $db->where('id', $i['id']);
        //         $db->update($i);
        //     } elseif ($i['wilayah'] == 'Intern') {
        //         $i['wilayah'] = 'Internal';
        //         $db->where('id', $i['id']);
        //         $db->update($i);
        //     }
        // }
        // foreach ($kirka as $i) {
        //     if ($i['rt'] == '') {
        //         $err[] = $i;
        //     }
        //     $exp = str_split($i['rt']);
        //     if ($exp[0] == 0) {
        //         dd($i);
        //     }
        // }



        // $db = db('kirka');
        // for ($i = 0; $i < count($data); $i++) {
        //     $q = $db->where('id', $i)->get()->getRowArray();
        //     if ($data[$i]['cek_dpt'] == 'OKE' || $data[$i]['cek_dpt'] == 'OK') {
        //         $q['cek_dpt'] = 1;
        //     }
        //     $db->where('id', $i);
        //     $db->update($q);
        // }
        // $data = $db->orderBy('id', 'ASC')->get()->getResultArray();
        // foreach ($data as $i) {

        //     $i['ri'] = upper_first($i['ri']);
        //     $db->where('id', $i['id']);
        //     $db->update($i);
        // }



        return view('kirka/kirka', ['judul' => 'Wilayah']);
    }
    public function sub_wilayah($sub_wilayah = 'Karangmalang_Barat', $kelurahan = 'Guworejo', $wilayah = 'Eksternal')
    {
        return view('kirka/sub_wilayah', ['judul' => 'Sub Wilayah', 'sub_wilayah' => $sub_wilayah, 'kelurahan' => $kelurahan, 'wilayah' => $wilayah]);
    }
    public function download($sub_wilayah = 'Karangmalang_Barat', $kelurahan = 'Guworejo', $wilayah = 'Eksternal')
    {

        // $judul = 'DATA ' . strtoupper(str_replace("_", " ", $sub_wilayah)) . ' ' . strtoupper($kelurahan) . ' ' . strtoupper($wilayah);
        $judul = "Ok";
        $set = [
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'P',
            'margin_left' => 20,
            'margin_right' => 5,
            'margin_top' => 10

        ];

        $mpdf = new \Mpdf\Mpdf($set);
        // $html = view('cetak/kirka_pdf', ['judul' => $judul, 'sub_wilayah' => $sub_wilayah, 'kelurahan' => $kelurahan, 'wilayah' => $wilayah]);
        $html = view('cetak/kirka_pdf', ['judul' => $judul]);

        $mpdf->WriteHTML($html);


        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($judul . '.pdf', 'I');
    }
}
