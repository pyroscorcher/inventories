<?php

namespace App\Models;

use CodeIgniter\Model;

class StockOpnameModel extends Model
{
    protected $table = 'stock_opname';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_id',
        'system_stock',
        'physical_stock',
        'difference',
        'note',
        'created_at',
    ];

    protected $useTimestamps = true;
}
