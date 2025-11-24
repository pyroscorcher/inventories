<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductPurchases extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'supplier_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'purchase_date' => [
                'type' => 'DATE'
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2'
            ],
            'subtotal' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2'
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_purchases');
    }

    public function down()
    {
        $this->forge->dropTable('product_purchases');
    }
}
