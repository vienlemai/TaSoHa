<?php

namespace Admin;

use \View;
use \Auth;
use \Session;
use \Redirect;
use \Input;
use \News;

class NewsController extends AdminBaseController {

    public function index() {
        $news = News::orderBy('created_at', 'DESC')->paginate(15);
        return View::make('admin.news.index')->with(compact('news'));
    }

    public function create() {
        return View::make('admin.news.create');
    }

    public function store() {
        $news = new News(Input::all());
        $news->created_by = Auth::admin()->get()->id;
        if ($news->save()) {
            Session::flash('success', trans('messages.news_save_successfully', array('title' => $news->title)));
            return Redirect::route('admin.news.index');
        } else {
            return Redirect::route('admin.news.create')->withErrors($news->errors());
        }
    }

    public function edit($id) {
        $news = News::findOrFail($id);
        return View::make('admin.news.edit')->with(compact('news'));
    }

    public function update($id) {
        $news = News::findOrFail($id);
        if ($news->update(Input::all())) {
            Session::flash('success', trans('messages.news_save_successfully', array('title' => $news->title)));
            return Redirect::route('admin.news.index');
        } else {
            return Redirect::route('admin.news.edit', $news->id)->withErrors($news->errors());
        }
    }

    public function destroy($id) {
        $news = News::findOrFail($id);
        $news->delete();
        Session::flash('success', trans('messages.news_delete_successfully', array('title' => $news->title)));
        return Redirect::route('admin.news.index');
    }

}
?>
