<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
       
        User::create([
            'name' => 'Админ',
            'surname' => 'Админов',
            'patronymic' => 'Админович',
            'login' => 'admin123',
            'email' => 'hot.ershik@gmail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

     
        $users = [
            [
                'name' => 'Юзер',
                'surname' => 'Иванов',
                'patronymic' => 'Иванович',
                'login' => 'user123',
                'email' => 'hot.ershik03@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Петр',
                'surname' => 'Петров',
                'patronymic' => 'Петрович',
                'login' => 'petr',
                'email' => 'petr@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Мария',
                'surname' => 'Сидорова',
                'patronymic' => 'Ивановна',
                'login' => 'maria',
                'email' => 'maria@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
} 