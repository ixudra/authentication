<?php namespace Ixudra\Authentication\Services\Html\Auth;


use Ixudra\Core\Services\Html\BaseViewFactory;

class AuthViewFactory extends BaseViewFactory {

    public function register($input = null)
    {
        if( $input == null ) {
            $input = array(
                'first_name'                    => '',
                'last_name'                     => '',
                'email'                         => '',
                'password'                      => '',
                'password_confirm'              => '',
                'terms'                         => false,
            );
        }

        $requiredFields = array(
            'first_name',
            'last_name',
            'email',
            'password',
            'password_confirm',
            'terms',
        );

        $this->addParameter('input', $input);
        $this->addParameter('requiredFields', $requiredFields);

        return $this->makeView('authentication::auth.register');
    }

}