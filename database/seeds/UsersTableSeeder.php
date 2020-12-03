<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'              => '1',
                'name'            => 'superadmin',
                'username'        => 'superadmin',
                'email'           => 'superadmin@email.com',
                'password'        => bcrypt('SinerGi2017'),
                'phone'           => '0987654321',
                'role_id'         => '1',
                'owner_id'        => '1',
                'notification_id' => '1',
                'region_oid'      => 'admin',
            ],
            [
                'id'              => '2',
                'name'            => 'admin',
                'username'        => 'admin',
                'email'           => 'admin@email.com',
                'password'        => bcrypt('admin123'),
                'phone'           => '0987654321',
                'role_id'         => '2',
                'owner_id'        => '1',
                'notification_id' => '1',
                'region_oid'      => 'admin',


            ],
            [
                'id'              => '3',
                'name'            => 'user',
                'username'        => 'user',
                'email'           => 'user@email.com',
                'password'        => bcrypt('user123'),
                'phone'           => '0987654321',
                'role_id'         => '3',
                'owner_id'        => '1',
                'notification_id' => '1',
                'region_oid'      => 'user',


            ],

        ];

        DB::table('users')->insert($data);
    }
}
