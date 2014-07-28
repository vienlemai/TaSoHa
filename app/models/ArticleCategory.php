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
