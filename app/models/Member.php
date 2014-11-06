<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Member
 */
class Member extends Illuminate\Database\Eloquent\Model implements UserInterface, RemindableInterface {
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'members';

    const CAP_BAN_HANG = 1;
    const CAP_GIAM_SAT = 2;
    const CAP_CHUYEN_VIEN = 3;
    const CAP_PHO_BAN = 4;
    const CAP_TRUONG_BAN = 5;
    const CAP_PHO_GIAM_DOC = 6;
    const CAP_GIAM_DOC = 7;
    const CAP_TONG_GIAM_DOC = 8;
    const CAP_PHO_CHU_TICH = 9;
    const CAP_CHU_TICH = 10;
    const CAP_CLB_ST = 11;

    public static $scoreForPromotion = array(
        self::CAP_BAN_HANG => 140,
        self::CAP_GIAM_SAT => 490,
        self::CAP_CHUYEN_VIEN => 1750,
        self::CAP_PHO_BAN => 19600,
        self::CAP_TRUONG_BAN => 56000,
        self::CAP_PHO_GIAM_DOC => 112000,
        self::CAP_GIAM_DOC => 280000,
        self::CAP_TONG_GIAM_DOC => 700000,
        self::CAP_PHO_CHU_TICH => 1400000,
        self::CAP_CHU_TICH => 2800000,
        self::CAP_CLB_ST => 7000000,
    );
    public static $regencyLabel = array(
        0 => '',
        self::CAP_BAN_HANG => 'Bán hàng',
        self::CAP_GIAM_SAT => 'Giám sát',
        self::CAP_CHUYEN_VIEN => 'Chuyên viên',
        self::CAP_PHO_BAN => 'Phó ban',
        self::CAP_TRUONG_BAN => 'Trưởng ban',
        self::CAP_PHO_GIAM_DOC => 'Phó giám đốc',
        self::CAP_GIAM_DOC => 'Giám đốc',
        self::CAP_TONG_GIAM_DOC => 'Tổng giám đốc',
        self::CAP_PHO_CHU_TICH => 'Phó chủ tịch',
        self::CAP_CHU_TICH => 'Chủ tịch',
        self::CAP_CLB_ST => 'Câu lạc bộ sáng lập',
    );
    public $fillable = array(
        'username',
        'password',
        'email',
        'full_name',
        'sex',
        'day_of_birth',
        'parent_id',
        'identify_number',
        'introduced_by',
        'identify_location',
        'identify_date',
        'location',
        'phone',
        'regency',
        'sun_depth',
    );

    public function sunMember() {
        return $this->hasOne('SunMember');
    }

    public function binaryMember() {
        return $this->hasOne('BinaryMember');
    }

    public static function boot() {
        parent::boot();
        static::creating(function($member) {
            $member->regency = '';
            $member->uid = time();
            $member->created_by = Auth::admin()->get()->id;
        });
        static::created(function($member) {
            DB::table('team_bonus')
                ->insert(array('member_id' => $member->id));
        });
        static::saving(function($member) {
            if (Hash::needsRehash($member->password)) {
                $member->password = Hash::make($member->password);
            }
        });
    }

    public static function validate($input, $id = null) {
        $rules = array(
            'email' => 'required|email|unique:members,email,' . $id,
            'full_name' => 'required',
            //'username' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            //'day_of_birth' => 'required',
            //'identify_number' => 'required|numeric',
            //'identify_location' => 'required|required',
            //'identify_date' => 'required',
            //'location' => 'required',
            //'phone' => 'required|numeric'
        );

        return Validator::make($input, $rules);
    }

    public static function validateEdit($input, $id) {
        $rules = array(
            'email' => 'required|email|unique:members,email,' . $id,
            'full_name' => 'required',
//            'day_of_birth' => 'required',
//            'identify_number' => 'required|numeric',
//            'identify_location' => 'renquired|required',
//            'identify_date' => 'required',
//            'location' => 'required',
//            'phone' => 'required|numeric'
        );

        return Validator::make($input, $rules);
    }

