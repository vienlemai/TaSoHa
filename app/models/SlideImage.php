<?php

class SlideImage extends \LaravelBook\Ardent\Ardent {
    const SLIDE_DIR = 'assets/slides';
    const DEFAULT_THUMBNAIL = 'assets/img/no-image.jpg';

    protected $table = 'slide_images';
    protected $fillable = array(
        'url', 'is_active', 'created_by', 'description', 'image'
    );
    public $timestamps = false;
    /*
     * VALIDATIONS
     */
    public static $rules = array(
        //'image' => 'required|image',
        'description' => 'required'
    );

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function afterSave() {
        $this->position = $this->id;
    }

    public function beforeCreate() {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getThumbnailUrl() {
        if ($this->url && file_exists(public_path($this->url))) {
            return asset($this->url);
        } else {
            return asset(self::DEFAULT_THUMBNAIL);
        }
    }

}
