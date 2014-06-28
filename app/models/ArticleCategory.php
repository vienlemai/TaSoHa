<?php

class ArticleCategory extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'article_categories';
    public $fillable = array(
        'name',
        'parent_id',
    );

    public function articles() {
        return $this->hasMany('Article');
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

    public function parentCategory() {
        return $this->belongsTo('ArticleCategory', 'parent_id', 'id');
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
