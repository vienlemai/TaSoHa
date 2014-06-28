<?php

class Article extends LaravelBook\Ardent\Ardent {
    protected $table = 'articles';
    public $fillable = array(
        'categor_id',
        'title',
        'content',
        'thumbnail',
    );

    public function category() {
        return $this->belongsTo('Category');
    }

    public static function boot() {
        parent::boot();
        static::creating(function($article) {
            $article->created_by = Auth::user()->id;
            $article->is_active = true;
        });
    }

    public function makeActive() {
        $this->is_active = true;
        $this->save();
    }

    public function makeUnActive() {
        $this->is_active = false;
        $this->save();
    }

    public static function paging($param) {
        $query = self::with('category');
        if (isset($param['keyword'])) {
            $query->where('title');
        }
    }

}
