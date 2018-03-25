<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class)->create(
            ['name' => '和久井　太郎', 'email' => 'aa@bb.net']
        );
        factory(App\User::class, 9)->create();

        factory(App\Admin::class)->create(
            ['username' => 'taro', 'password' => bcrypt('jiro')]
        );
    }
}
