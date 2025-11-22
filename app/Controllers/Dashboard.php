<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel  = new ProductModel();
        $purchaseModel = new PurchaseModel();
        $saleModel     = new SaleModel();
        $userModel     = new UserModel();

        $totalCategories = $productModel
                            ->select('category')
                            ->distinct()
                            ->countAllResults();

        // Count unique units
        $totalUnits = $productModel
                        ->select('unit')
                        ->distinct()
                        ->countAllResults();

        // Count users
        $totalUsers = $userModel->countAllResults();

        $data = [
            'totalProducts'  => $productModel->countAllResults(),
            'totalPurchases' => $purchaseModel->countAllResults(),
            'totalSales'     => $saleModel->countAllResults(), 
            'totalCategories'=> $totalCategories,
            'totalUnits'     => $totalUnits,
            'totalUsers'     => $totalUsers, 
        ];

        return view('dashboard', $data);
    }
}