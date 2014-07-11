<?php

/**
 * File AdminUser.php
 *
 * PHP version 5.4+
 *
 * @author    Evolpas
 * @copyright 2010-2014 evolpas
 * @license   http://www.evolpas.com/license license
 * @version   XXX
 * @link      http://www.evolpas.com
 * @category  Model
 * @package   Model\AdminUser
 */

/**
 * Class AdminUser
 *
 * Class description
 *
 * @author    Evolpas
 * @copyright 2013-2014 evolpas
 * @license   http://www.evolpas.com/license license
 * @version   XXX
 * @link      http://www.evolpas.com
 * @category  Model
 * @package   Model\AdminUser
 * @since     XXX
 */
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AdminUser extends BaseModel implements UserInterface, RemindableInterface {
    /**
     * Table name
     */
    protected $table = 'admin_users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    public $autoPurgeRedundantAttributes = true;

    /**
     * Security fillable
     */
    public $fillable = array(
        'email',
        'full',
        'first_name',
        'password',
        'password_confirmation',
    );
    public static $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:admin_users,email',
        'password' => 'required|min:6',
        'password_confirmation' => 'same:password',
    );
    public static $profileRules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:admin_users,email',
    );
    public static $passwordRules = array(
        'password' => 'required|min:6',
        'password_confirmation' => 'same:password',
    );

    public function groups() {
        return $this->belongsToMany('AdminGroup', 'admin_user_groups', 'user_id', 'group_id');
    }

    public function beforeCreate() {
        $this->password = Hash::make($this->password);
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken() {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName() {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    /**
     * pagination
     * @param $params list conditions for getting
     * 
     * @return Collection  list users
     */
    public static function paging($params) {
        $instance = new static;
        $query = $instance->newQuery();
        $query->with('groups');
        if (isset($params['keyword'])) {
            $query->searchLike($params['keyword'], array('first_name', 'last_name'));
        }
        $result = $query->paginate();
        return $result;
    }

    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get a list of users with format id=>column
     * 
     * @param string $column column to get
     * @param array $params conditions
     * 
     * @return array list of users
     * 
     * @since XXX
     */
    public static function getLists($column, $params = array()) {
        $instance = new static;
        $query = $instance->newQuery();
        $users = $query->lists($column, 'id');
        return $users;
    }

    public function attachGroup($groups) {
        if ($groups !== '') {
            $groupsArr = explode(',', $groups);
            $this->groups()->sync($groupsArr);
        }
    }

    /**
     * get a list groups of user separate by comma
     * 
     * @return string list groups of user
     * 
     * @since XXX
     */
    public function getGroup() {
        $groups = array();
        foreach ($this->groups as $group) {
            array_push($groups, $group->name);
        }
        return implode(', ', $groups);
    }

}
