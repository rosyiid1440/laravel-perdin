<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Admin','DIVISI-SDM','Pegawai'];

        foreach($data as $item){
            $user = new Role;
            $user->nama_role = $item;
            $user->save();
        }
    }
}