<?php

class ProductCategory extends LaravelBook\Ardent\Ardent {

    protected $table = 'product_categories';
    public $fillable = array(
        'name',
        'code'
    );

    static function boot() {
        parent::boot();
        static::saving(function($cat) {
                    $cat->slug = strtolower(StringHelper::slug($cat->name));
                });
    }

    public function scopeShowOnMenu($query) {
        return $query->where('show_on_menu', true);
    }

    public function scopeHideOnMenu($query) {
        return $query->where('show_on_menu', false);
    }

}

?>
