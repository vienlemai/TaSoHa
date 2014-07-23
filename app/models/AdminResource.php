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
