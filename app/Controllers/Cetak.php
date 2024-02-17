<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cetak extends BaseController
{

    public function excel()
    {
        return view('cetak/excel', ['judul' => 'Cetak Excel']);
        // $spreadsheet = new Spreadsheet();

        // $sheet = $spreadsheet->getActiveSheet();

        // $huruf = 'Z';

        // foreach ($new_cols as $k => $c) {
        //     $huruf++;
        //     if ($k < 26) {
        //         $sheet->setCellValue(substr($huruf, -1) . '1', upper_first(str_replace("_", " ", $c)));
        //     } else {
        //         $sheet->setCellValue('A' . substr($huruf, -1) . '1', upper_first(str_replace("_", " ", $c)));
        //     }
        // }



        // $rows = 1;
        // $huruf = 'Z';
        // foreach (rekap_seluruh_caleg() as $i) {
        //     dd($i);
        //     foreach ($new_cols as $k => $c) {
        //         $val = $i[$c];
        //         $huruf++;
        //         if ($k < 26) {
        //             $sheet->setCellValue(substr($huruf, -1) . $rows, $val);
        //         } else {
        //             $sheet->setCellValue('A' . substr($huruf, -1) . $rows, $val);
        //         }
        //     }
        //     $huruf = 'Z';
        //     $rows++;
        // }
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename=' . $judul . '.xlsx');
        // header('Cache-Control: maxe-age=0');

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('php://output');

        // exit;
    }
}
