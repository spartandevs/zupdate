<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		//$this->call('RoleTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$admin_role = DB::table('roles')
                          ->select('id')
                          ->where('name', 'admin')
                          ->first()
                          ->id;
                
        $employee_role = DB::table('roles')
                          ->select('id')
                          ->where('name', 'employee')
                          ->first()
                          ->id;
                        
        DB::table('users')->insert(
            array(
                array(
                	'name'	   => 'Charlie Macaraeg',
                	'email'	   => 'charlie@saservices.com.ph',
                    'username' => 'charlie',
                    'password' => Hash::make('123123'),
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                    'role_id'  => $employee_role
                ),
                array(
                    'name'	   => 'Michael Angelo Lacuata',
                	'email'	   => 'michael.angelo@saservices.com.ph',
                    'username' => 'angelo',
                    'password' => Hash::make('123123'),
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                    'role_id'  => $employee_role
                ),
                array(
                    'name'	   => 'Camille Ganaden',
                	'email'	   => 'camille.ganaden@saservices.com.ph',
                    'username' => 'camille',
                    'password' => Hash::make('123123'),
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                    'role_id'  => $employee_role
                ),
                array(
                    'name'	   => 'Joey Mallari',
                	'email'	   => 'joey.mallari@saservices.com.ph',
                    'username' => 'joey',
                    'password' => Hash::make('123123'),
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                    'role_id'  => $admin_role
                ),
            )
        );
	}

}
