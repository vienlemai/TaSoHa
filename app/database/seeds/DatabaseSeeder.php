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
        $this->call('MemberSeeder');
        $this->call('BonusSeeder');
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
        $subAdmin = new Admin(array(
            'email' => 'subadmin@gmail.com',
            'password' => Hash::make('123456'),
            'full_name' => 'Sub Admin',
            'is_subadmin' => true
        ));
        $subAdmin->save();
    }

}

class MemberSeeder extends Seeder {

    public function run() {
        DB::table('members')->truncate();
        $root = new Member(array(
            'full_name' => '1',
            'email' => '1@gmail.com',
            'username' => 'member_1',
            'password' => Hash::make('123456'),
            'day_of_birth' => '',
            'sex' => false,
        ));
        $root->save();
        for ($i = 1; $i <= 2; $i++) {
            $node = new Member(array(
                'full_name' => $root->full_name . $i,
                'email' => 'test@gmail.com',
                'username' => 'member_' . $root->full_name . $i,
                'password' => Hash::make('123456'),
                'day_of_birth' => '',
                'sex' => false,
                'is_left' => ($i % 2) !== 0,
                'is_right' => ($i % 2) == 0,
            ));
            $node->save();
            $node->makeChildOf($root);
        }
    }

}

class BonusSeeder extends Seeder {

    public function run() {
        DB::table('bonus')->truncate();
        DB::table('bonus')->insert(array(
            'name' => 'Lợi nhuận bán lẻ hằng ngày',
            'description' => '',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));
        DB::table('bonus')->insert(array(
            'name' => 'Thưởng nhanh',
            'description' => '',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));
        DB::table('bonus')->insert(array(
            'name' => 'Hoa hồng đồng đội',
            'description' => '',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));
        DB::table('bonus')->insert(array(
            'name' => 'Hoa hồng trực hệ',
            'description' => '',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));
        DB::table('bonus')->insert(array(
            'name' => 'Hoa hồng cội nguồn',
            'description' => '',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));
        DB::table('bonus')->insert(array(
            'name' => 'Hoa hồng lãnh đạo',
            'description' => '',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));
    }

}
