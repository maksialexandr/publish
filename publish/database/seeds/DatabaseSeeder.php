<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $this->call('UsersSeeder');
    }
}

class UsersSeeder extends Seeder{
    public function run()
    {
        User::create(array(
            'name' => 'User1 User1',
            'email' =>  'user1@mail.ru',
            'password' => Hash::make('asdasdasd'),
            'gender' => '1',
            'phone' => '',
            'position' => 'DEVELOPER',
            'preview' => '',
            'birthday' => '1994-01-01 00:00:00',
            'status' => '',
            'remember_token' => '7WCBHhvgv1CIArd1G29exC31mgktDzhN48Vwd88SggzjCT7me0RjBDr9ImSa',
            'created_at' => '2018-02-15 12:17:35',
            'updated_at' => '0000-00-00 00:00:00'
        ));
        User::create(array(
            'name' => 'User2 User2',
            'email' =>  'user2@mail.ru',
            'password' => Hash::make('asdasdasd'),
            'gender' => '1',
            'phone' => '',
            'position' => 'DEVELOPER',
            'preview' => '',
            'birthday' => '1994-01-01 00:00:00',
            'status' => '',
            'remember_token' => 'd3LLTpg1FJDypcC7j84oH2ftiMSDD59PcG2puM6oq0jKYvYFZKZxOwjgKMzV',
            'created_at' => '2018-02-15 12:18:55',
            'updated_at' => '0000-00-00 00:00:00'
        ));
        User::create(array(
            'name' => 'User3 User3',
            'email' =>  'user3@mail.ru',
            'password' => Hash::make('asdasdasd'),
            'gender' => '1',
            'phone' => '',
            'position' => 'DEVELOPER',
            'preview' => '',
            'birthday' => '1994-01-01 00:00:00',
            'status' => '',
            'remember_token' => 'BaOAnLOSDPtcFGaUCYNNupLBGMdqzpFTO4V3a3aqgGIzhPGCciO49Tywg7sj',
            'created_at' => '2018-02-15 10:46:20',
            'updated_at' => '0000-00-00 00:00:00'
        ));

    }
}