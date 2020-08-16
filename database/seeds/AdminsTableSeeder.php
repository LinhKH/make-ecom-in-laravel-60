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
        DB::table('admins')->delete();
        $adminRecords = [
            ['id' => 1, 'name'=>'admin','type'=>'admin','mobile'=>'0968146460','email'=>'admin@admin.com','password'=>'$2y$10$ydXTQ2l86ZHZkAs.zKh0AOpJwFczo4PAaj/bM/2laVQYIlh7XwNiS','image'=>'','status'=>1],
            ['id' => 2, 'name'=>'user_1','type'=>'subadmin','mobile'=>'0968146460','email'=>'user_1@user_1.com','password'=>'$2y$10$ydXTQ2l86ZHZkAs.zKh0AOpJwFczo4PAaj/bM/2laVQYIlh7XwNiS','image'=>'','status'=>1],
            ['id' => 3, 'name'=>'user_2','type'=>'subadmin','mobile'=>'0968146460','email'=>'user_2@user_2.com','password'=>'$2y$10$ydXTQ2l86ZHZkAs.zKh0AOpJwFczo4PAaj/bM/2laVQYIlh7XwNiS','image'=>'','status'=>1],
        ];

        DB::table('admins')->insert($adminRecords);

    }
}
