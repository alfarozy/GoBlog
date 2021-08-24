<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =  \App\Models\User::create([
            'name'  => 'Alfarozy AN',
            'email' => 'mr.alfarozy.a.n@gmail.com',
            'password' => bcrypt("password'"),
            'bio'   => 'Saya seorng Web Developer. Semua project Open Source saya bagikan di Alfarozy.id'
        ]);
        $admin->assignRole('admin');
    }
}
