<?php namespace Ixudra\Authentication\Services\Form;


use Ixudra\Core\Services\Form\BaseFormHelper;
use Ixudra\Authentication\Repositories\Eloquent\EloquentRoleRepository;

use App;

class RoleFormHelper extends BaseFormHelper {

    protected $repository;


    public function __construct(EloquentRoleRepository $roleRepository)
    {
        $this->repository = $roleRepository;
    }

}