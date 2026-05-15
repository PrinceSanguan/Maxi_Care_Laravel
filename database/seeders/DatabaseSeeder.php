<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (config('demo.accounts', []) as $account) {
            User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'username'   => $account['username'],
                    'first_name' => $account['first_name'],
                    'last_name'  => $account['last_name'],
                    'userRole'   => $account['role'],
                    'password'   => bcrypt($account['password']),
                ]
            );
        }
    }
}
