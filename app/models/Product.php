<?php

class Product extends LaravelBook\Ardent\Ardent {

    protected $table = 'products';
    public $fillable = array(
        'name',
        'description'
    );

    static function boot() {
        parent::boot();
        static::saving(function($product) {
                    $product->slug = strtolower(StringHelper::slug($product->name));
                });
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

}

?>
