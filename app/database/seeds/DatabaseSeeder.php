<?php

class DatabaseSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();


//        $this->call('AdminUserSeeder');
//        $this->call('MemberSeeder');
        //$this->call('TeamBonusSeed');
//        $this->call('ArticleCategorySeeder');
        //$this->call('ConfigSeeder');
        $this->call('DirectConfigSeed');
    }

}

class AdminUserSeeder extends Seeder {

    public function run() {
        DB::table('admin_users')->truncate();
        DB::table('admin_groups')->truncate();
        DB::table('admin_user_groups')->truncate();
        $group = new AdminGroup(['name' => 'Administrator']);
        $group->description = '';
        $group->permissions = '';
        $group->save();
        $admin = new AdminUser(array(
            'email' => 'admin@admin.com',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'password' => '123456',
            'is_supper' => true,
        ));
        $admin->save();
        $admin->groups()->attach($group->id);
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

class TeamBonusSeed extends Seeder {

    public function run() {
        DB::table('team_bonus')->truncate();
        DB::table('member_bonus')->truncate();
        $members = Member::all();
        $bonus = MyBonus::get(array('id'));
        foreach ($members as $member) {
            DB::table('team_bonus')
                ->insert(array(
                    'member_id' => $member->id,
            ));
            foreach ($bonus as $b) {
                DB::table('member_bonus')
                    ->insert(array(
                        'member_id' => $member->id,
                        'bonus_id' => $b->id,
                        'created_at' => Carbon\Carbon::now(),
                        'updated_at' => Carbon\Carbon::now(),
                        'amount' => 0,
                        'auto_amount' => 0
                ));
            }
        }
    }

}

class BonusSeeder extends Seeder {

    public function run() {
        DB::table('bonus')->truncate();
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

class ArticleCategorySeeder extends Seeder {

    public function run() {
        DB::table('article_categories')->truncate();
        $cats = array(
            array(
                'name' => 'Thông tin sản phẩm mới',
                'description' => 'Giới thiệu các sản phẩm mới',
                'removalable' => false
            ),
            array(
                'name' => 'Công tác tập huấn',
                'description' => 'Mô tả danh mục công tác tập huấn',
                'removalable' => false
            ),
            array(
                'name' => 'Sự kiện',
                'description' => 'Mô tả danh mục sự kiện',
                'removalable' => false
            )
        );
        foreach ($cats as $catAttrs) {
            $cat = new ArticleCategory($catAttrs);
            $cat->save();
        }
    }

}

class ConfigSeeder extends Seeder {

    public function run() {
        DB::table('configs')
            ->insert(array(
                'key' => 'need_to_update_bonus',
                'value' => json_encode([]),
        ));
    }

}

class DirectConfigSeed extends Seeder {

    public function run() {
        $regencies = array(
            'ban_hang',
            'giam_sat',
            'chuyen_vien',
            'pho_ban',
            'truong_ban',
            'pho_giam_doc',
            'giam_doc',
            'tong_giam_doc',
            'pho_co_tuc',
            'co_tuc',
        );
        foreach ($regencies as $value) {
            for ($i = 1; $i <= 9; $i++) {
                DB::table('direct_configs')
                    ->insert(array(
                        'regency' => $value,
                        'depth' => $i,
                        'value' => 0,
                ));
            }
        }
    }

}
