<?php

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
        // $this->call(UserSeeder::class);
        $this->call(userSeeder::class);
    }
}

class userSeeder extends Seeder{
    public function run(){
        DB::table('users')->insert([
            ['name' => 'Dang','email' => Str::random(4).'to@gmail.com','password' => bcrypt('matkhau')]
            //['name' => 'Tien','email' => 'tien@gmail.com','password' => bcrypt('matkhau')],
            //['name' => 'Tung','email' => 'tung@gmail.com','password' => bcrypt('matkhau')]
        ]);
    }
}
?>