<?php

namespace Member;

use Member;

class HomeController extends MemberBaseController {

    /**
     * GET /
     */
    public function index() {
        $root = Member::roots()->first();
        $treeJson = $root->getListJson();
        $this->layout->content = \View::make('member.home.index', array(
                'treeData' => $treeJson,
        ));
    }

}
