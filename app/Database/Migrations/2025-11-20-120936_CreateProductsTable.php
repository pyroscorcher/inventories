<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'unique'     => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'unit' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'default_price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
            ],
            'stock' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default' => 'active',
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
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
