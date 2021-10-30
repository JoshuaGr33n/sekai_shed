// app/database/seeds/UserTableSeeder.php

<?php
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    
public function run()
{
     DB::table('admin')->delete();
     User::create(array(
        'name'   => 'Christian',
       
        'email'    => 'chris@school.com',
        'password' => Hash::make('awesome'),
       
    ));
}

}
?>