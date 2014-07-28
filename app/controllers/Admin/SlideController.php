<?php

namespace Admin;

use \View;
use \Auth;
use \Session;
use \Redirect;
use \Input;
use \SlideImage;

class SlideController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $slides = SlideImage::orderBy('created_at', 'DESC')->paginate(15);
        return View::make('admin.slide.index')->with(compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $url = Input::get('url');
        if (empty($url)) {
            Session::flash('error', 'Bạn chưa chọn ảnh cho slide');
            return Redirect::back();
        }
        $slider = new SlideImage(Input::all());
        if ($slider->validate()) {
            $slider->created_by = Auth::admin()->get()->id;
            $slider->forceSave();
            Session::flash('success', 'slider_saved');
            return Redirect::route('admin.slide.index');
        } else {
            return Redirect::back()->withErrors($slider->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $slide = SlideImage::findOrFail($id);
        return View::make('admin.slide.edit', array(
                'slide' => $slide
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $slide = SlideImage::findOrFail($id);
        $url = Input::get('url');
        if (empty($url)) {
            Session::flash('error', 'Bạn chưa chọn ảnh cho slide');
            return Redirect::back();
        }
        $slide->fill(Input::all());
        if ($slide->validate()) {
            $slide->forceSave();
            Session::flash('success', 'slider_saved');
            return Redirect::route('admin.slide.index');
        } else {
            return Redirect::back()->withErrors($slider->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $slide = SlideImage::findOrFail($id);
        $slide->delete();
        Session::flash('success', 'Xóa thành công 1 ảnh của slides');
        return Redirect::route('admin.slide.index');
    }

    private function uploadImage($file) {
        $folderName = SlideImage::SLIDE_DIR;
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . $folderName . DIRECTORY_SEPARATOR;
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath);
        }
        $fileName = time() . '-' . $file->getClientOriginalName();
        try {
            $file->move($destinationPath, $fileName);
            return $folderName . DIRECTORY_SEPARATOR . $fileName;
        } catch (Exception $e) {
            return null;
        }
    }

}
