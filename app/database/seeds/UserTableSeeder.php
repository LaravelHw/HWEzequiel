<?php


class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'first_name' => 'Ana',
			'last_name'  => 'BC',
			'username'   => 'abc',
			'email'      => 'anbeltranc@gmail.com',
			'password'   => 'admin'
			//'password'   =>  Hash::make('admin')
			]);
		}

	}
