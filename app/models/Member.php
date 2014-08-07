<?php

use Baum\Node;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Member
 */
class Member extends Node implements UserInterface, RemindableInterface {

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'members';

    const CAP_BAN_HANG = 'ban_hang';
    const CAP_GIAM_SAT = 'giam_sat';
    const CAP_CHUYEN_VIEN = 'chuyen_vien';

    public static $scoreForPromotion = array(
        self::CAP_BAN_HANG => 140,
        self::CAP_GIAM_SAT => 490,
        self::CAP_CHUYEN_VIEN => 1000,
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
    );

    public static function boot() {
        parent::boot();
        static::creating(function($member) {
            $member->regency = '';
            $member->uid = time();
//            if (!$member->parent_id) {
//                $member->parent_id = null;
//            }
//            if (!$member->introduced_by) {
//                $member->introduced_by = null;
//            }
            return true;
        });
        static::created(function($member) {
            //create bonuse row for member
            $bonus = MyBonus::get(array('id'));
            foreach ($bonus as $b) {
                $mb = DB::table('member_bonus')
                    ->where('member_id', $member->id)
                    ->where('bonus_id', $b->id)
                    ->first(array('id'));
                if ($mb === null) {
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
            $tb = DB::table('team_bonus')
                ->where('member_id', $member->id)
                ->first(array('id'));
            if ($tb === null) {
                DB::table('team_bonus')
                    ->insert(array('member_id' => $member->id));
            }
            return true;
        });
        static::saving(function($member) {
            if (Hash::needsRehash($member->password)) {
                $member->password = Hash::make($member->password);
            }
            //check score for promotion
            $score = $member->score;
            if ($score >= self::$scoreForPromotion[self::CAP_BAN_HANG] && $score < self::$scoreForPromotion[self::CAP_GIAM_SAT]) {
                $member->regency = self::CAP_BAN_HANG;
            } elseif ($member->score >= self::$scoreForPromotion[self::CAP_GIAM_SAT] && $member->score <= self::$scoreForPromotion[self::CAP_CHUYEN_VIEN]) {
                $member->regency = self::CAP_GIAM_SAT;
            } else {
                $member->regency = self::CAP_CHUYEN_VIEN;
            }
            return true;
        });
    }

    public function initBonus() {
        $bonus = MyBonus::get(array('id'));
        foreach ($bonus as $b) {
            DB::table('member_bonus')
                ->insert(array(
                    'member_id' => $this->id,
                    'bonus_id' => $b->id,
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'amount' => 0,
                    'auto_amount' => 0
            ));
        }
        DB::table('team_bonus')
            ->insert(array('member_id' => $this->id));
    }

    public function sunlight() {
        return $this->hasMany('Member', 'introduced_by');
    }

    public function introducer() {
        return $this->belongsTo('Member', 'introduced_by');
    }

    public static function validate($input, $id = null) {
        $rules = array(
            'email' => 'required|email|unique:members,email,' . $id,
            'full_name' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'day_of_birth' => 'required',
            'identify_number' => 'required|numeric',
            'identify_location' => 'required|required',
            'identify_date' => 'required',
            'location' => 'required',
            'phone' => 'required|numeric'
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

    public function needUpdateTeamBonus() {
        $ancestors = Member::with(array('children' => function($query) {
                $query->select(array('id', 'parent_id'));
            }))->where('lft', '<=', $this->lft)
            ->where('rgt', '>=', $this->rgt)
            ->where('id', '!=', $this->id)
            ->get(array('id', 'parent_id'));
        foreach ($ancestors as $ancestor) {
            if ($ancestor->children->count() == 2) {
                DB::table('team_bonus')
                    ->where('member_id', $ancestor->id)
                    ->update(array('need_to_up' => true));
            }
        }
    }

    public function updateTeamBonus() {
        $teamBonus = DB::table('team_bonus')
            ->where('member_id', $this->id)
            ->where('need_to_up', true)
            ->first();
        if ($teamBonus !== null) {
            //can cap nhat hoa hong dong doi
            $children = self::where('parent_id', $this->id)
                ->get(array('id', 'parent_id', 'lft', 'rgt'));
            //tim con trai va con phai
            $left = $children->first();
            $right = $children->last();
            //tinh tong diem cua con trai
            $leftScore = Member::where('lft', '>=', $left->lft)
                ->where('lft', '<', $left->rgt)
                ->sum('score');
            //tong diem cua coon phai
            $rightScore = Member::where('lft', '>=', $right->lft)
                ->where('lft', '<', $right->rgt)
                ->sum('score');
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
            $teamBonus = DB::table('member_bonus')
                ->where('member_id', $this->id)
                ->where('bonus_id', MyBonus::HH_DONG_DOI)
                ->first(array('auto_amount'));
            DB::table('member_bonus')
                ->where('member_id', $this->id)
                ->where('bonus_id', MyBonus::HH_DONG_DOI)
                ->update(array(
                    'auto_amount' => $teamBonus->auto_amount + $amount,
            ));
        }
    }

    public static function validateEdit($input, $id) {
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

        if (isset($params['keyword'])) {
            $query->where(function($query) use ($params) {
                $query->orWhere('full_name', 'like', '%' . $params['keyword'] . '%');
                $query->orWhere('email', 'like', '%' . $params['keyword'] . '%');
                $query->orWhere('username', 'like', '%' . $params['keyword'] . '%');
            });
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

    public function findNodeToAdd() {
        $descendants = $this->getDescendantsAndSelf()->toHierarchy();
        $root = $descendants->first();
        $leftNode = $root->children->first();
        $rightNode = $root->children->last();
        $availableLeft = array(
            'leaves' => array(),
            'onlyLeft' => array(),
        );
        $availableRight = array(
            'leaves' => array(),
            'onlyLeft' => array(),
        );
        self::explodeDescendant($leftNode, $availableLeft);
        self::explodeDescendant($rightNode, $availableRight);
        $leftLeaves = count($availableLeft['leaves']);
        $rightLeaves = count($availableRight['leaves']);
        $leftOnlyLeft = count($availableLeft['onlyLeft']);
        $rightOnlyLeft = count($availableRight['onlyLeft']);
        var_dump('left-leaves ' . $leftLeaves);
        var_dump('right-leaves ' . $rightLeaves);
        var_dump('left-only-left ' . $leftOnlyLeft);
        var_dump('right-only-left ' . $rightOnlyLeft);
        //exit();
        $result = null;
        if (($leftLeaves + $leftOnlyLeft) > ($rightLeaves + $rightOnlyLeft)) {
            if ($rightLeaves > 0) {
                $result['position'] = 'right';
                $result['node'] = $availableRight['leaves'][0];
            } else if ($rightOnlyLeft > 0) {
                $result['position'] = 'right';
                $result['node'] = $availableRight['onlyLeft'][0];
            }
        } else if ($leftLeaves > 0 || $rightLeaves > 0) {
            if ($leftLeaves == $rightLeaves) {
                $result['position'] = 'left';
                $result['node'] = $availableLeft['leaves'][0];
            } else {
                $result['position'] = 'right';
                $result['node'] = $availableRight['leaves'][0];
            }
        } else {
            if ($leftOnlyLeft == $rightOnlyLeft) {
                $result['position'] = 'left';
                $result['node'] = $availableLeft['onlyLeft'][0];
            } else {
                $result['position'] = 'right';
                $result['node'] = $availableRight['onlyLeft'][0];
            }
        }

        /* if ($leftLeaves > 0) {
          //add to leave
          if ($rightOnlyLeft > 0 && $rightOnlyLeft != $leftOnlyLeft) {
          $result['node'] = $availableRight['onlyLeft'][0];
          $result['position'] = 'right';
          } else if ($leftLeaves == $rightLeaves) {
          $result['node'] = $availableLeft['leaves'][0];
          $result['position'] = 'left';
          } else {
          $result['node'] = $availableRight['leaves'][0];
          $result['position'] = 'right';
          }
          } else {
          //add to node that have only children
          if ($rightLeaves > 0) {
          $result['node'] = $availableRight['leaves'][0];
          $result['position'] = 'right';
          } else if ($leftOnlyLeft == $rightOnlyLeft) {
          $result['node'] = $availableLeft['onlyLeft'][0];
          $result['position'] = 'left';
          } else {
          $result['node'] = $availableRight['onlyLeft'][0];
          $result['position'] = 'right';
          }
          } */
        return $result;
    }

    public static function explodeDescendant($node, &$availableLeft) {
        if ($node->children->isEmpty()) {
            array_push($availableLeft['leaves'], $node);
            return;
        } else if ($node->children->count() == 1) {
            array_push($availableLeft['onlyLeft'], $node);
            return;
        } else {
            $leftNode = $node->children->first();
            $rightNode = $node->children->last();
            if ($leftNode->children->count() == $rightNode->children->count()) {
                self::explodeDescendant($leftNode, $availableLeft);
                self::explodeDescendant($rightNode, $availableLeft);
            } else if ($rightNode->children->count() == 1) {
                self::explodeDescendant($rightNode, $availableLeft);
            } else {
                self::explodeDescendant($leftNode, $availableLeft);
                self::explodeDescendant($rightNode, $availableLeft);
            }
        }
    }

    public function getListJson() {
        $columns = array(
            'members.full_name as name',
            'members.id',
            'members.parent_id as pId',
        );
        $query = $this->whereBetween('lft', array($this->lft, $this->rgt));
        $result = $query->get($columns);
        $json = $result->toJson();
        $json = str_ireplace('null', '0', $json);
        return $json;
    }

    public function renderDescendents() {
        $descendants = $this->getDescendantsAndSelf()->toHierarchy();
        $root = $descendants->first();
        $html = $this->_build($root);
        return $html;
    }

    private function _build($node) {
        $canAdd = $node->children->count() < 2 ? 1 : 0;
        $tmp = '<input type="hidden" data-addable="' . $canAdd . '" class="member-id" data-fullname="' . $node->full_name . '" value="' . $node->id . '"/>' . $node->full_name;
        if ($node->children->isEmpty()) {
            return '<li>' . $tmp . '</li>';
        } else {
            $item = '<li>' . $tmp . '<ul>';
            foreach ($node->children as $child) {
                $item.=$this->_build($child);
            }
            $item.='</ul></li>';
            return $item;
        }
    }

    public static function getBinaryChildren($parenId = null) {
        if (!$parenId) {
            $nodes = self::with('children')
                ->where('parent_id', null)
                ->orWhere('parent_id', 0)
                ->get();
        } else {
            $nodes = self::with('children')->where('parent_id', $parenId)
                ->get();
        }
        $data = array();
        foreach ($nodes as $node) {
            $nodeItem = array(
                'id' => $node->id,
                'text' => $node->full_name,
                'children' => $node->children->isEmpty() ? false : true,
            );
            array_push($data, $nodeItem);
        }
        return ($data);
    }

    public static function getSunChildren($introducerId = null) {
        if (!$introducerId) {
            $nodes = self::with('sunlight')
                ->where('introduced_by', null)
                ->orWhere('introduced_by', 0)
                ->get();
        } else {
            $nodes = self::with('sunlight')->where('introduced_by', $introducerId)
                ->get();
        }
        $data = array();
        foreach ($nodes as $node) {
            $nodeItem = array(
                'id' => $node->id,
                'text' => $node->full_name,
                'children' => $node->sunlight->isEmpty() ? false : true,
            );
            array_push($data, $nodeItem);
        }
        return ($data);
    }

    private function _getDetailHtml($node) {
        $div = '<div style="display:none">'
            . '<p>Họ tên: ' . $node->full_name . '</p>'
            . '<p> Email: ' . $node->email . '</p>'
            . '</div>';
        return $div;
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
