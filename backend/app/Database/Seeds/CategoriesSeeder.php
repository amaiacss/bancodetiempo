<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CategoryModel;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $csvfile = fopen("../app/Database/Seeds/Categories.csv", "r");
        while(($data = fgetcsv($csvfile, null, ",")) !== False) {
            $item = new CategoryModel();
            $item->insert([
                'id' => $data[0],
                'name_es' => $data[1],
                'name_eu' => $data[2],
                'picture' => $data[3]
            ]);
        }
        fclose($csvfile);
    }
}
