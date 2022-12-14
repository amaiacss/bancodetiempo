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
                'name' => $data[0],
                'picture' => $data[1]
            ]);
        }
        fclose($csvfile);
    }
}
