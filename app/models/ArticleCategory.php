<?php

class ArticleCategory extends \Illuminate\Database\Eloquent\Model {
    /*
     * PROPERTIES
     */

    protected $table = 'article_categories';
    public $fillable = array(
        'name',
        'parent_id',
    );

    /*
     * ASSOCIATIONS
     */

    public function articles() {
        return $this->hasMany('Article', 'category_id');
    }

    public function parentCategory() {
        return $this->belongsTo('ArticleCategory', 'parent_id', 'id');
    }

    /*
     * STATIC FUNCTIONS
     */

    static function boot() {
        parent::boot();
        static::saving(function($object) {
                    if (!$object->parent_id) {
                        $object->parent_id = NULL;
                    }
                    $object->slug = strtolower(StringHelper::slug($object->name));
                });
    }

    public static function parentCategoryList($except = null) {
        if ($except !== null) {
            $categories = self::where('id', '!=', $except)
                    ->get(array(
                'id',
                'name',
            ));
        } else {
            $categories = self::get(array(
                        'id',
                        'name',
            ));
        }
        $data = array();
        $data[null] = Lang::get('messages.its_parent_category');
        foreach ($categories as $category) {
            $data[$category->id] = $category->name;
        }
        return $data;
    }

    public static function listCategories($except = null) {
        if ($except !== null) {
            $categories = self::where('id', '!=', $except)
                    ->get(array(
                'id',
                'name',
            ));
        } else {
            $categories = self::get(array(
                        'id',
                        'name',
            ));
        }
        $data = array();
        foreach ($categories as $category) {
            $data[$category->id] = $category->name;
        }
        return $data;
    }

    public static function paging($params) {
        $query = self::with('parentCategory');
        if (isset($params['keyword'])) {
            $query->where('name', 'like', '%' . $params['keyword'] . '%');
        }
        $result = $query->paginate();
        return $result;
    }

}
