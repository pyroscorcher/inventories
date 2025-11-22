<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanBarangMasuk extends BaseController
{
    public function laporanBarangMasuk()
    {
        $purchaseModel = new \App\Models\PurchaseModel();

        $data['barang_masuk'] = $purchaseModel
            ->select('product_purchases.*, products.name as product_name')
            ->join('products', 'products.id = product_purchases.product_id')
            ->findAll();

        $data['total_transaksi'] = $purchaseModel->select('SUM(subtotal) as total')->first()['total'] ?? 0;

        $html = view('laporan/masuk_pdf', $data);

        helper('pdf');
        load_pdf($html, 'laporan-barang-masuk.pdf');
    }
}
