<?php namespace Ixudra\Authentication\Services\Html\Admin;


use App;

use Ixudra\Core\Services\Html\BaseViewFactory;
use Ixudra\Authentication\Models\User;

class UserViewFactory extends BaseViewFactory {

    public function index($input = array())
    {
        if( empty($input) ) {
            $input = array(
                'query'             => ''
            );
        }

        return $this->prepareFilter( 'authentication::admin.users.index', $input );
    }

    public function create($input = null)
    {
        if( $input == null ) {
            $input = App::make('\Ixudra\Authentication\Services\Input\UserInputHelper')->getDefaultInput();
        }

        return $this->prepareForm( 'authentication::admin.users.create', 'create', $input );
    }

    public function show(User $user)
    {
        $this->addParameter('user', $user);

        return $this->makeView( 'authentication::admin.users.show' );
    }

    public function edit(User $user, $input = null)
    {
        if( $input == null ) {
            $input = App::make('\Ixudra\Authentication\Services\Input\UserInputHelper')->getInputForModel( $user );
        }

        $this->addParameter('user', $user);

        return $this->prepareForm( 'authentication::admin.users.edit', 'update', $input );
    }


    protected function prepareFilter($template, $input)
    {
        $searchInput = App::make('\Ixudra\Authentication\Services\Input\UserInputHelper')->getInputForSearch( $input );
        $users = App::make('\Ixudra\Authentication\Repositories\Eloquent\EloquentUserRepository')->search( $searchInput );

        $this->addParameter('users', $users);
        $this->addParameter('input', $input);

        return $this->makeView( $template );
    }

    protected function prepareForm($template, $formName, $input)
    {
        $requiredFields = App::make('\Ixudra\Authentication\Services\Validation\UserValidationHelper')->getRequiredFormFields( $formName );

        $this->addParameter('input', $input);
        $this->addParameter('requiredFields', $requiredFields);

        return $this->makeView( $template );
    }

}
