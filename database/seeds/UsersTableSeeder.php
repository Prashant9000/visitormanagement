<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array =array(
            array(
                'name'=>'super admin',
                'email'=>'superadmin@visitor.com',
                'password'=> Hash::make('superadmin123'),
                'role'=>'superAdmin',
                'status'=>'active'
            ),
            array(
                'name'=>'super admin1',
                'email'=>'superadmin1@visitor.com',
                'password'=> Hash::make('superadmin1123'),
                'role'=>'superAdmin',
                'status'=>'inactive'
            ),
            array(
                'name'=>'admin',
                'email'=>'admin@visitor.com',
                'password'=> Hash::make('admin123'),
                'role'=>'admin',
                'status'=>'active'
            ),
            array(
                'name'=>'admin1',
                'email'=>'admin1@visitor.com',
                'password'=> Hash::make('admin1123'),
                'role'=>'admin',
                'status'=>'inactive'
            ),
            array(
                'name'=>'student',
                'email'=>'student@visitor.com',
                'password'=> Hash::make('student123'),
                'role'=>'student',
                'status'=>'active'
            ),
            array(
                'name'=>'student1',
                'email'=>'student1@visitor.com',
                'password'=> Hash::make('student1123'),
                'role'=>'student',
                'status'=>'inactive'
            ),
            array(
                'name'=>'visitor',
                'email'=>'visitor@visitor.com',
                'password'=> Hash::make('visitor123'),
                'role'=>'visitor',
                'status'=>'active'
            ),
            array(
                'name'=>'visitor1',
                'email'=>'visitor1@visitor.com',
                'password'=> Hash::make('visitor1123'),
                'role'=>'visitor',
                'status'=>'inactive'
            ),

        );
        DB::table('users')->insert($array);
    }
}
