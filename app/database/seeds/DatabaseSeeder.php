<?php

class DatabaseSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();

        $this->call('AdminUserSeeder');
        $this->call('MemberSeeder');
        $this->call('BonusSeeder');
    }

}

class AdminUserSeeder extends Seeder {

    public function run() {
        DB::table('admins')->truncate();
        $admin = new AdminUser(
                array(
            'email' => 'admin@admin.com',
            'password' => ('123456'),
            'full_name' => 'Admin',
        ));
        $admin->save();
        $subAdmin = new AdminUser(array(
            'email' => 'subadmin@gmail.com',
            'password' => ('123456'),
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
            'full_name' => 'Nguyễn Văn A',
            'email' => 'nguyenvana@gmail.com',
            'username' => 'nguyenvana',
            'password' => ('123456'),
            'day_of_birth' => '',
            'sex' => false,
        ));
        $root->save();
        $node = new Member(array(
            'full_name' => 'Nguyễn Văn B',
            'email' => 'nguyenvanb@gmail.com',
            'username' => 'nguyenvanb',
            'password' => ('123456'),
            'day_of_birth' => '',
            'sex' => false,
            'is_left' => true,
            'is_right' => false,
        ));
        $node->save();
        $node->makeChildOf($root);
        $node = new Member(array(
            'full_name' => 'Nguyễn Văn C',
            'email' => 'nguyenvanc@gmail.com',
            'username' => 'nguyenvanc',
            'password' => ('123456'),
            'day_of_birth' => '',
            'sex' => false,
            'is_left' => false,
            'is_right' => true,
        ));
        $node->save();
        $node->makeChildOf($root);
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
