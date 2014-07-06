<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AdminUser extends BaseModel implements UserInterface, RemindableInterface {
    /**
     * Table name
     */
    protected $table = 'admins';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Security fillable
     */
    public $fillable = array(
        'email',
        'full_name',
        'password',
        'password_confirmation',
        'is_subadmin',
    );
    public static $rules = array(
        'full_name' => 'required',
        'email' => 'required|email|unique:admins',
        'password' => 'required|min:6',
        'password_confirmation' => 'same:password',
    );
    public static $customMessages = array(
        'required' => 'Không được để trống',
        'email' => 'Phải nhập đúng định dạng email',
        'email.unique' => 'Email này đã tồn tại, vui lòng nhập email khác',
        'min' => 'Tối thiểu 6 ký tự',
        'same' => 'Mật khẩu phải giống nhau',
    );

    public function beforeSave() {
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

    public static function paging($params) {
        $instance = new static;
        $query = $instance->newQuery();
        if (isset($params['keyword'])) {
            $query->searchLike($params['keyword'], 'full_name');
        }
        $result = $query->paginate();
        return $result;
    }

    public function getRule() {
        if ($this->is_subadmin) {
            return 'Quản lý thành viên';
        } else {
            return 'Quản trị trang web';
        }
    }

}
