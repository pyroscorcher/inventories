<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanUmum extends BaseController
{
    public function laporanUmum()
    {
        $purchaseModel = new \App\Models\PurchaseModel();
        $saleModel     = new \App\Models\SaleModel();

        // Total qty & total subtotal barang masuk
        $masuk = $purchaseModel
                    ->select('SUM(qty) as total_qty_masuk, SUM(subtotal) as total_transaksi_masuk')
                    ->first();

        // Total qty & total subtotal barang keluar
        $keluar = $saleModel
                    ->select('SUM(qty) as total_qty_keluar, SUM(subtotal) as total_transaksi_keluar')
                    ->first();

        $data = [
            'total_qty_masuk'         => $masuk['total_qty_masuk'] ?? 0,
            'total_transaksi_masuk'   => $masuk['total_transaksi_masuk'] ?? 0,

            'total_qty_keluar'        => $keluar['total_qty_keluar'] ?? 0,
            'total_transaksi_keluar'  => $keluar['total_transaksi_keluar'] ?? 0,

            'grand_total'             => ($keluar['total_transaksi_keluar'] ?? 0) - ($masuk['total_transaksi_masuk'] ?? 0),
        ];

        $html = view('laporan/umum_pdf', $data);

        helper('pdf');
        load_pdf($html, 'laporan-umum.pdf');
    }
}
