<?php

namespace Frontend;

use \Share;
use View;
use \Response;

class ShareController extends FrontendBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $shares = Share::with('member')
            ->orderBy('created_at', 'ASC')
            ->paginate(100);
        $this->layout->content = View::make('frontend.share.index', array(
                'shares' => $shares
        ));
    }

    public function level() {
        $shares = Share::getByLevel();
        $this->layout->content = View::make('frontend.share.level', array(
                'shares' => $shares,
        ));
    }

}
