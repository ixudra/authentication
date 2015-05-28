<?php namespace Ixudra\Authentication\Services\Factories;


use Ixudra\Authentication\Models\Role;

class RoleFactory {

    protected $permissionFactory;


    public function __construct(PermissionFactory $permissionFactory)
    {
        $this->permissionFactory = $permissionFactory;
    }


    public function make($input, $permissions = array())
    {
        $role = Role::create( $input );

        $this->permissionFactory->make( $role, $permissions );

        return $role;
    }

    public function modify($role, $input)
    {
        return $role->update( $input );
    }

}