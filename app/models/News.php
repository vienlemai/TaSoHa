<?php

class News extends LaravelBook\Ardent\Ardent {

    protected $table = 'news';
    protected $fillable = array(
        'title', 'content'
    );
    /*
     * VALIDATIONS
     */
    public static $rules = array(
        'title' => 'required',
        'content' => 'required'
    );
    public static $customMessages = array(
        'required' => 'The :attribute field is required.'
    );

    static function boot() {
        parent::boot();
        static::saving(function($object) {
                    $object->slug = strtolower(StringHelper::slug($object->title));
                });
    }

    public function toParam() {
        return $this->id . '-' . $this->slug;
    }

    public static function recent($count = 3) {
        return self::orderBy('created_at', 'DESC')->take(3)->get();
    }

}

?>
