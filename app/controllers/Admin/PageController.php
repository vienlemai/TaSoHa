<?php

namespace Admin;

use \Page;
use \Session;
use \Redirect;
use \View;
use \Input;

class PageController extends AdminBaseController {

    public function index() {
        $pages = Page::all();
        $this->layout->content = View::make('admin.page.index')->with(compact('pages'));
    }

    public function edit($name) {
        if (Page::checkNameValid($name)) {
            $page = Page::findOrCreateByName($name);
            $this->layout->content = View::make('admin.page.edit')
                ->with(compact('page'));
        } else {
            Session::flash('error', trans('not_found'));
            return Redirect::route('admin.root');
        }
    }

    public function update($name) {
        if (Page::checkNameValid($name)) {
            $page = Page::findOrCreateByName($name);
            if ($page->update(Input::all())) {
                Session::flash('messages.page_save_successfully', array('title' => $page->title));
                return Redirect::route('admin.page.index');
            } else {
                return Redirect::route('admin.page.edit', $page->name)->withErrors($page->errors());
            }
        } else {
            Session::flash('error', trans('not_found'));
            return Redirect::route('admin.root');
        }
    }

}
