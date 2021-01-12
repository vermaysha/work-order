<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 20; $i++) {
            factory(Order::class)->create([
                'wo_number' => 'WO-' . sprintf('%04d', $i)
            ]);
        }
    }
}
