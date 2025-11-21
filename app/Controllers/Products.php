<?php

namespace App\Controllers;
use App\Models\ProductModel;

class Products extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // Show all products
    public function index()
    {
        $data = [
            'products' => $this->productModel->findAll()
        ];
        return view('products/index', $data);
    }

    // Show form to add new product
    public function create()
    {
        return view('products/create');
    }

    // Save new product
    public function store()
    {
        $model = new ProductModel();

        $data = [
            'name'          => $this->request->getPost('name'),
            'code'          => $this->request->getPost('code'),
            'category'      => $this->request->getPost('category'),
            'unit'          => $this->request->getPost('unit'),
            'default_price' => $this->request->getPost('default_price'),
            'stock'         => 0, // <-- default stock
            'status'        => 'active'
        ];

        $model->insert($data);
        return redirect()->to(base_url('products'))->with('success', 'Produk berhasil ditambahkan.');
    }

    // Show edit form
    public function edit($id)
    {
        $data = [
            'product' => $this->productModel->find($id)
        ];
        return view('products/edit', $data);
    }

    // Update product
    public function update($id)
    {
        $this->productModel->update($id, [
            'name' => $this->request->getPost('name'),
            'code' => $this->request->getPost('code'),
            'category' => $this->request->getPost('category'),
            'unit' => $this->request->getPost('unit'),
            'default_price' => $this->request->getPost('default_price'),
            'stock' => $this->request->getPost('stock'),
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully.');
    }

    // Soft delete / deactivate product
    public function deactivate($id)
    {
        $this->productModel->update($id, ['status' => 'inactive']);
        return redirect()->to('/products')->with('success', 'Product deactivated.');
    }

    // Reactivate a product
    public function activate($id)
    {
        $this->productModel->update($id, ['status' => 'active']);
        return redirect()->to('/products')->with('success', 'Product reactivated.');
    }

}
