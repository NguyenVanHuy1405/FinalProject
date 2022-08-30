<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);
        Role::firstOrCreate(['name' => Role::ROLE_STAFF]);

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => 123456789,
            'role_id' => Role::where('name',Role::ROLE_ADMIN)->first()->id
        ]);
        Admin::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => 123456789,
            'role_id' => Role::where('name',Role::ROLE_STAFF)->first()->id,
        ]);
    }
}
