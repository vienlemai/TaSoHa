<?php

class ArticleCategory extends LaravelBook\Ardent\Ardent {
    /*
     * PROPERTIES
     */
    protected $table = 'article_categories';
    public $fillable = array(
        'name',
        'description'
    );

    const DEFAULT_THUMBNAIL = 'assets/img/no-image.jpg';

    public static $CAT_INTRO = 1;
    public static $CAT_NEWS = array(2, 3);
    public static $CAT_RECRUITMENTS = array(4, 5);
    public static $CAT_PRODUCT = 6;
    public static $CAT_TRANING = 7;
    public static $CAT_EVENT = 8;

    /*
     * VALIDATIONS
     */
    public static $rules = array(
        'name' => 'required',
        'description' => 'required'
    );
    public static $customMessages = array(
        'required' => 'The :attribute field is required.'
    );

    /*
     * ASSOCIATIONS
     */

    public function articles() {
        return $this->hasMany('Article', 'category_id');
    }

    public function toParam() {
        return $this->id . '-' . $this->slug;
    }

    /*
     * STATIC FUNCTIONS
     */

    static function boot() {
        parent::boot();
        static::saving(function($object) {
            $object->slug = strtolower(StringHelper::slug($object->name));
        });
    }

    public static function paging($params) {
        $query = self::with('articles');
        if (isset($params['keyword'])) {
            $query->where('name', 'like', '%' . $params['keyword'] . '%');
        }
        $result = $query->paginate();
        return $result;
    }

    public function getThumbnailUrl() {
        if ($this->photo && file_exists(public_path($this->photo))) {
            return asset($this->photo);
        } else {
            return asset(self::DEFAULT_THUMBNAIL);
        }
    }

  

}
