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
        'score' => 'required|numeric|integer',
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
        $member->score = $member->score + $this->score;
        $member->save();
        if ($bills->count() == 1) {
            $this->updateThuongNhanh($member, $this->score);
            $member->needUpdateTeamBonus();
        } else {
            
        }
    }

    public function updateThuongNhanh($member, $score) {
        $tyle = MyBonus::$THUONG_NHANH_AMOUNT[$member->regency];
        $amount = (int) $score * $tyle / 100;
        $memberBonus = DB::table('member_bonus')
            ->where('member_id', $member->introduced_by)
            ->where('bonus_id', MyBonus::HH_THUONG_NHANH)
            ->first(array('auto_amount'));
        DB::table('member_bonus')
            ->where('member_id', $member->introduced_by)
            ->where('bonus_id', MyBonus::HH_THUONG_NHANH)
            ->update(array(
                'auto_amount' => $memberBonus->auto_amount + $amount,
        ));
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
