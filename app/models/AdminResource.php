<?php

class AdminResource {
    public static $resources = array(
        'manage_users' => array(
            'list_user' => array('admin.users.index'),
            'create_user' => array('admin.users.create', 'admin.users.store'),
            'edit_user' => array('admin.users.edit', 'admin.users.update'),
            'delete_user' => array('admin.users.destroy')
        ),
        'manage_groups' => array(
            'list_group' => array('admin.groups.index'),
            'create_group' => array('admin.groups.create', 'admin.users.store'),
            'edit_group' => array('admin.groups.edit', 'admin.groups.store'),
            'delete_group' => array('admin.groups.destroy'),
            'set_permission' => array('admin.groups.permission')
        ),
        'manage_member' => array(
            'list_member' => array('admin.members.index', 'admin.members.show'),
            'create_member' => array('admin.members.create', 'admin.members.store'),
            'edit_member' => array('admin.members.edit', 'admin.members.update'),
            'delete_member' => array('admin.members.destroy'),
            'list_bill' => array('admin.bills.index'),
            'create_bill' => array('admin.bills.create', 'admin.bills.store'),
            'create_bonus' => array('admin.bonus.create', 'admin.bonus.store'),
        ),
        'manage_news' => array(
            'list_news' => array('admin.news.index'),
            'create_news' => array('admin.news.create', 'admin.news.store'),
            'edit_news' => array('admin.news.edit', 'admin.news.update'),
            'delete_news' => array('admin.news.destroy'),
        ),
        'manage_article_category' => array(
            'list_category' => array('admin.article_categories.index'),
            'create_category' => array('admin.article_categories.create', 'admin.article_categories.store'),
            'edit_category' => array('admin.article_categories.edit', 'admin.article_categories.update'),
            'detele_category' => array('admin.article_categories.destroy')
        ),
    );

    public static function allRoutes() {
        $routes = array();
        foreach (self::$resources as $k => $resource) {
            foreach ($resource as $k => $v) {
                $routes = array_merge($routes, $v);
            }
        }
        return $routes;
    }

}
