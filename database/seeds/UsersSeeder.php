<?php
use Illuminate\Database\Seeder;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert(
            [
                [
                    "name" => "Bento",
                    "email" => "bento@keyboard.cat",
                    "city" => "Chapecó",
                    "uf" => "SC",
                    "profile" => 1,
                    "password" => "$2y$12$6n1jeQ7kRt8jrs2NChyrbeMxprxgdzLRm6bMK8aUGwO6p6fRYZarC", //123456
                    "remember_token" => "nGagRKH8vAp9GuhJhD1FClrTnFyMUMAkVdOiriMO9QLh4Wnjg2ah1eyPNXMt",
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                ]
            ]
        );
    }
}