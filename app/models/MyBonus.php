<?php

class MyBonus extends Eloquent {
    const HH_THUONG_NHANH = 1;
    const HH_DONG_DOI = 2;
    const HH_TRUC_HE = 3;
    const HH_COI_NGUON = 4;
    const HH_LANH_DAO = 5;

    protected $table = 'bonus';
    public $fillable = array(
        'name',
        'description'
    );
    public static $THUONG_NHANH_AMOUNT = array(
        Member::CAP_BAN_HANG => 10,
        Member::CAP_GIAM_SAT => 12,
        Member::CAP_CHUYEN_VIEN => 25,
    );

    public static function validate($input) {
        $rules = array(
            'amount' => 'required|numeric',
        );
        $messages = array(
            'amount.required' => 'Phải nhập số điểm cho hoa hồng',
            'amount.numeric' => 'Số tiền phải là chữ số',
        );
        return Validator::make($input, $rules, $messages);
    }

    public static function getBonus($memberId) {
        $bonus = MyBonus::lists('name', 'id');
        $bonusAmoun = array();
        foreach ($bonus as $k => $v) {
            $bonusAmoun[$k]['name'] = $v;
            $bonusAmoun[$k]['amount'] = DB::table('member_bonus')->where('member_id', $memberId)->where('bonus_id', $k)->sum('amount');
        }
        return $bonusAmoun;
    }

    public static function calculate($member, $bonusType) {
        if ($bonusType == self::HH_THUONG_NHANH) {
            
        }
    }

}
