<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profil extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        return view('pages/profil', ['locale' => $locale]);
    }
}
