<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UsersSeeder extends Seeder
{
    public function run()
    {        
        $res = explode("\n", $this->listUsers());
        $data = [];
        foreach($res as $item)
        {
            $item = explode("\t", $item);
            $item = array_map('trim', $item);
            $data[] = [
                'id' => $item[0],
                'email' => $item[1],
                'username' => $item[2],
                'pass' => md5('Aa123456'),
                'verified' => 1
            ];
        }
        $this->db->table('users')->insertBatch($data);
    }

    private function listUsers() {
        $str = '1	nvega@birt.eus	nvega
                2	acasas@birt.eus	acasas
                3	iaguirreche@birt.eus	iaguirreche
                4	anruiz@birt.eus	anruiz
                9000	superuser@omnipresente.soy	superuser';
        return $str;
    }
}
