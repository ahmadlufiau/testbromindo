<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder Untuk Role User
        $roleuser = new Role();
        $roleuser->name = 'user';
        $roleuser->description = 'Akun Level User';
        $roleuser->save();

        // Seeder untuk Role Admini
        $roleadmin = new Role();
        $roleadmin->name = 'admin';
        $roleadmin->description = 'Akun Level Admin';
        $roleadmin->save();

        // role untuk dipanggil di user
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        // Seeder untuk User dengan role user
        $user = new User();
        $user->name = 'User';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($role_user);

        // Seeder untuk User dengan role admin
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
