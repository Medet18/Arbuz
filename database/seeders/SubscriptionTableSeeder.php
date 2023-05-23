<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'name_subs' => 'prime',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addWeek(),
            'status' => 'active',
        ]);
    }
}
