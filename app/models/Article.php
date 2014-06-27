<?php

class Article extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'articles';

    public function category() {
        return $this->belongsTo('Category');
    }

    public function makeActive() {
        $this->is_active = true;
        $this->save();
    }

    public function makeUnActive() {
        $this->is_active = false;
        $this->save();
    }

}
