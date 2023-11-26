<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
    }
    public function index(): string
    {
        return view('home', ['judul' => 'Home']);
    }
}
