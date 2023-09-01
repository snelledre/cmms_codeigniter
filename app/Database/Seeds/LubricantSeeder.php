<?php

namespace App\Database\Seeds;

use App\Models\LubricantModel;
use CodeIgniter\Database\Seeder;

class LubricantSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents("data/lubricants-data.json");
        $lubricants = json_decode($json);

        foreach ($lubricants->lubricants as $key => $value) {
            $object = new LubricantModel;
            $object->insert([
                "supplier" => $value->supplier,
                "name" => $value->name,
                "description" => $value->description,
                "status" => $value->status
            ]);
        }
    }
}
