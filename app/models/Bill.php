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
