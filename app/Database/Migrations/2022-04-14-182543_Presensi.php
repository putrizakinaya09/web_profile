<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Presensi extends Migration
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
            'id_matakuliah'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_mahasiswa'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'ip_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'status'          => [
                'type'           => 'BOOLEAN',
            ],
            'tanggal_presensi'       => [
                'type'       => 'DATETIME',
                'nullable'   => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_matakuliah', 'matakuliah', 'id');
        $this->forge->addForeignKey('id_mahasiswa', 'mahasiswa', 'id');
        $this->forge->createTable('presensi');
    }

    public function down()
    {
        $this->forge->dropTable('presensi');
    }
}
