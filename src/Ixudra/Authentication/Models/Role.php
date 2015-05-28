<?php namespace Ixudra\Authentication\Models;


use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Ixudra\Authentication\Acl\Traits\PermissionableTrait;
use Ixudra\Authentication\Acl\Traits\AccessibleTrait;
use Ixudra\Authentication\Acl\Interfaces\PermissionableInterface;

class Role extends Model implements PermissionableInterface {

    use PresentableTrait, PermissionableTrait, AccessibleTrait;


    protected $table = 'roles';

    protected $fillable = array( 'name' );

    protected $guarded = array();

    protected $hidden = array();

    protected $translationKey = 'role';

    protected $aclKey = 'role';

    protected $presenter = '\Ixudra\Authentication\Presenters\RolePresenter';


    public function users()
    {
        return $this->belongsToMany('\Ixudra\Authentication\Models\User', 'user_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->morphOne('\Ixudra\Authentication\Models\Permission', 'permissionable');
    }


    public function delete()
    {
        $this->permissions->delete();

        parent::delete();
    }


    public static function getRules()
    {
        return array(
            'name'                  => 'required|max:64'
        );
    }

    public static function getDefaults()
    {
        return array(
            'name'                  => '',
        );
    }

    public function getPermissions()
    {
        return $this->permissionsToArray( $this->permissions->data );
    }

}
