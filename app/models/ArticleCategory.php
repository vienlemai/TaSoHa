<?php

class ArticleCategory extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'article_categories';

    public function articles() {
        return $this->hasMany('Article');
    }
    
    

}
