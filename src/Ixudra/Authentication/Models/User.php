<?php namespace Ixudra\Authentication\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laracasts\Presenter\PresentableTrait;
use Ixudra\Authentication\Acl\Interfaces\PermissionableInterface;
use Ixudra\Authentication\Acl\Traits\AccessibleTrait;
use Ixudra\Authentication\Acl\Traits\PermissionableTrait;

use Hash;
use Session;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, PermissionableInterface  {

    use Authenticatable, CanResetPassword, PresentableTrait, PermissionableTrait, AccessibleTrait;


    protected $table = 'users';

    protected $fillable = array(
        'first_name',
        'last_name',
        'email',
        'password'
    );

    protected $guarded = array();

    protected $hidden = array(
        'password',
        'remember_token'
    );

    protected $translationKey = 'user';

    protected $aclKey = 'user';

    protected $presenter = '\Ixudra\Authentication\Presenters\UserPresenter';


    public function delete()
    {
        $this->permissions->delete();

        parent::delete();
    }


    public static function getRules()
    {
        return array(
            'first_name'            => 'required|max:64',
            'last_name'             => 'required|max:64',
            'email'                 => 'required|max:128|email',
        );
    }

    public static function getDefaults()
    {
        return array(
            'first_name'            => '',
            'last_name'             => '',
            'email'                 => '',
            'password'              => ''
        );
    }


    public function roles()
    {
        return $this->belongsToMany('\Ixudra\Authentication\Models\Role', 'user_roles', 'user_id', 'role_id');
    }

    public function permissions()
    {
        return $this->morphOne('\Ixudra\Authentication\Models\Permission', 'permissionable');
    }


    public function getPermissions()
    {
        $mergedPermissions = $this->permissionsToArray($this->permissions->data);
        foreach( $this->roles as $role ) {
            $mergedPermissions = $this->mergePermissions(
                $mergedPermissions,
                $this->permissionsToArray($role->permissions->data)
            );
        }

        return $mergedPermissions;
    }

    public function isAdmin()
    {
        if( $this->hasPermission('admin') ) {
            return true;
        }

        return false;
    }

    public function changeEmail($input)
    {
        $this->email = $input[ 'email_new' ];
        $this->save();
    }

    public function resetPassword($password = '')
    {
        if( $password == '' ) {
            $password = Str::random(10);
        }

        $this->password = Hash::make($password);
        $this->save();

        Session::flash('pwd', $password);

        return $password;
    }

}
