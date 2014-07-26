<?php

class ProductCategory extends LaravelBook\Ardent\Ardent {
    protected $table = 'product_categories';
    public $fillable = array(
        'name',
        'description',
        'thumbnail'
    );
    public static $rules = array(
        'name' => 'required',
        'description' => 'required',
        'thumbnail' => 'required'
    );

    static function boot() {
        parent::boot();
        static::saving(function($cat) {
            $cat->slug = strtolower(StringHelper::slug($cat->name));
        });
    }

    public function products() {
        return $this->hasMany('Product', 'product_category_id');
    }

    public function toParam() {
        return $this->id . '-' . $this->slug;
    }

    public function scopeShowOnMenu($query) {
        return $query->where('show_on_menu', true);
    }

    public function scopeHideOnMenu($query) {
        return $query->where('show_on_menu', false);
    }

    public static function seed() {
        $cats = array('Thực phẩm chức năng', 'Mỹ phẩm', 'Hàng tiêu dùng');
        foreach ($cats as $catName) {
            $cat = new ProductCategory(
                array(
                'name' => $catName,
                'description' => 'Danh mục ' . $catName
                )
            );
            $cat->thumbnail = "http://tasoha.com/assets/img/category.png";
            $cat->show_on_menu = true;
            $cat->save();
        }
    }

}

?>