    public static function validateUpdateSelfProfile($input, $id = null) {
        $rules = array(
            'email' => 'required|email|unique:members,email,' . $id,
            'full_name' => 'required',
            'day_of_birth' => 'required',
            'identify_number' => 'required|numeric',
            'identify_location' => 'required|required',
            'identify_date' => 'required',
            'location' => 'required',
            'phone' => 'required|numeric'
        );
        return Validator::make($input, $rules);
    }

    public static function validateShare($input) {
        $rules = array(
            'shares' => 'required|numeric|integer|min:1',
        );
        return Validator::make($input, $rules);
    }

    public static function getRegencyByScore($scoreToCheck) {
        $regency = '';
        if ($scoreToCheck < self::$scoreForPromotion[self::CAP_BAN_HANG]) {
            $regency = '';
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_BAN_HANG] && $scoreToCheck < self::$scoreForPromotion[self::CAP_GIAM_SAT]) {
            $regency = self::CAP_BAN_HANG;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_GIAM_SAT] && $scoreToCheck < self::$scoreForPromotion[self::CAP_CHUYEN_VIEN]) {
            $regency = self::CAP_GIAM_SAT;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_CHUYEN_VIEN] && $scoreToCheck < self::$scoreForPromotion[self::CAP_PHO_BAN]) {
            $regency = self::CAP_CHUYEN_VIEN;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_PHO_BAN] && $scoreToCheck < self::$scoreForPromotion[self::CAP_TRUONG_BAN]) {
            $regency = self::CAP_PHO_BAN;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_TRUONG_BAN] && $scoreToCheck < self::$scoreForPromotion[self::CAP_PHO_GIAM_DOC]) {
            $regency = self::CAP_TRUONG_BAN;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_PHO_GIAM_DOC] && $scoreToCheck < self::$scoreForPromotion[self::CAP_GIAM_DOC]) {
            $regency = self::CAP_PHO_GIAM_DOC;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_GIAM_DOC] && $scoreToCheck < self::$scoreForPromotion[self::CAP_TONG_GIAM_DOC]) {
            $regency = self::CAP_GIAM_DOC;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_TONG_GIAM_DOC] && $scoreToCheck < self::$scoreForPromotion[self::CAP_PHO_CHU_TICH]) {
            $regency = self::CAP_TONG_GIAM_DOC;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_PHO_CHU_TICH] && $scoreToCheck < self::$scoreForPromotion[self::CAP_CHU_TICH]) {
            $regency = self::CAP_PHO_CHU_TICH;
        } elseif ($scoreToCheck >= self::$scoreForPromotion[self::CAP_CHU_TICH] && $scoreToCheck < self::$scoreForPromotion[self::CAP_CLB_ST]) {
            $regency = self::CAP_CHU_TICH;
        }
        return $regency;
    }

    public function updateDevelopBonus($score) {
        //kiem tra xem thanh vien co phai la root theo cay mat troi hay ko
        $sunMember = SunMember::with(array('parent', 'parent.member'))
            ->where('member_id', $this->id)
            ->remember(60)
            ->first();
        if ($sunMember->parent != null) {
            //Kiem tra cap bac cua cha
            if (!empty($sunMember->parent->member->regency)) {
                $tyle = MyBonus::$DEVELOP_AMOUNT[$sunMember->parent->member->regency];
                $amount = (int) $score * $tyle / 100;
                Event::fire('member.update.bonus', array($sunMember->parent->id, MyBonus::HH_PHAT_TRIEN, $amount));
//                DB::table('member_bonus')
//                    ->where('member_id', $sunMember->parent->id)
//                    ->where('bonus_id', MyBonus::HH_PHAT_TRIEN)
//                    ->increment('auto_amount', $amount);
            }
        }
    }

    public static function updateScore($member, $score) {
        //Log::info('Fire event update member score: ' . $score);
        //update score for member
        $member->score = $member->score + $score;
        //check score for promotion
        $sunMember = SunMember::with('children')->where('member_id', $member->id)
            ->remember(60)
            ->first();
        if ($sunMember->children->count() >= 4 && $member->score >= Member::$scoreForPromotion[Member::CAP_CHUYEN_VIEN]) {
            $scoreToCheckMember = $member->score + ($member->children_score * 40 / 100);
            $memberRegency = Member::getRegencyByScore($scoreToCheckMember);
        } else {
            $scoreToCheckMember = $member->score;
            $memberRegency = Member::getRegencyByScore($scoreToCheckMember);
            if ($scoreToCheckMember >= Member::$scoreForPromotion[Member::CAP_CHUYEN_VIEN]) {
                $memberRegency = Member::CAP_CHUYEN_VIEN;
            }
        }
        $member->regency = $memberRegency;
        //Log::info('Update for member: ' . $member->full_name . ' children: ' . $sunMember->children->count() . 'score to check ' . $scoreToCheckMember . ' new regency : ' . $memberRegency);
        $member->save();
        if (!empty($sunMember->parent_id)) {
            $siblings = SunMember::where('parent_id', $member->parent_id)
                ->get();
            $sunParent = SunMember::where('id', $sunMember->parent_id)
                ->remember(60)
                ->first();
            $parentMember = Member::where('id', $sunParent->member_id)
                ->remember(60)
                ->first();
            $parentMember->children_score = $parentMember->children_score + $score;
            if ($siblings->count() >= 4 && $parentMember->score >= Member::$scoreForPromotion[Member::CAP_CHUYEN_VIEN]) {
                $scoreToCheckParent = $parentMember->score + $parentMember->children_score;
                $parentRegency = Member::getRegencyByScore($scoreToCheckParent);
                $parentMember->regency = $parentRegency;
                //Log::info('Update for parent member: ' . $parentMember->full_name . $score . 'new regency : ' . $parentRegency);
            }
            $parentMember->save();
        }
    }

    public function needUpdateTeamBonus() {
        $binaryMember = BinaryMember::where('member_id', $this->id)
            ->remember(60)
            ->first();
        $ancestors = BinaryMember::with(array('member', 'children'))->where('lft', '<=', $binaryMember->lft)
            ->where('rgt', '>=', $binaryMember->rgt)
            ->where('id', '!=', $binaryMember->id)
            ->get();
        foreach ($ancestors as $ancestor) {
            if ($ancestor->children->count() == 2 && !empty($ancestor->member->regency)) {
                DB::table('team_bonus')
                    ->where('member_id', $ancestor->member_id)
                    ->update(array('need_to_up' => true));
            }
        }
    }

    public function updateSecondScore($score) {
        $month = Carbon\Carbon::now()->format('m/Y');
        $secondScore = DB::table('second_scores')
            ->where('member_id', $this->id)
            ->where('month', $month)
            ->first();
        if (empty($secondScore)) {
            DB::table('second_scores')
                ->insert(array(
                    'member_id' => $this->id,
                    'month' => $month,
                    'score' => $score
            ));
        } else {
            DB::table('second_scores')
                ->where('member_id', $this->id)
                ->where('month', $month)
                ->update(array(
                    'score' => $secondScore->score + $score,
            ));
        }
    }

    public function updateTeamBonus() {
        $teamBonus = DB::table('team_bonus')
            ->where('member_id', $this->id)
            ->where('need_to_up', true)
            ->first();
        if ($teamBonus !== null) {
            //can cap nhat hoa hong dong doi
            $binaryMember = BinaryMember::with('children')
                ->where('member_id', $this->id)
                ->first();
            //tim con trai va con phai
            $left = $binaryMember->children->first();
            $right = $binaryMember->children->last();
            //tinh tong diem cua con trai
            $leftChildren = BinaryMember::where('lft', '>=', $left->lft)
                ->where('lft', '<', $left->rgt)
                ->lists('member_id');
            $rightChildren = BinaryMember::where('lft', '>=', $right->lft)
                ->where('lft', '<', $right->rgt)
                ->lists('member_id');
            //tong diem con trai
            $leftScore = 0;
            if (!empty($leftChildren)) {
                $leftScore = Member::whereIn('id', $leftChildren)
                    ->sum('score');
            }
            //tong diem cua coon phai
            $rightScore = 0;
            if (!empty($rightChildren)) {
                $rightScore = Member::whereIn('id', $rightChildren)
                    ->sum('score');
            }
            //cong voi diem du cua lan truoc
            $leftTotal = $leftScore + $teamBonus->left_left;
            $rightTotal = $rightScore + $teamBonus->right_left;
            $valueLeft = abs($leftTotal - $rightTotal);
            //cap nhat lai bang team_bonus
            if ($leftTotal < $rightTotal) {
                $total = $leftTotal;
                DB::table('team_bonus')
                    ->where('member_id', $this->id)
                    ->where('need_to_up', true)
                    ->update(array(
                        'need_to_up' => false,
                        'right_left' => $valueLeft,
                        'left_left' => 0,
                ));
            } else {
                $total = $rightTotal;
                DB::table('team_bonus')
                    ->where('member_id', $this->id)
                    ->where('need_to_up', true)
                    ->update(array(
                        'need_to_up' => false,
                        'left_left' => $valueLeft,
                        'right_left' => 0,
                ));
            }
            //tinh hoa hong dong doi
            $tyle = MyBonus::$DONG_DOI_AMOUNT[$this->regency];
            $amount = (int) ($total * $tyle) / 100;
            //cap nhat hoa hong dong doi
            Event::fire('member.update.bonus', array($this->id, MyBonus::HH_DONG_DOI, $amount));
//            DB::table('member_bonus')
//                ->where('member_id', $this->id)
//                ->where('bonus_id', MyBonus::HH_DONG_DOI)
//                ->increment('auto_amount', $amount);
        }
    }

    public static function updateDirectBonus($month) {
        //tim nhung thanh vien co mua hang lan 2 tro di trong thang
        $secondScores = DB::table('second_scores')
            ->where('month', $month)
            ->get();
        //lay danh sach so diem trong thang cua moi thanh vien
        $listSecondScores = DB::table('second_scores')
            ->where('month', $month)
            ->lists('score', 'member_id');
        $directConfigs = MyBonus::$DIRECT_CONFIGS;
        $directBonus = array();
        foreach ($secondScores as $item) {
            $sunMember = SunMember::where('member_id', $item->member_id)
                ->remember(60)
                ->first();
            if (!empty($sunMember->parent_id)) {
                $ancestors = SunMember::with(array(
                        'member' => function($query) {
                        $query->select(array(
                            'id',
                            'full_name',
                            'regency'
                        ));
                    }))->where('lft', '<=', $sunMember->lft)
                    ->where('rgt', '>=', $sunMember->rgt)
                    ->where('id', '!=', $sunMember->id)
                    ->orderBy('depth', 'DESC')
                    ->remember(10)
                    ->get();
                foreach ($ancestors as $node) {
                    $ignoreCount = 0;
                    $depth = abs($node->depth - $sunMember->depth) - $ignoreCount;
                    //Log::info('Member: ' . $node->member_id . 'depth: ' . $depth . ' isset regency : ' . isset($directConfigs[$node->member->regency][$depth]));
                    if (!isset($directConfigs[$node->member->regency][$depth])) {
                        break;
                    }
                    if (!empty($node->member->regency) && isset($listSecondScores[$node->member_id]) && $listSecondScores[$node->member_id] >= 50) {
                        $tyle = $directConfigs[$node->member->regency][$depth];
                        $amount = $item->score * $tyle / 100;
                        Event::fire('member.update.bonus', array($node->member_id, MyBonus::HH_TRUC_HE, $amount, $month));
                        $directBonus[$node->member_id] = $amount;
                    } else {
                        $ignoreCount++;
                    }
                }
            }
        }
        //Log::info('direct bonus calculated: ' . json_encode($directBonus));
        self::updateSourceBonus($directBonus, $month);
    }

    public static function updateSourceBonus($directBonus, $month) {
        $sourceBonusConfigs = MyBonus::$SOURCE_BONUS_CONFIGS;
        foreach ($directBonus as $k => $v) {
            $sunMember = SunMember::where('member_id', $k)
                ->remember(10)
                ->first();
            $ancestors = SunMember::with(array(
                    'member' => function($query) {
                    $query->select(array(
                        'id',
                        'full_name',
                        'regency'
                    ));
                }))->where('lft', '<=', $sunMember->lft)
                ->where('rgt', '>=', $sunMember->rgt)
                ->where('id', '!=', $sunMember->id)
                ->orderBy('depth', 'DESC')
                ->remember(10)
                ->get();
            foreach ($ancestors as $node) {
                $depth = abs($node->depth - $sunMember->depth);
                if (!isset($sourceBonusConfigs[$node->member->regency][$depth])) {
                    break;
                }
                if (!empty($node->member->regency) && isset($directBonus[$node->member_id])) {
                    $tyle = $sourceBonusConfigs[$node->member->regency][$depth];
                    $amount = $v * $tyle / 100;
                    Event::fire('member.update.bonus', array($node->member_id, MyBonus::HH_COI_NGUON, $amount, $month));
//                    DB::table('member_bonus')
//                        ->where('member_id', $node->member_id)
//                        ->where('bonus_id', MyBonus::HH_COI_NGUON)
//                        ->increment('auto_amount', $amount);
                    //Log::info('Tính hoa hồng trực hệ cho ' . $node->member_id . ' điểm: ' . $amount);
                }
            }
        }
    }

    public static function updateManagerBonus($month) {
        $sunMembers = SunMember::with(array(
                'member' => function($query) {
                $query->select(array('id', 'full_name', 'regency'));
            }
            ))->whereHas('member', function($query) {
                $query->where('regency', '>=', self::CAP_PHO_BAN);
            })
            ->get();
        foreach ($sunMembers as $sunMember) {
            $descendants = DB::table('sun_members')
                ->where('lft', '>=', $sunMember->lft)
                ->where('lft', '<', $sunMember->rgt)
                ->lists('member_id');
            $childrenScore = DB::table('bills')
                ->whereBetween('created_at', array(
                    Carbon\Carbon::createFromFormat('m/Y', $month)->startOfMonth(),
                    Carbon\Carbon::createFromFormat('m/Y', $month)->endOfMonth(),
                ))->whereIn('member_id', $descendants)
                ->sum('score');
            $scoreToCal = $childrenScore * 5 / 100;
            $ancestors = SunMember::with(array(
                    'member' => function($query) {
                    $query->select(array(
                        'id',
                        'full_name',
                        'regency'
                    ));
                }))->whereHas('member', function($query) use($sunMember) {
                    $query->where('regency', '<=', $sunMember->member->regency)
                    ->where('regency', '>=', Member::CAP_PHO_BAN);
                })->where('lft', '<=', $sunMember->lft)
                ->where('rgt', '>=', $sunMember->rgt)
                ->where('id', '!=', $sunMember->id)
                ->orderBy('depth', 'DESC')
                ->get();
            $i = 1;
            foreach ($ancestors as $node) {
                if (isset(MyBonus::$MANAGER_BONUS_CONFIGS[$node->member->regency][$i])) {
                    $tyle = MyBonus::$MANAGER_BONUS_CONFIGS[$node->member->regency][$i];
                    $amount = $scoreToCal * $tyle / 100;
                    Event::fire('member.update.bonus', array($node->member_id, MyBonus::HH_LANH_DAO, $amount, $month));
                    $i++;
                } else {
                    break;
                }
            }
        }
    }

    public static function updateShareBonus($month) {
        $sharesTotal = self::sum('shares');
        $listsShares = self::where('shares', '>', 0)
            ->lists('shares', 'id');
        $scoreTotal = DB::table('bills')
                ->whereBetween('created_at', array(
                    Carbon\Carbon::createFromFormat('m/Y', $month)->startOfMonth(),
                    Carbon\Carbon::createFromFormat('m/Y', $month)->endOfMonth(),
                ))->sum('score');
        if ($sharesTotal != 0) {
            $scoreToCal = ($scoreTotal * 5 / 100) / $sharesTotal;
            $dataToSave = array();
            foreach ($listsShares as $memberId => $share) {
                $dataToSave[] = array(
                    'member_id' => $memberId,
                    'bonus_id' => MyBonus::HH_CO_TUC,
                    'amount' => round(($scoreToCal * $share), 1),
                    'month' => $month,
                );
            }
            DB::table('member_bonus')
                ->insert($dataToSave);
        }
    }

    public static function getMonthlyBonus($month) {
        $monthlyLog = DB::table('statistics')
            ->where('month', $month)
            ->first();
        if ($monthlyLog == null) {
            Member::updateDirectBonus($month);
            Member::updateShareBonus($month);
            Member::updateManagerBonus($month);
            $bonusSum = DB::table('member_bonus')
                ->where('month', $month)
                ->sum('amount');
            $scoreSum = DB::table('bills')
                    ->whereBetween('created_at', array(
                        Carbon\Carbon::createFromFormat('m/Y', $month)->startOfMonth(),
                        Carbon\Carbon::createFromFormat('m/Y', $month)->endOfMonth(),
                    ))->sum('score');
            DB::table('statistics')
                ->insert(array(
                    'month' => $month,
                    'score' => $scoreSum,
                    'bonus' => round($bonusSum, 1),
            ));
            return true;
        } else {
            return false;
        }
    }

    public static function getMonthsLog() {
        $month = Carbon\Carbon::now()->format('m/Y');
        $months = DB::table('statistics')
            ->orderBy('id', 'DESC')
            ->lists('month');
        if (!in_array($month, $months)) {
            array_push($months, $month);
        }
        return $months;
    }

    public static function getMonthLogByMember($memberId) {
        $member = self::find($memberId, array('created_at'));
        $now = Carbon\Carbon::now();
        $diffMonths = $now->diffInMonths($member->created_at);
        $months = array();
        for ($i = 0; $i <= $diffMonths; $i++) {
            $months[] = $member->created_at->format('m/Y');
            $member->created_at = $member->created_at->addMonth();
        }
        if (!in_array($now->format('m/Y'), $months)) {
            array_push($months, $now->format('m/Y'));
        }
        return $months;
    }

    public static function validateChangePassword($input, $id = null) {
        $rules = array(
            'old_password' => 'required|passmembercheck:' . $id,
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        );
        $messages = array(
            'required' => 'Không được để trống',
            'passmembercheck' => 'Mật khẩu không đúng',
            'same' => 'Mật khẩu phải giống nhau',
        );
        return Validator::make($input, $rules, $messages);
    }

    public static function validateAdminChangePassword($input) {
        $rules = array(
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        );
        $messages = array(
            'required' => 'Không được để trống',
            'same' => 'Mật khẩu phải giống nhau',
        );
        return Validator::make($input, $rules, $messages);
    }

    public static function validateUpdateProfile($input) {
        $rules = array(
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        );
        $messages = array(
            'required' => 'Không được để trống',
        );
        return Validator::make($input, $rules, $messages);
    }

    public function bonus() {
        return $this->belongsToMany('Bonus', 'member_bonus', 'member_id', 'bonus_id');
    }

    public function getBonus() {
        
    }

    public function getNameUidAttribute() {
        return $this->full_name . ' (' . $this->uid . ')';
    }

    public static function buildQuery($params) {
        $instance = new static;
        $query = $instance->newQuery();
        if (isset($params['keyword']) && $params['keyword'] !== '') {
            $query->where(function($query) use ($params) {
                $query->orWhere('full_name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('email', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('uid', 'like', '%' . $params['keyword'] . '%');
            });
        } else {
            $month = isset($params['month']) ? $params['month'] : \Carbon\Carbon::now()->format('m/Y');
            if ($month !== 'all') {
                $start = \Carbon\Carbon::createFromFormat('m/Y', $month)->startOfMonth();
                $end = \Carbon\Carbon::createFromFormat('m/Y', $month)->endOfMonth();
                $query->whereBetween('created_at', array($start, $end));
            }
        }
        return $query;
    }

    public static function paging($params) {
        $instance = new static;
        $query = $instance->newQuery();
        if (isset($params['keyword'])) {
            $query->where(function($query) use ($params) {
                $query->orWhere('full_name', 'like', '%' . $params['keyword'] . '%');
                $query->orWhere('email', 'like', '%' . $params['keyword'] . '%');
                $query->orWhere('username', 'like', '%' . $params['keyword'] . '%');
            });
        }
        $result = $query->paginate();
        return $result;
    }

    public function creator() {
        return $this->belongsTo('Member', 'created_by');
    }

    public function getSexName() {
        return $this->sex == 0 ? 'Nam' : 'Nữ';
    }

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getReminderEmail() {
        return $this->email;
    }

}
