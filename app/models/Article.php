<?php

class Article extends LaravelBook\Ardent\Ardent {
    const DEFAULT_THUMBNAIL = 'assets/img/no-image.jpg';

    protected $table = 'articles';
    public $fillable = array(
        'category_id',
        'title',
        'content',
        'thumbnail',
    );
    /*
     * VALIDATIONS
     */
    public static $rules = array(
        'category_id' => 'required',
        'title' => 'required',
        'content' => 'required'
    );
    public static $customMessages = array(
        'required' => 'The :attribute field is required.'
    );

    public function category() {
        return $this->belongsTo('ArticleCategory', 'category_id', 'id');
    }

    public static function boot() {
        parent::boot();
        static::creating(function($article) {
            $article->is_active = true;
        });
        static::saving(function($article) {
            $article->slug = strtolower(StringHelper::slug($article->title));
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

    public function toParam() {
        return $this->id . '-' . $this->slug;
    }

    public function getThumbnailUrl() {
        if ($this->thumbnail && file_exists(public_path($this->thumbnail))) {
            return asset($this->thumbnail);
        } else {
            return asset(self::DEFAULT_THUMBNAIL);
        }
    }

    public static function recentNews() {
        $news = self::whereIn('category_id', ArticleCategory::$CAT_NEWS)
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();
        return $news;
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
        return $result;
    }

    public static function getByCategory($catId) {
        $query = self::where('category_id', $catId)
            ->orderBy('created_at');
        $result = $query->get();
        return $result;
    }

    public static function listsByCategory($catId, $column = 'slug', $cache = true) {
        $result = self::where('category_id', $catId);
        if ($cache) {
            $result->remember(60);
        }
        return $result->lists($column, 'id');
    }

}
