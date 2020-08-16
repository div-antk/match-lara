<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'ジョブズ',
            'email' => 'user1@example.com',
            'gender' => '0',
            'self_introduction' => 'ジョブズです',
            'img_name' => 'sample001.jpg',
            'password' => Hash::make('password123'),
        ],
            ['name' => '上野',
            'email' => 'user2@example.com',
            'gender' => '1',
            'self_introduction' => 'よろしおす',
            'img_name' => 'sample002.jpg',
            'password' => Hash::make('password123'),
        ],
            ['name' => 'ソープ',
            'email' => 'user3@example.com',
            'gender' => '0',
            'self_introduction' => 'やるぜ',
            'img_name' => 'sample003.jpg',
            'password' => Hash::make('password123'),
        ],
            ['name' => 'ゆかた',
            'email' => 'user4@example.com',
            'gender' => '1',
            'self_introduction' => 'こんちわ',
            'img_name' => 'sample004.jpg',
            'password' => Hash::make('password123'),
        ],
            ['name' => 'もうだめぽ',
            'email' => 'user5@example.com',
            'gender' => '0',
            'self_introduction' => 'いつまでハンパやってんだ',
            'img_name' => 'sample005.jpg',
            'password' => Hash::make('password123'),
        ],
        ]);
    }
}
