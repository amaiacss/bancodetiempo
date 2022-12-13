<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    public function run()
    {
        $res = explode("\n", $this->listProvinces());
        $data = [];
        foreach($res as $item)
        {
            $item = explode("\t", $item);
            $item = array_map('trim', $item);
            $data[] = [
                'code' => $item[0],
                'name' => $item[1]
            ];
        }
        $this->db->table('provinces')->insertBatch($data);
    }

    private function listProvinces() {
        $str = '01	Araba
                48	Bizkaia
                20	Gipuzkoa
                31	Navarra';
        return $str;
    }
}
