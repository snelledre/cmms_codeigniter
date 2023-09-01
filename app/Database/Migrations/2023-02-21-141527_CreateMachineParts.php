<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMachineParts extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'varchar', 'constraint' => 64, 'unique' => true],
            'description'      => ['type' => 'varchar', 'constraint' => 128, 'null' => true],
            'image'            => ['type' => 'varchar', 'constraint' => 128, 'null' => true],
            'status'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'machine_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('machine_id', 'machines', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('machineparts', true);

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropForeignKey('machines', 'machineparts_machine_id_foreign');
        $this->forge->dropTable('machineparts', true);
    }
}
