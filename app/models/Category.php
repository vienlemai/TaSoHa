<?php

class Category extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'categories';

    public function articles() {
        return $this->hasMany('Article');
    }
    
    

}
