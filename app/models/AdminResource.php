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
            'list_member' => array('admin.members.index', 'admin.members.show', 'admin.members.tree', 'admin.members.shares'),
            'create_member' => array('admin.members.create', 'admin.members.store'),
            'edit_member' => array('admin.members.edit', 'admin.members.update'),
            'delete_member' => array('admin.members.destroy'),
            'list_bill' => array('admin.bills.index', 'admin.bills.show', 'admin.bills.print'),
            'create_bill' => array('admin.bills.create', 'admin.bills.store'),
            'create_bonus' => array('admin.bonus.create', 'admin.bonus.store'),
        ),
//        'manage_news' => array(
//            'list_news' => array('admin.news.index'),
//            'create_news' => array('admin.news.create', 'admin.news.store'),
//            'edit_news' => array('admin.news.edit', 'admin.news.update'),
//            'delete_news' => array('admin.news.destroy'),
//        ),
        'manage_article' => array(
            'list_article' => array('admin.articles.index'),
            'add_article' => array('admin.articles.create', 'admin.articles.store'),
            'edit_article' => array('admin.articles.edit', 'admin.articles.update'),
            'delete_article' => array('admin.articles.destroy'),
            //'list_category' => array('admin.article_categories.index'),
            //'add_category' => array('admin.article_categories.create', 'admin.article_categories.store'),
           // 'edit_category' => array('admin.article_categories.edit', 'admin.article_categories.update'),
            //'detele_category' => array('admin.article_categories.destroy')
        ),
        'manage_menus' => array(
            'list_menus' => array('admin.menu.index'),
            'add_menu' => array('admin.menu.create', 'admin.menu.store'),
            'edit_menu' => array('admin.menu.edit', 'admin.menu.update'),
            'delete_menu' => array('admin.menu.destroy'),
        ),
        'manage_product' => array(
            'list_product' => array('admin.product.index'),
            'add_product' => array('admin.product.create', 'admin.product.store'),
            'edit_product' => array('admin.product.edit', 'admin.product.update'),
            'delete_product' => array('admin.product.destroy'),
            'list_category_product' => array('admin.product_category.index'),
            'create_category_product' => array('admin.product_category.create', 'admin.product_category.store'),
            'edit_category_product' => array('admin.product_category.edit', 'admin.product_category.update'),
            'delete_category_product' => array('admin.product_category.destroy'),
        ),
        'manage_page' => array(
            'list_page' => array('admin.page.index'),
            'edit_page' => array('admin.page.edit', 'admin.page.update')
        ),
        'site_setting' => array(
            'slide' => array('admin.slide.index', 'admin.slide.create', 'admin.slide.store', 'admin.slide.edit', 'admin.slide.update', 'admin.slide.destroy')
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
