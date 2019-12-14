<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $admin = new User([
            'name'     => 'Chuck Norris',
            'email'    => 'test@test.com',
            'password' => 'test',
            'role'     => 'manager',
        ]);
        $admin->save();
    }
}
