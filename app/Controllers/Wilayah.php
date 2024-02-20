<?php

namespace App\Controllers;

class Wilayah extends BaseController
{
    public function index($wil = 'karangmalang_barat'): string
    {
        $wilayah = upper_first(str_replace("_", " ", $wil));

        return view('wilayah', ['judul' => 'Wilayah ' . $wilayah, 'wilayah' => $wilayah, 'wil' => $wil]);
    }

    public function cetak_pdf($order)
    {

        $judul = 'Wilayah ' . upper_first(str_replace("_", " ", $order));

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

        if ($order == 'Karangmalang' || $order == 'Kedawung' || $order == 'Ngrampal') {
            $data = rekap_seluruh_caleg($order);
        } else {
            $data = rekap_seluruh_caleg('Karangmalang', $order());
        }

        foreach ($data as $i) {

            $html = view('cetak/cetak_wilayah_pdf', ['judul' => $judul, 'data' => $i]);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
        }
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($judul . '.pdf', 'I');
    }
}
