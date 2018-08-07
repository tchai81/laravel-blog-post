<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([[
            'name' => 'owner',
            'description' => 'Administrator of the blog. Have the permission to post a blog post.',
            'created_at' => date("Y-m-d H:i:s"),
        ], [
            'name' => 'user',
            'description' => 'Normal user. Not able to post a blog post. Can leave a comment',
            'created_at' => date("Y-m-d H:i:s")],
        ]);

    }
}
