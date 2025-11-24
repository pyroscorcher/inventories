<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockOpname extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'product_id' => [
                'type'     => 'INT',
                'unsigned' => true,   // MUST MATCH products.id
                'null'     => false,
            ],

            'system_stock' => [
                'type'    => 'INT',
                'default' => 0,
            ],

            'physical_stock' => [
                'type'    => 'INT',
                'default' => 0,
            ],

            'difference' => [
                'type'    => 'INT',
                'default' => 0,
            ],

            'note' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // Add Foreign Key
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('stock_opname', true);
    }

    public function down()
    {
        $this->forge->dropTable('stock_opname', true);
    }
}
