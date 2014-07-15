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
        $input = Input::all();
        $input['image'] = Input::file('image');
        $slider = new SlideImage($input);
        if ($slider->validate()) {
            if ($url = $this->uploadImage(Input::file('image'))) {
                $slider = new SlideImage(Input::except('image'));
                $slider->url = $url;
                $slider->created_by = Auth::admin()->get()->id;
                $slider->forceSave();
                Session::flash('success', 'slider_saved');
                return Redirect::route('admin.slide.index');
            } else {
                Session::flash('success', 'upload_failed');
                return Redirect::back();
            }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
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
