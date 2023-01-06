<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ActivityModel;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $csvfile = fopen("../app/Database/Seeds/Activities.csv", "r");
        while(($data = fgetcsv($csvfile, null, ",")) !== False) {
            $item = new ActivityModel();
            $item->insert([
                'id' => $data[0],
                'title' => $data[1],
                'description' => $data[2],
                'created_at' => $data[3],
                'updated_at' => $data[3],
                'idCategory' => $data[4],
                'idUser' => $data[5]
            ]);
        }
        fclose($csvfile);
    }
}
