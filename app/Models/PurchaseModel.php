<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table = 'product_purchases';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_id',
        'supplier_name',
        'purchase_date',
        'qty',
        'price',
        'subtotal',
    ];
}
