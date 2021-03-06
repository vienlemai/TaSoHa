<?php

class Bill extends BaseModel {
    public $table = 'bills';
    public $fillable = array(
        'product_name',
        'price',
        'score',
        'member_id',
    );
    public static $rules = array(
        'product_name' => 'required',
        'price' => 'required',
        'score' => 'required|numeric|integer|min:1',
        'member_id' => 'required',
    );

    public function beforeCreate() {
        $this->created_by = Auth::admin()->get()->id;
    }

    public function afterCreate() {
        $bills = self::where('member_id', $this->member_id)
            ->get(array('id'));
        //update score for member
        $member = $this->buyer;
        Event::fire('member.update.score', array($member, $this->score));
        //Member::updateScore($member, $this->score);
        if ($bills->count() == 1) {
            $member->updateDevelopBonus($this->score);
            $member->needUpdateTeamBonus();
        } else {
            $member->updateSecondScore($this->score);
        }
    }

    public static function resetBill() {
        DB::table('statistics')
            ->truncate();
        DB::table('member_bonus')
            ->truncate();
        DB::table('team_bonus')
            ->update(array(
                'left_left' => 0,
                'right_left' => 0,
                'need_to_up' => false
        ));
        DB::table('team_bonus')->truncate();
        DB::table('members')
            ->update(array(
                'score' => 0,
                'children_score' => 0,
                'regency' => 0
        ));
        DB::table('members')->truncate();
        DB::table('binary_members')->truncate();
        DB::table('sun_members')->truncate();
        DB::table('second_scores')
            ->truncate();
        DB::table('bills')
            ->truncate();
//        $members = Member::orderBy('id', 'asc')->get();
//        foreach ($members as $member) {
//            $loops = (int) rand(1, 5);
//            for ($i = 0; $i < $loops; $i++) {
//                $random = rand(150, 15000);
//                $bill = new Bill(array(
//                    'product_name' => 'mua ' . str_random(10),
//                    'price' => $random * 20,
//                    'score' => $random,
//                    'member_id' => $member->id
//                ));
//                $bill->forceSave();
//            }
//        }
    }

    public function creator() {
        return $this->belongsTo('AdminUser', 'created_by');
    }

    public function buyer() {
        return $this->belongsTo('Member', 'member_id');
    }

    public function scopeCondition($query, $params) {
        if (isset($params['keyword'])) {
            $query->searchLike($params['keyword'], array('uid', 'full_name', 'identify_number'));
        }
        return $query;
    }

}
