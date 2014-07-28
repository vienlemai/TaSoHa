<?php

class Product extends LaravelBook\Ardent\Ardent {
    protected $table = 'products';

    const DEFAULT_THUMBNAIL = 'assets/img/no-image.jpg';

    public $fillable = array(
        'name',
        'code',
        'description',
        'thumbnail',
        'product_category_id'
    );
    public static $rules = array(
        'name' => 'required',
        'code' => 'required',
        'description' => 'required'
    );

    static function boot() {
        parent::boot();
        static::saving(function($product) {
            $product->slug = strtolower(StringHelper::slug($product->name));
        });
    }

    public function toParam() {
        return $this->id . '-' . $this->slug;
    }

    public function category() {
        return $this->belongsTo('ProductCategory', 'product_category_id');
    }

    public function scopeVisible($query) {
        return $query->where('visible', true);
    }

    public function scopeInvisible($query) {
        return $query->where('visible', false);
    }

    public function isVisible() {
        return $this->visible == '1';
    }

    public function isInvisible() {
        return !$this->isVisible();
    }

    public function makeVisible() {
        if (!$this->visible) {
            $this->update(array('visible' => true));
        }
    }

    public function makeInvisible() {
        if ($this->visible) {
            $this->update(array('visible' => false));
        }
    }

    public static function paging($params) {
        $query = self::with('category');
        if (isset($params['keyword'])) {
            $query->where('title', 'like', '%' . $params['keyword'] . '%');
        }
        if (isset($params['product_category_id'])) {
            $query->where('product_category_id', $params['product_category_id']);
        }
        $result = $query->paginate();
        return $result;
    }

    public function getThumbnailUrl() {
        if ($this->thumbnail && file_exists(public_path($this->thumbnail))) {
            return asset($this->thumbnail);
        } else {
            return asset(self::DEFAULT_THUMBNAIL);
        }
    }

}

?>
