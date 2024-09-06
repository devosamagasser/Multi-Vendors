<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name'=> "Osama Gasser",
           'email'=> "devosamagasser@gmail.com",
           'phone'=> "01099634597",
           'password'=> Hash::make('password'),
        ]);

    }
}
