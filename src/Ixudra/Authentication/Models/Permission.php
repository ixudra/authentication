<?php namespace Ixudra\Authentication\Models;


use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Permission extends Model {

    use PresentableTrait;


    protected $table = 'permissions';

    protected $fillable = array( 'permissionable_id', 'permissionable_type', 'data' );

    protected $guarded = array();

    protected $presenter = '\Ixudra\Authentication\Presenters\PermissionPresenter';


    public function permissionable()
    {
        return $this->morphTo();
    }


    public static function getDefaults()
    {
        return array(
            'data'              => ''
        );
    }

}
