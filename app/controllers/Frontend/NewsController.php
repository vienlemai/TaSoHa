<?php

namespace Frontend;

use \Auth;
use \View;
use \Redirect;
use \Session;
use \Input;
use \News;

class NewsController extends FrontendBaseController {

    public function index() {
        $news = News::all();
        $this->layout->content = View::make('frontend.news.index')
                ->with(compact('news'));
    }

    public function show($id) {
        $new = News::findOrFail($id);
        $this->layout->content = View::make('frontend.news.show')
                ->with(compact('new'));
    }

}

?>
