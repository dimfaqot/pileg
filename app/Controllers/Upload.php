<?php

namespace App\Controllers;

class Upload extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
        if (session('role') !== 'Root' && session('role') !== 'Admin') {
            gagal(base_url('home'), 'You are not allowed!.');
        }
    }

    public function upload_c1()
    {

        $kelurahan = $this->request->getVar('kelurahan');
        $tps = $this->request->getVar('tps');
        $url = $this->request->getVar('url');
        $id = $this->request->getVar('id');
        $file = $_FILES['file'];

        $db = db('tps');
        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {

            gagal($url, 'Id TPS tidak ditemukan.');
        }

        if ($file['error'] == 4) {
            gagal($url, 'File belum dipilih.');
        }

        $randomname = str_replace(" ", "-", str_replace("/", "", str_replace(".", "", str_replace(",", "", time() . '_'  . '_' . $kelurahan . '_' . $tps))));

        if ($file['error'] == 0) {
            $size = $file['size'];

            if ($size > 5000000) {
                gagal($url, 'Ukuran file maksimal 2 MB.');
            }

            $ext = ['pdf'];
            $exp = explode(".", $file['name']);
            $exe = strtolower(end($exp));

            if (array_search($exe, $ext) === false) {
                gagal($url, 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
            }
            if (settings('online') == 0) {
                $dir = 'files/c1/';
            }

            if (settings('online')) {
                $dir = '/home/u1733924/public_html/pileg/files/c1/';
            }

            $upload = $dir . $randomname . '.' . $exe;

            if (!move_uploaded_file($file['tmp_name'], $upload)) {
                gagal($url, 'File gagal diupload.');
            } else {
                if ($q['c1'] !== 'file-not-found.jpg') {
                    if (!unlink($dir . $q['c1'])) {
                        gagal($url, 'File lama gagal dihapus.');
                    }
                }

                $q['c1'] = $randomname . '.' . $exe;


                $db->where('id', $id);
                if ($db->update($q)) {
                    sukses($url, 'File sukses diupload.');
                } else {
                    gagal($url, 'Db gagal diupdate.');
                }
            }
        }
    }
}
