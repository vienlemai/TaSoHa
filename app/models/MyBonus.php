<?php

class MyBonus extends Eloquent {
    protected $table = 'bonus';
    public $fillable = array(
        'name',
        'description'
    );

    public static function validate($input) {
        $rules = array(
            'amount' => 'required|numeric',
        );
        $messages = array(
            'amount.required' => 'Phải nhập số tiền cho hoa hồng',
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

}
