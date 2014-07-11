<?php

class AdminResource {
    public static $resources = array(
        'manage_users' => array(
            'list_user' => ['admin.users.index'],
            'create_user' => ['admin.users.create', 'admin.users.store'],
            'edit_user' => ['admin.users.edit', 'admin.users.update'],
            'delete_user' => ['admin.users.destroy']
        ),
        'manage_groups' => array(
            'list_group' => ['admin.groups.index'],
            'create_group' => ['admin.groups.create', 'admin.users.store'],
            'edit_group' => ['admin.groups.edit', 'admin.groups.store'],
            'delete_group' => ['admin.groups.destroy'],
            'set_permission' => ['admin.groups.permission']
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
