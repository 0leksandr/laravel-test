<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $admin = new User([
            'name'     => 'Chuck Norris',
            'email'    => 'test@test.com',
            'password' => Hash::make('test'),
            'role'     => 'manager',
        ]);
        $admin->save();
    }
}
