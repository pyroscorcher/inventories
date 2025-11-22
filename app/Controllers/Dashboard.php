<?php

    namespace App\Controllers;
    use App\Models\ProductModel;

    class Dashboard extends BaseController
    {
        public function index()
        {
            if (!session()->get('logged_in')) {
                return redirect()->to('/');
            }

            $productModel = new ProductModel();
            
            // Fetch all products ordered by latest created
            $data['products'] = $productModel->orderBy('id', 'DESC')->findAll();

            return view('dashboard');
        }

        public function productdelete($id)
        {
            $productModel = new ProductModel();
            $productModel->delete($id);
            return redirect()->to(base_url('products'))->with('success', 'Data berhasil dihapus');
        }
    }
