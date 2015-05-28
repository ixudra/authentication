<?php namespace Ixudra\Authentication\Services\Factories;


use Ixudra\Authentication\Acl\Interfaces\PermissionableInterface;
use Ixudra\Authentication\Models\Permission;

class PermissionFactory {

    public function make(PermissionableInterface $object, $data)
    {
        return Permission::create( $this->extractPermissionInput( $object, $data ) );
    }

    public function modify($permission, $data)
    {
        return $permission->update(
            array(
                'data'          => $data
            )
        );
    }

    protected function extractPermissionInput($object, $data)
    {
        return array(
            'permissionable_id'             => $object->id,
            'permissionable_type'           => get_class( $object ),
            'data'                          => json_encode( $data ),
        );
    }

}