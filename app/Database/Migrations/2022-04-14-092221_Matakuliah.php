<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Matakuliah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_matakuliah'       => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'jadwal_absensi'       => [
                'type'       => 'TIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('matakuliah');
    }

    public function down()
    {
        $this->forge->dropTable('matakuliah');
    }
}
