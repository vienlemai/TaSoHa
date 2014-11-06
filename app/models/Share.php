<?php

class Share extends BaseModel {
    public $table = 'shares';
    public $fillable = array(
        'member_id',
        'price',
        'score',
    );
    public static $rules = array(
        'price' => 'required|numeric|integer|min:1',
        'score' => 'required|numeric|integer|min:1',
        'member_id' => 'required',
    );
    public static $LEVELS = array(0, 1, 2, 3, 4);
    public static $ITEM_PER_LEVEL = array(
        0 => 6,
        1 => 6,
        2 => 7,
        3 => 10,
        4 => 14,
    );

    public function beforeCreate() {
        $this->created_by = Auth::admin()->get()->id;
    }

    public function creator() {
        return $this->belongsTo('AdminUser', 'created_by');
    }

    public function member() {
        return $this->belongsTo('Member', 'member_id');
    }

    public static function getByLevel($isLimit = false) {
        $result = array();
        foreach (self::$LEVELS as $level) {
            $query = self::with('member')
                ->where('level', $level);
            if ($level == 0) {
                $query->take(self::$ITEM_PER_LEVEL[$level]);
            }
            $result[$level] = $query->orderBy('created_at', 'asc')
                ->get();
        }
        return $result;
    }

}
