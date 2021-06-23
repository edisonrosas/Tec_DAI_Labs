<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class UserCollectionSeeder extends Seeder
{

    public function run()
    {
        User::factory(10)
            ->has(Post::factory()->count(3))
            ->create();
        User::factory(1)
            ->has(Post::factory()->count(3))
            ->state([
              "email"=>"correo@mail.com",])
            ->create();      
    }   
}
