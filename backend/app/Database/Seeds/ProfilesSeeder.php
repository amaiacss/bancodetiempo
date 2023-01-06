<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProfileModel;

class ProfilesSeeder extends Seeder
{
    public function run()
    {
        $csvfile = fopen("../app/Database/Seeds/Profiles.csv", "r");
        while(($data = fgetcsv($csvfile, null, ",")) !== False) {
            $item = new ProfileModel();            
            $result = $item->insert([
                'id' => $data[0],
                'firstName' => $data[1],
                'lastName' => $data[2],
                'phone' => $data[3],
                'aboutMe' => $data[4],                
                'locationCode' => $data[5],
                'picture' => $data[6]
            ]);
            echo $result;
        }
        fclose($csvfile);
    }
}
