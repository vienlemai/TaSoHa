<?php

class Page extends \LaravelBook\Ardent\Ardent {

    const TASOHA_MISSION = 'mission';
    const TASOHA_LAND = 'land';
    const TASOHA_ECOM = 'ecom';
    const TASOHA_EDU = 'edu';
    const TASOHA_INVEST = 'invest';
    const TASOHA_CONTACT = 'contact';
    const TASOHA_TERMS_OF_USE = 'terms_of_use';

    /**
     * The text of links
     */
    public static $NAME_TO_TEXT = array(
        self::TASOHA_MISSION => 'Sứ mệnh',
        self::TASOHA_LAND => 'TASOHA LAND',
        self::TASOHA_ECOM => 'TASOHA ECOM',
        self::TASOHA_EDU => 'TASOHA EDU',
        self::TASOHA_INVEST => 'TASOHA INVEST',
        self::TASOHA_CONTACT => 'Liên hệ',
        self::TASOHA_TERMS_OF_USE => 'Điều khoản sử dụng',
    );
    public $timestamps = false;
    protected $table = 'pages';
    public $fillable = array(
        'title',
        'content'
    );
    /*
     * VALIDATIONS
     */
    public static $rules = array(
        'title' => 'required',
        'content' => 'required'
    );

    public static function textForPage($name) {
        if (isset(self::$NAME_TO_TEXT[$name])) {
            return self::$NAME_TO_TEXT[$name];
        } else {
            return NULL;
        }
    }

}
