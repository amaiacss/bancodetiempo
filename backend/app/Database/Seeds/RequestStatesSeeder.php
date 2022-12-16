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
                'name' => $item[1]
            ];
        }
        $this->db->table('requeststates')->insertBatch($data);
    }

    private function listRequestStates() {
        $str = 'P	Pendiente
                A	Aceptada
                C	Cancelada
                F	Finalizada';
        return $str;
    }
}
