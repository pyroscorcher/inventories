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
        $productModel = new ProductModel(); // 1. Load ProductModel

        // Get the list of purchases (Barang Masuk history)
        $barangMasuk = $purchaseModel
            ->select('product_purchases.*, products.name')
            ->join('products', 'products.id = product_purchases.product_id')
            ->orderBy('product_purchases.id', 'DESC')
            ->findAll();

        // 2. Get the list of products for the dropdown form
        $products = $productModel->where('status', 'active')->findAll();

        // 3. Pass BOTH variables to the view
        return view('barang_masuk/index', [
            'barang_masuk' => $barangMasuk,
            'products'     => $products // This fixes the "Undefined variable" error
        ]);
    }

    public function delete($id)
    {
        $purchaseModel = new PurchaseModel();
        $productModel = new ProductModel();

        // 1. Find the purchase record BEFORE deleting it
        $purchase = $purchaseModel->find($id);

        if (!$purchase) {
            return redirect()->back()->with('error', 'Data not found');
        }

        // 2. Get the current product data
        $product = $productModel->find($purchase['product_id']);

        if ($product) {
            // 3. Revert the stock (Subtract the qty that was added)
            $currentStock = $product['stock'];
            $qtyToDelete  = $purchase['qty'];
            $newStock     = $currentStock - $qtyToDelete;

            // Update the product stock
            $productModel->update($purchase['product_id'], ['stock' => $newStock]);
        }

        // 4. Now delete the purchase record
        $purchaseModel->delete($id);

        return redirect()->back()->with('success', 'Data successfully deleted and stock reverted.');
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
            session()->setFlashdata('error', 'Qty must be at least 1');
            return redirect()->back()->withInput();
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

        session()->setFlashdata('success', 'Purchase saved & stock updated.');
        return redirect()->to(base_url('barang-masuk'));
    }
}