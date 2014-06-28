<?php

class FileController extends BaseController {

    public function uploadImage() {
        $uploadType = Input::get('uploadType');
        $oldFile = Input::get('oldFile');
        //$destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $uploadType;
        $destinationPath = app_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
        $destinationPath.= $uploadType;

        $result = array();
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath);
        }
        if ($oldFile != '') {
            if (is_file($destinationPath . DIRECTORY_SEPARATOR . $oldFile)) {
                unlink($destinationPath . DIRECTORY_SEPARATOR . $oldFile);
            }
        }
        $fileName = Input::file('image')->getClientOriginalName();
        try {
            Input::file('image')->move($destinationPath, $fileName);
            $result['status'] = true;
            $result['image_path'] = asset($fileName);
            $result['image_name'] = $fileName;
        } catch (Exception $e) {
            $result['status'] = false;
            $result['message'] = 'Lỗi hệ thống, vui lòng thử lại sau';
        }
        return Response::json($result);
    }

}
