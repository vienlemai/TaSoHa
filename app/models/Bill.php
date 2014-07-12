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
        'price' => 'required|numeric',
        'score' => 'required|numeric|integer',
        'member_id' => 'required',
    );

}
