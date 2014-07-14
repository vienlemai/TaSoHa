<?php

class SlideImage extends \LaravelBook\Ardent\Ardent {

    const SLIDE_DIR = 'assets/slides';

    protected $table = 'slide_images';
    protected $fillable = array(
        'url', 'is_active', 'created_by', 'description', 'image'
    );
    public $timestamps = false;
    /*
     * VALIDATIONS
     */
    public static $rules = array(
        'image' => 'required|image',
        'description' => 'required'
    );
    public static $customMessages = array(
        'required' => 'The :attribute field is required.'
    );

    public function afterSave() {
        $this->position = $this->id;
    }
    public function beforeCreate() {
        $this->created_at = date('Y-m-d H:i:s');
    }

}