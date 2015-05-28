<?php namespace Ixudra\Authentication\Acl\Handlers;


use Ixudra\Authentication\Repositories\Eloquent\EloquentAssociationRepository;
use Ixudra\Authentication\Repositories\Eloquent\EloquentUserRepository;
use Ixudra\Authentication\Repositories\Eloquent\EloquentRoleRepository;

abstract class BaseAccessHandler {

    protected $userRepository;

    protected $roleRepository;


    public function __construct(EloquentUserRepository $userRepository, EloquentRoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }


    public function roleHasAccess($roleId, $targetId)
    {
        $role = $this->roleRepository->find( $roleId );
        if( $role->hasPermission( 'admin' ) ) {
            return true;
        }

        return false;
    }

}
