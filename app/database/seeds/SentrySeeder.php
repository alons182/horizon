<?php
 
use App\Models\User;
 
class SentrySeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();
 
        Sentry::getUserProvider()->create(array(
            'email'       => 'admin@admin.com',
            'password'    => "123",
            'first_name'  => 'Administrador',
            'last_name'   => 'Admin',
            'activated'   => 1,
        ));

        Sentry::getUserProvider()->create(array(
            'email'       => 'user@user.com',
            'password'    => "123",
            'first_name'  => 'User register',
            'last_name'   => 'Register',
            'activated'   => 1,
        ));
 
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array('admin' => 1),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Basic',
            'permissions' => array('basic' => 1),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('admin@admin.com');
        $basicUser  = Sentry::getUserProvider()->findByLogin('user@user.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $basicGroup = Sentry::getGroupProvider()->findByName('Basic');
        $adminUser->addGroup($adminGroup);
        $basicUser->addGroup($basicGroup);
    }
 
}
