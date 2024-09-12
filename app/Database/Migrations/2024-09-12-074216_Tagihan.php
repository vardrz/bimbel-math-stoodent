<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tagihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'siswa_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'bulan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'tahun' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'biaya' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tagihan');
    }

    public function down()
    {
        $this->forge->dropTable('tagihan');
    }
}
