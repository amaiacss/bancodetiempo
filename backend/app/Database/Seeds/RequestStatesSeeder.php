<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RequestStatesSeeder extends Seeder
{
    public function run()
    {
        $res = explode("\n", $this->listRequestStates());
        $data = [];
        foreach($res as $item)
        {
            $item = explode("\t", $item);
            $item = array_map('trim', $item);
            $data[] = [
                'id' => $item[0],
                'name_es' => $item[1],
                'name_eu' => $item[2]
            ];
        }
        $this->db->table('requeststates')->insertBatch($data);
    }

    private function listRequestStates() {
        $str = 'P	Pendiente	Erantzunaren zain
                A	Aceptada	Onartua
                C	Cancelada	Ezeztatua
                F	Finalizada	Burutua';
        return $str;
    }
}
