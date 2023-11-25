<?php

use Illuminate\Database\Seeder;

class InitialGiftsCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=InitialGiftsCardSeeder
     * 
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        $date->modify("+12 months");
        DB::table('gift_cards')->insert([
            'code' => '19gC25',
            'title' => 'GC01',
            'description' => '$25.00 GC which will deposit 25 Credits',
            'purchase_price' => 25,
            'credit_amount' => 25,
            'status' => 1,
            'expiry_date' => $date,
            'image' => 'yuIv5m47TV.jpg',
        ]);
        DB::table('gift_cards')->insert([
            'code' => '19Gc60',
            'title' => 'GC02',
            'description' => '$50.00 GC which will deposit 60 Credits',
            'purchase_price' => 50,
            'credit_amount' => 60,
            'status' => 1,
            'expiry_date' => $date,
            'image' => 'Xq787HmVRu.jpg',
        ]);
        DB::table('gift_cards')->insert([
            'code' => '19g125',
            'title' => 'GC03',
            'description' => '$100.00 GC which will deposit 125 Credits',
            'purchase_price' => 100,
            'credit_amount' => 125,
            'status' => 1,
            'expiry_date' => $date,
            'image' => '1NCSN8FGxN.jpg',
        ]);
    }
}
