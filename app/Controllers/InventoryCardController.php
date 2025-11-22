<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\SaleModel;
use App\Models\StockOpnameModel;
use CodeIgniter\Controller;

class InventoryCardController extends Controller
{
    public function index()
    {
        $productModel = new ProductModel();

        return view('inventorycard/index', [
            'products' => $productModel->findAll(),
            'result' => null
        ]);
    }

    public function filter()
    {
        $productModel = new ProductModel();
        $purchaseModel = new PurchaseModel();
        $saleModel = new SaleModel();
        $opnameModel = new StockOpnameModel();

        $product_id = $this->request->getPost('product_id');
        $from = $this->request->getPost('from');
        $to = $this->request->getPost('to');

        // Get product data
        $product = $productModel->find($product_id);

        // Calculate stock awal
        // Sum of purchases before period - sum of sales before period
        $total_masuk_before = $purchaseModel->where('product_id', $product_id)
                                            ->where('purchase_date <', $from)
                                            ->selectSum('qty')
                                            ->first()['qty'] ?? 0;

        $total_keluar_before = $saleModel->where('product_id', $product_id)
                                         ->where('sale_date <', $from)
                                         ->selectSum('qty')
                                         ->first()['qty'] ?? 0;

        // Stock awal = transaksi sebelum periode
        $stock_awal = $total_masuk_before - $total_keluar_before;

        // Total masuk periode
        $total_masuk = $purchaseModel->where('product_id', $product_id)
                                     ->where('purchase_date >=', $from)
                                     ->where('purchase_date <=', $to)
                                     ->selectSum('qty')
                                     ->first()['qty'] ?? 0;

        // Total keluar periode
        $total_keluar = $saleModel->where('product_id', $product_id)
                                  ->where('sale_date >=', $from)
                                  ->where('sale_date <=', $to)
                                  ->selectSum('qty')
                                  ->first()['qty'] ?? 0;

        // Selisih opname (jika ada)
        $opname = $opnameModel->where('product_id', $product_id)
                              ->where('created_at >=', $from)
                              ->where('created_at <=', $to)
                              ->first();

        $selisih_opname = $opname['difference'] ?? 0;

        // Saldo akhir
        $saldo_akhir = $stock_awal + $total_masuk - $total_keluar + $selisih_opname;

        $result = [
            'product' => $product,
            'stock_awal' => $stock_awal,
            'total_masuk' => $total_masuk,
            'total_keluar' => $total_keluar,
            'selisih_opname' => $selisih_opname,
            'saldo_akhir' => $saldo_akhir,
            'from' => $from,
            'to' => $to
        ];

        return view('inventorycard/index', [
            'products' => $productModel->findAll(),
            'result' => $result
        ]);
    }
}
