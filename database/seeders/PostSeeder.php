<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'name' => Str::random(10),
            'description' => Str::random(100),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

// carbon class => useful in management about datetime in laravel
