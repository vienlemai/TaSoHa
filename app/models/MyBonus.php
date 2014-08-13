<?php

class MyBonus extends Eloquent {
    const HH_PHAT_TRIEN = 1;
    const HH_DONG_DOI = 2;
    const HH_TRUC_HE = 3;
    const HH_COI_NGUON = 4;
    const HH_LANH_DAO = 5;

    protected $table = 'bonus';
    public $fillable = array(
        'name',
        'description'
    );
    public static $DEVELOP_AMOUNT = array(
        Member::CAP_BAN_HANG => 12,
        Member::CAP_GIAM_SAT => 14,
        Member::CAP_CHUYEN_VIEN => 16,
    );
    public static $DONG_DOI_AMOUNT = array(
        Member::CAP_BAN_HANG => 10,
        Member::CAP_GIAM_SAT => 10,
        Member::CAP_CHUYEN_VIEN => 15,
    );
    public static $DIRECT_CONFIGS = array(
        Member::CAP_BAN_HANG => array(
            1 => 5,
            2 => 5,
            3 => 5,
        ),
        Member::CAP_GIAM_SAT => array(
            1 => 5,
            2 => 5,
            3 => 5,
        ),
        Member::CAP_CHUYEN_VIEN => array(
            1 => 5,
            2 => 5,
            3 => 5,
        ),
        Member::CAP_PHO_BAN => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
        ),
        Member::CAP_TRUONG_BAN => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 4,
        ),
        Member::CAP_PHO_GIAM_DOC => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 4,
            6 => 3,
        ),
        Member::CAP_GIAM_DOC => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 4,
            6 => 3,
            7 => 3,
        ),
        Member::CAP_TONG_GIAM_DOC => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 4,
            6 => 3,
            7 => 3,
            8 => 2,
        ),
        Member::CAP_PHO_CHU_TICH => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 4,
            6 => 3,
            7 => 3,
            8 => 2,
            9 => 1,
        ),
        Member::CAP_CHU_TICH => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 4,
            6 => 3,
            7 => 3,
            8 => 2,
            9 => 1,
        ),
        Member::CAP_CLB_ST => array(
            1 => 5,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 4,
            6 => 3,
            7 => 3,
            8 => 2,
            9 => 1,
        ),
    );
    public static $SOURCE_BONUS_CONFIGS = array(
        Member::CAP_GIAM_SAT => array(
            2 => 20
        ),
        Member::CAP_CHUYEN_VIEN => array(
            1 => 20,
        ),
        Member::CAP_PHO_BAN => array(
            1 => 20
        ),
        Member::CAP_TRUONG_BAN => array(
            1 => 20,
            2 => 10,
        ),
        Member::CAP_PHO_GIAM_DOC => array(
            1 => 20,
            2 => 10,
            3 => 10,
        ),
        Member::CAP_GIAM_DOC => array(
            1 => 20,
            2 => 10,
            3 => 10,
            4 => 10
        ),
        Member::CAP_TONG_GIAM_DOC => array(
            1 => 20,
            2 => 10,
            3 => 10,
            4 => 10
        ),
        Member::CAP_PHO_CHU_TICH => array(
            1 => 20,
            2 => 10,
            3 => 10,
            4 => 10
        ),
        Member::CAP_CHU_TICH => array(
            1 => 20,
            2 => 10,
            3 => 10,
            4 => 10
        ),
        Member::CAP_CLB_ST => array(
            1 => 20,
            2 => 10,
            3 => 10,
            4 => 10
        ),
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
            $amount = DB::table('member_bonus')
                ->where('member_id', $memberId)
                ->where('bonus_id', $k)
                ->first(array('auto_amount'));
            $bonusAmoun[$k]['amount'] = $amount->auto_amount;
        }
        return $bonusAmoun;
    }

    public static function calculate($member, $bonusType) {
        if ($bonusType == self::HH_PHAT_TRIEN) {
            
        }
    }

}
