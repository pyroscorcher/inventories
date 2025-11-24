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
            ],

            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'unit' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],

            'default_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],

            'stock' => [
                'type'       => 'INT',
                'default'    => 0,
            ],

            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,  // active by default
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
        $this->forge->createTable('products', true);
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
