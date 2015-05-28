<?php namespace Ixudra\Authentication\Acl\Traits;


trait PermissionableTrait {

    public function hasPermission($action)
    {
        $permissions = $this->getPermissions();

        return( array_key_exists( $action, $permissions ) && $permissions[ $action ] === true );
    }

    public function permissionsToArray($permissions)
    {
        $permissionArray = json_decode($permissions, true);
        $results = array();

        foreach( $permissionArray as $value ) {
            if( !array_key_exists($value, $results ) ) {
                $results[ $value ] = true;
            }
        }

        return $results;
    }

    public function mergePermissions($current, $new)
    {
        foreach( $new as $key => $value ) {
            if( !array_key_exists($key, $current ) ) {
                $current[ $key ] = true;
            }
        }

        return $current;
    }

}