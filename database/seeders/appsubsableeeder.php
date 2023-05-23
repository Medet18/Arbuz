<?php

namespace Database\Seeders;

use App\Models\appsubs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class appsubsableeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subs = [
            [
                'name' => 'prime',
                'during' => '1 week',
                'price' => 990.9,
            ],
            [
                'name' => 'prime+',
                'during' => '1 month',
                'price' => 1890.9,
            ],
            [
                'name' => 'prime ultra',
                'during' => '6 month',
                'price' => 2990.9,
            ],
            [
                'name' => 'prime pro max',
                'during' => '12 month',
                'price' => 5990.9,
            ]
        ];

        foreach ($subs as $key => $val){
            appsubs::create($val);
        }

    }
}
