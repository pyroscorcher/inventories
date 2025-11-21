<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\PurchaseModel;
use CodeIgniter\Controller;

class ProductPurchaseController extends Controller
{
    public function index()
    {
        $purchaseModel = new PurchaseModel();

        $data['purchases'] = $purchaseModel
            ->select('product_purchases.*, products.name as product_name')
            ->join('products', 'products.id = product_purchases.product_id')
            ->orderBy('product_purchases.id', 'DESC')
            ->findAll();

        return view('barang_masuk/index', $data);
    }

    public function create()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->where('status', 'active')->findAll();

        return view('barang_masuk/create', $data);
    }

    public function store()
    {
        $productModel  = new ProductModel();
        $purchaseModel = new PurchaseModel();

        $productId = $this->request->getPost('product_id');
        $price     = $this->request->getPost('price');
        $qty       = $this->request->getPost('qty');

        if ($qty < 1) {
            return redirect()->back()->with('error', 'Qty must be at least 1');
        }

        $subtotal = $qty * $price;

        // Save purchase record
        $purchaseModel->insert([
            'product_id'    => $productId,
            'supplier_name' => $this->request->getPost('supplier_name'),
            'purchase_date' => $this->request->getPost('purchase_date'),
            'qty'           => $qty,
            'price'         => $price,
            'subtotal'      => $subtotal,
        ]);

        // Update stock
        $product = $productModel->find($productId);
        $newStock = $product['stock'] + $qty;

        $productModel->update($productId, ['stock' => $newStock]);

        return redirect()->to(base_url('barang-masuk'))->with('success', 'Purchase saved & stock updated.');
    }
}
