<?php

/**
 * File AdminGroup.php
 *
 * PHP version 5.4+
 *
 * @author    Evolpas
 * @copyright 2010-2014 evolpas
 * @license   http://www.evolpas.com/license license
 * @version   XXX
 * @link      http://www.evolpas.com
 * @category  Model
 * @package   Model\AdminGroup
 */

/**
 * Class AdminGroup
 *
 * Class description
 *
 * @author    Evolpas
 * @copyright 2013-2014 evolpas
 * @license   http://www.evolpas.com/license license
 * @version   XXX
 * @link      http://www.evolpas.com
 * @category  Model
 * @package   Model\AdminGroup
 * @since     XXX
 */
class AdminGroup extends BaseModel {
    /**
     * table name
     */
    public $table = 'admin_groups';

    /**
     * fillable
     */
    public $fillable = array(
        'name',
        'description',
        'permissions'
    );

    /**
     * name for caching the getting user's permission query
     */
    protected static $cacheName = 'group_permissions';

    /**
     * validate rules
     */
    public static $rules = array(
        'name' => 'required|unique:admin_groups,name',
    );

    public function users() {
        return $this->belongsToMany('AdminUser', 'admin_user_groups', 'group_id', 'user_id');
    }

    public function beforeCreate() {
        $this->permissions = "[]";
    }

    public function afterSave() {
        Cache::forget(self::$cacheName);
    }

    public static function paging($params) {
        $instance = new static;
        $query = $instance->newQuery();
        if (isset($params['keyword'])) {
            $query->searchLike($params['keyword'], 'name');
        }
        $result = $query->paginate();
        return $result;
    }

    public function attachUsers($users) {
        if ($users !== '') {
            $userArr = explode(',', $users);
            $this->users()->sync($userArr);
        }
    }

    /**
     * update permission for group
     * 
     * @param string $permissions a list of permission separate by comma
     * 
     * @since XXX
     */
    public function savePermission($permissions) {
        $perArr = explode(',', $permissions);
        $this->permissions = json_encode($perArr);
        $this->forceSave();
    }

    /**
     * get all allowed routes of a user
     * 
     * @param int $userId id of user 
     * 
     * @return array list of allowed routes
     * 
     * @since XXX
     */
    public static function getPermissionsByUser($userId) {
        $groups = DB::table('admin_groups')
            ->join('admin_user_groups', 'admin_groups.id', '=', 'admin_user_groups.group_id')
            ->where('admin_user_groups.user_id', $userId)
            ->remember(60, self::$cacheName)
            ->get(array('permissions'));
        $resoureces = array();
        foreach ($groups as $groups) {
            $resoureces = array_merge($resoureces, json_decode($groups->permissions));
        }
        return $resoureces;
    }

}
