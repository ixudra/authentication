<?php namespace Ixudra\Authentication\Services\Factories;


use Ixudra\Authentication\Models\User;

use Hash;
use Ixudra\Core\Services\Factories\BaseFactory;

class UserFactory extends BaseFactory {

    protected $permissionFactory;

    protected $roleFactory;


    public function __construct(PermissionFactory $permissionFactory, RoleFactory $roleFactory)
    {
        $this->permissionFactory = $permissionFactory;
        $this->roleFactory = $roleFactory;
    }


    public function make($input, $permissions = array())
    {
        $password = '';
        if( array_key_exists('password', $input) ) {
            $password = $input[ 'password' ];
        }
        $input[ 'password' ] = '';

        $user = User::create( $this->extractUserInput( $input ) );
        $user->resetPassword( $password );

        $this->permissionFactory->make( $user, $permissions );

        if( array_key_exists('roles', $input) ) {
            $user->roles()->sync( $input[ 'roles' ] );
        }

        return $user;
    }

    public function modify($user, $input)
    {
        if( array_key_exists('email', $input ) ) {
            unset( $input[ 'email' ] );
        }

        return $user->update( $input );
    }

    protected function extractUserInput($input)
    {
        return $this->extractInput( $input, User::getDefaults() );
    }

}