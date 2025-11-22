<?php

namespace App\Controllers;
use App\Models\PurchaseModel;
use App\Models\SaleModel;

class Laporan extends BaseController
{
    protected $masuk;
    protected $keluar;

    public function __construct()
    {
        $this->masuk = new PurchaseModel();
        $this->keluar = new SaleModel();
    }
    public function umum()
    {
        $data['barang_masuk'] = $this->masuk->findAll();
        $data['barang_keluar'] = $this->keluar->findAll();

        $data['total_masuk'] = $this->masuk->selectSum('total_harga')->first()['total_harga'];
        $data['total_keluar'] = $this->keluar->selectSum('total_harga')->first()['total_harga'];

        $html = view('laporan/umum_pdf', $data);
        return load_pdf($html, 'laporan-umum.pdf');
    }
    public function barangMasuk()
    {
        $data['barang_masuk'] = $this->masuk->findAll();
        $data['total_masuk'] = $this->masuk->selectSum('total_harga')->first()['total_harga'];

        $html = view('laporan/barang_masuk_pdf', $data);
        return load_pdf($html, 'laporan-barang-masuk.pdf');
    }
    public function barangKeluar()
    {
        $data['barang_keluar'] = $this->keluar->findAll();
        $data['total_keluar'] = $this->keluar->selectSum('total_harga')->first()['total_harga'];

        $html = view('laporan/barang_keluar_pdf', $data);
        return load_pdf($html, 'laporan-barang-keluar.pdf');
    }
}
