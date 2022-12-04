<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProvinciasSeeder extends Seeder
{
    public function run()
    {
        $res = explode("\n", $this->ListarProvincias());
        $data = [];
        foreach($res as $item)
        {
            $item = explode("\t", $item);
            $item = array_map('trim', $item);
            $data[] = [
                'codigo' => $item[0],
                'titulo_es' => $item[1]
            ];
        }
        $this->db->table('provincias')->insertBatch($data);
    }

    private function ListarProvincias() {
        $str = '01	Araba/Álava
                48	Bizkaia
                20	Gipuzkoa
                31	Navarra';
        return $str;
    }
}
