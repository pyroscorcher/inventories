<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductSale extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sale_date' => [
                'type' => 'DATE',
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'subtotal' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
        ]);

        $this->forge->addKey('id', true);
        // Add Foreign Key with Cascade
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_sales');
    }

    public function down()
    {
        // Drop tables in reverse order to avoid FK constraint errors
        $this->forge->dropTable('product_sales');
        $this->forge->dropTable('product_purchases');
        $this->forge->dropTable('products');
    }
}