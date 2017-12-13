<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = App\Admin::where(['email' => "admin@seloger.com",])->first();
		if(!$admin){
			App\Admin::create([ 'firstname' => 'App', 'lastname' => 'Admin', 'email' => "admin@fayat.com", 'password' => Hash::make('admin123'), ]);
		}
    }
}
