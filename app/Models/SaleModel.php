<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'product_sales';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_id',
        'customer_name',
        'sale_date',
        'qty',
        'price',
        'subtotal',
    ];
}