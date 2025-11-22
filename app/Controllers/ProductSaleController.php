<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use CodeIgniter\Controller;

class ProductSaleController extends Controller
{
    public function index()
    {
        $saleModel = new SaleModel();
        $productModel = new ProductModel();

        // 1. Get Sales History (joined with product names)
        $barangKeluar = $saleModel
            ->select('product_sales.*, products.name, products.code')
            ->join('products', 'products.id = product_sales.product_id')
            ->orderBy('product_sales.id', 'DESC')
            ->findAll();

        // 2. Get Active Products for the dropdown
        $products = $productModel->where('status', 'active')->findAll();

        return view('barang_keluar/index', [
            'barang_keluar' => $barangKeluar,
            'products'      => $products
        ]);
    }

    public function store()
    {
        $productModel = new ProductModel();
        $saleModel    = new SaleModel();

        $productId = $this->request->getPost('product_id');
        $qty       = (int)$this->request->getPost('qty');
        $price     = $this->request->getPost('price'); // Sale Price

        // 1. Validation: Check valid Qty
        if ($qty < 1) {
            return redirect()->back()->withInput()->with('error', 'Quantity must be at least 1');
        }

        // 2. Validation: Check Stock Availability
        $product = $productModel->find($productId);

        if (!$product) {
            return redirect()->back()->withInput()->with('error', 'Product not found');
        }

        if ($product['stock'] < $qty) {
            return redirect()->back()->withInput()->with('error', "Insufficient stock! Available: {$product['stock']}");
        }

        // 3. Process Sale
        $subtotal = $qty * $price;

        $saleModel->insert([
            'product_id'    => $productId,
            'customer_name' => $this->request->getPost('customer_name'),
            'sale_date'     => $this->request->getPost('sale_date'),
            'qty'           => $qty,
            'price'         => $price,
            'subtotal'      => $subtotal,
        ]);

        // 4. Deduct Stock (The reverse of Purchase)
        $newStock = $product['stock'] - $qty;
        $productModel->update($productId, ['stock' => $newStock]);

        return redirect()->to(base_url('barang-keluar'))->with('success', 'Sale recorded successfully.');
    }

    public function delete($id)
    {
        $saleModel    = new SaleModel();
        $productModel = new ProductModel();

        // 1. Find the sale record
        $sale = $saleModel->find($id);

        if (!$sale) {
            return redirect()->back()->with('error', 'Data not found');
        }

        // 2. Find the product
        $product = $productModel->find($sale['product_id']);

        if ($product) {
            // 3. Revert Stock (Add the Sold Qty back to Stock)
            $currentStock = $product['stock'];
            $qtyRestored  = $sale['qty'];
            $newStock     = $currentStock + $qtyRestored;

            $productModel->update($sale['product_id'], ['stock' => $newStock]);
        }

        // 4. Delete Record
        $saleModel->delete($id);

        return redirect()->back()->with('success', 'Data deleted and stock restored.');
    }
}