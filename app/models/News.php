<?php

class News extends LaravelBook\Ardent\Ardent {

    protected $table = 'news';
    protected $fillable = array(
        'title', 'content'
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

}

?>
