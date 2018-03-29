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
        // Dummy test user account
        factory(App\User::class)->create(
            ['name' => '和久井　太郎', 'email' => 'aa@bb.net']
        );
        factory(App\User::class, 9)->create();

        // Dummy test admin account
        factory(App\Admin::class)->create(
            ['username' => 'taro', 'password' => bcrypt('jiro')]
        );

        // Dummy messages
        factory(App\Message::class, 20)->create();
    }
}
