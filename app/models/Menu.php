<?php

class Menu extends Baum\Node {
    const TYPE_CATEGORY = 1;
    const TYPE_ARTICLE = 2;
    const TYPE_LINK = 3;

    public static $TYPE_LABELS = array(
        self::TYPE_CATEGORY => 'Danh mục',
        self::TYPE_ARTICLE => 'Bài viết',
        self::TYPE_LINK => 'link'
    );
    public static $MENU_DATA = array(
        self::TYPE_CATEGORY => array(
            'route' => 'fe.category',
        ),
        self::TYPE_ARTICLE => array(
            'route' => 'fe.fe.article.show'
        ),
        self::TYPE_LINK=>  array()
    );

    /*
     * PROPERTIES
     */
    protected $table = 'menus';
    public $fillable = array(
        'name',
    );

    /*
     * VALIDATIONS
     */
    public static $rules = array(
        'name' => 'required',
    );
    public static $customMessages = array(
        'required' => 'The :attribute field is required.'
    );

    /*
     * ASSOCIATIONS
     */

    public function parentMenu() {
        return $this->belongsTo('Menu', 'parent_id');
    }

    public function chilren() {
        return $this->hasMany('Menu', 'parent_id');
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
