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
        return $this->belongsTo('ArticleCategory', 'categor_id', 'id');
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

    public static function paging($params) {
        $query = self::with('category');
        if (isset($params['keyword'])) {
            $query->where('title', 'like', '%' . $params['keyword'] . '%');
        }
        if (isset($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }
        $result = $query->paginate();
        //dd($result->toArray());
        return $result;
    }

}
