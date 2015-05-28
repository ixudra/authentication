<?php namespace Ixudra\Authentication\Services\Html\Admin;


use Ixudra\Core\Services\Html\BaseViewFactory;
use Ixudra\Authentication\Models\Role;

use App;

class RoleViewFactory extends BaseViewFactory {

    public function index($input = array())
    {
        if( empty($input) ) {
            $input = array(
                'query'         => ''
            );
        }

        return $this->prepareFilter( 'authentication::admin.roles.index', $input );
    }

    public function create($input = null)
    {
        if( $input == null ) {
            $input = App::make('\Ixudra\Authentication\Services\Input\RoleInputHelper')->getDefaultInput();
        }

        return $this->prepareForm( 'authentication::admin.roles.create', 'create', $input );
    }

    public function show(Role $role)
    {
        $this->addParameter('role', $role);

        return $this->makeView( 'authentication::admin.roles.show' );
    }

    public function edit(Role $role, $input = null)
    {
        if( $input == null ) {
            $input = App::make('\Ixudra\Authentication\Services\Input\RoleInputHelper')->getInputForModel( $role );
        }

        $this->addParameter('role', $role);

        return $this->prepareForm( 'authentication::admin.roles.edit', 'update', $input );
    }


    protected function prepareFilter($template, $input)
    {
        $searchInput = App::make('\Ixudra\Authentication\Services\Input\RoleInputHelper')->getInputForSearch( $input );
        $roles = App::make('\Ixudra\Authentication\Repositories\Eloquent\EloquentRoleRepository')->search( $searchInput );

        $this->addParameter('roles', $roles);
        $this->addParameter('input', $input);

        return $this->makeView( $template );
    }

    protected function prepareForm($template, $formName, $input)
    {
        $requiredFields = App::make('\Ixudra\Authentication\Services\Validation\RoleValidationHelper')->getRequiredFormFields( $formName );

        $this->addParameter('input', $input);
        $this->addParameter('requiredFields', $requiredFields);

        return $this->makeView( $template );
    }

}
