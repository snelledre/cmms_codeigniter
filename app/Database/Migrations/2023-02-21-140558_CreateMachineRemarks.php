<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMachineRemarks extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'subject'          => ['type' => 'varchar', 'constraint' => 64],
            'quickremark'      => ['type' => 'varchar', 'constraint' => 256],
            'action'           => ['type' => 'varchar', 'constraint' => 64, 'null' => true],
            'machine_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('machine_id', 'machines', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('locations', true);

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropForeignKey('machineremarks', 'machineremarks_machine_id_foreign');
        $this->forge->dropTable('machineremarks', true);
    }
}
