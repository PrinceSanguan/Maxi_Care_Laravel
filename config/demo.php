<?php

/*
|--------------------------------------------------------------------------
| Demo accounts
|--------------------------------------------------------------------------
|
| The accounts listed here are seeded by DatabaseSeeder and displayed on
| the login page when DEMO_MODE=true. Passwords are stored in plaintext
| in this file because they are demo accounts whose credentials are
| intentionally shown to evaluators on the login page itself. The seeder
| always bcrypt()s them before insert, so the stored value is never
| plaintext. Set DEMO_MODE=false in .env to hide the login-page card.
|
*/

return [

    'enabled' => env('DEMO_MODE', true),

    'accounts' => [
        [
            'role'       => 'admin',
            'label'      => 'Administrator',
            'username'   => 'admin',
            'email'      => 'admin@gmail.com',
            'password'   => 'admin123',
            'first_name' => 'Demo',
            'last_name'  => 'Admin',
            'blurb'      => 'Full access — manage staff accounts and view sales reports.',
        ],
        [
            'role'       => 'staff',
            'label'      => 'Staff',
            'username'   => 'staff',
            'email'      => 'staff@gmail.com',
            'password'   => 'staff123',
            'first_name' => 'Demo',
            'last_name'  => 'Staff',
            'blurb'      => 'Daily ops — record sales, receive stock, manage products and suppliers.',
        ],
    ],

];
