<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanBarangKeluar extends BaseController
{
    public function laporanBarangKeluar()
    {
        $saleModel = new \App\Models\SaleModel();

        $data['barang_keluar'] = $saleModel
            ->select('product_sales.*, products.name as product_name')
            ->join('products', 'products.id = product_sales.product_id')
            ->findAll();

        $data['total_transaksi'] = $saleModel->select('SUM(subtotal) as total')->first()['total'] ?? 0;

        $html = view('laporan/keluar_pdf', $data);

        helper('pdf');
        load_pdf($html, 'laporan-barang-keluar.pdf');
    }
}
