<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CityModel;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $csvfile = fopen("../app/Database/Seeds/Cities.csv", "r");
        while(($data = fgetcsv($csvfile, null, ",")) !== False) {
            $item = new CityModel();
            $item->insert([
                'codeProvince' => $data[0],
                'codeCity' => $data[1],
                'name' => $data[2]
            ]);
        }
        fclose($csvfile);
    }
}
