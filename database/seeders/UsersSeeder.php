<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Иван',
            'surname' => 'Иванов',
            'patronymic' => 'Иванович',
            'region' => 'Россия, (Саратов)',
            'phone' => '+79173334444',
            'password' => Hash::make('1234567890'),
            'payments' => 10000,
            'test_passed' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
