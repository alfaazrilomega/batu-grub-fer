<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\ArtikelModel;
use App\Models\KarirModel;
use App\Models\KomoditasModel;
use App\Models\KontakModel;
use App\Models\LowonganModel;
use App\Models\MetaModel;
use App\Models\SliderModel;
use App\Models\TentangModel;

class DashboardController extends BaseController
{
    protected $anggotaModel;
    protected $artikelModel;
    protected $karirModel;
    protected $komoditasModel;
    protected $kontakModel;
    protected $lowonganModel;
    protected $metaModel;
    protected $sliderModel;
    protected $tentangModel;
    
    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->artikelModel = new ArtikelModel();
        $this->karirModel = new KarirModel();
        $this->komoditasModel = new KomoditasModel();
        $this->kontakModel = new KontakModel();
        $this->lowonganModel = new LowonganModel();
        $this->metaModel = new MetaModel();
        $this->sliderModel = new SliderModel();
        $this->tentangModel = new TentangModel();
    }
    
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }
        
        $data = [
            'title' => 'Dashboard Admin',
            'total_anggota' => $this->anggotaModel->countAll(),
            'total_artikel' => $this->artikelModel->countAll(),
            'total_karir' => $this->karirModel->countAll(),
            'total_komoditas' => $this->komoditasModel->countAll(),
            'total_lowongan' => $this->lowonganModel->countAll(),
            'total_meta' => $this->metaModel->countAll(),
            'total_slider' => $this->sliderModel->countAll(),
        ];
        
        return view('admin/dashboard/index', $data);
    }
}