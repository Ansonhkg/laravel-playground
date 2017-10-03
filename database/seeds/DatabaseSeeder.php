<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
        

        // Role Table
        DB::table('roles')->insert([
            
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrators have full access to everything.',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'User have normal access.',
            ],

        ]);

        // Role User Pivot Table
        factory(App\User::class, 10)->create()->each(function($user){
            // Create a profile upon register
            $user->Profile()->save(factory(App\Profile::class)->make());
            
            // Create random records on role_user pivot table
            $boolean = random_int(0, 3);

            if($boolean){
                $user->Roles()->attach(1);
                $user->Roles()->attach(2);
            }else{
                $user->Roles()->attach(2);
            }
            

        });

    }
}
