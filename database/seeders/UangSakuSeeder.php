<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\uangSaku;

class UangSakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'awal' => 0,
                'akhir' => 60,
                'provinsi' => "0",
                'pulau' => "0",
                'luar_negeri' => "0",
                'nominal' => 0,
                'satuan' => "IDR",
            ],
            [
                'awal' => 60,
                'akhir' => 0,
                'provinsi' => "0",
                'pulau' => "0",
                'luar_negeri' => "0",
                'nominal' => 200000,
                'satuan' => "IDR",
            ],
            [
                'awal' => 60,
                'akhir' => 0,
                'provinsi' => "1",
                'pulau' => "0",
                'luar_negeri' => "0",
                'nominal' => 250000,
                'satuan' => "IDR",
            ],
            [
                'awal' => 60,
                'akhir' => 0,
                'provinsi' => "0",
                'pulau' => "1",
                'luar_negeri' => "0",
                'nominal' => 300000,
                'satuan' => "IDR",
            ],
            [
                'awal' => 60,
                'akhir' => 0,
                'provinsi' => "0",
                'pulau' => "0",
                'luar_negeri' => "1",
                'nominal' => 50,
                'satuan' => "USD",
            ],
        ];

        foreach($data as $item){
            $uangsaku = new UangSaku;
            $uangsaku->awal = $item['awal'];
            $uangsaku->akhir = $item['akhir'];
            $uangsaku->provinsi = $item['provinsi'];
            $uangsaku->pulau = $item['pulau'];
            $uangsaku->luar_negeri = $item['luar_negeri'];
            $uangsaku->nominal = $item['nominal'];
            $uangsaku->satuan = $item['satuan'];
            $uangsaku->save();
        }
    }
}