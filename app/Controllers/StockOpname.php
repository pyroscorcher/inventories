<?php

namespace App\Controllers;

use App\Models\ProductModel;

class StockOpname extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        return view('stockopname/index', [
            'products' => $products
        ]);
    }

    public function process()
    {
        $productModel = new ProductModel();

        $input = $this->request->getPost('opname'); // array [product_id => physical_stock]

        if ($input) {
            foreach ($input as $productId => $physicalStock) {
                $productId = (int)$productId;
                $physicalStock = (int)$physicalStock;

                $product = $productModel->find($productId);
                if (!$product) continue;

                // Update stock to physical stock
                $productModel->update($productId, [
                    'stock' => $physicalStock
                ]);
            }
        }

        return redirect()->to('/stockopname')->with('success', 'Stock opname berhasil diperbarui!');
    }
}
