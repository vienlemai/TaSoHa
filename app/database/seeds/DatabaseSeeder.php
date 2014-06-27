<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('AdminUserSeeder');
    }

}

class AdminUserSeeder extends Seeder {

    public function run() {
        $admin = new Admin(
            array(
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'full_name' => 'Admin',
        ));
        $admin->save();
    }

}
