<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::register('dennis@mfadmin.se', 'Dennis', 'Nygren', 'dennis');
        \App\Models\User::register('marion@mfadmin.se', 'Marion', 'Wandell', 'marion');
    }
}