<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\PoblacionesModel;

class PoblacionesSeeder extends Seeder
{
    public function run()
    {
        $csvfile = fopen("../app/Database/Seeds/Poblaciones.csv", "r");
        while(($data = fgetcsv($csvfile, null, ",")) !== False) {
            $item = new PoblacionesModel();
            $item->insert([
                'codigo' => $data[1],
                'codigo_provincia' => $data[0],
                'codigo_full' => $data[0].$data[1],
                'titulo' => $data[2]
            ]);
        }
        fclose($csvfile);
    }
}
