<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\RequestsModel;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        $csvfile = fopen("../app/Database/Seeds/Requests.csv", "r");
        while(($data = fgetcsv($csvfile, null, ",")) !== False) {
            $item = new RequestsModel();
            $item->insert([
                'id' => $data[0],
                'idActivity' => $data[1],
                'idUser' => $data[2],
                'idState' => $data[3],
                'hours' => $data[4],              
                'created_at' => $data[5],
                'updated_at' => $data[5]              
            ]);
        }
        fclose($csvfile);
    }
}
