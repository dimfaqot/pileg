<?php

namespace App\Controllers;

class Js extends BaseController
{

    public function get_kelurahan()
    {

        $kecamatan = clear($this->request->getVar('kecamatan'));
        $data = get_all_kelurahan($kecamatan);

        sukses_js('Ok', $data);
    }
}
