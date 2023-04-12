<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Demo',
                'email' => 'name@army.lk',
                'status' => '1',
                'last_login' => '2023-04-06 04:18:39',
                'password' => '$10$9w8wZjdqG/rp8PorVDWzQOT.RHAvumcY8UfpORGL4fgEjSckxpe0u'
            ],
            [
                'name' => 'mail@army.lk',
                'email' => 'mail@army.lk',
                'status' => '1',
                'last_login' => '2023-04-06 04:18:39',
                'password' => '$2y$10$g1qH2JySSkZnuDbwfUYbqugYILEcKhut2OVfQdfaHYAzN1nxNginu'
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
