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
        //$this->call(loaispSeeder::class);
    }
}

class userSeeder extends Seeder{
    public function run(){
        DB::table('users')->insert([
            ['name' => 'totoan','email' => Str::random(4).'to@gmail.com','password' => bcrypt('totoan')],
            ['name' => 'tientoan','email' => Str::random(4).'to@gmail.com','password' => bcrypt('tientoan')],
            //['name' => 'toan','email' => Str::random(4).'to@gmail.com','password' => bcrypt('matkhau')],
            //['name' => 'Tien','email' => 'tien@gmail.com','password' => bcrypt('matkhau')],
            //['name' => 'Tung','email' => 'tung@gmail.com','password' => bcrypt('matkhau')]
        ]);
    }
}

class loaispSeeder extends Seeder{
    public function run(){
        DB::table('loaisanpham')->insert([
            ['ten' => 'laptop'],
            ['ten' => 'dien thoai']
        ]);
    }
}
?>