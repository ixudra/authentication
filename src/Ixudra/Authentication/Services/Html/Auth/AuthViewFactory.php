<?php namespace Ixudra\Authentication\Services\Html\Auth;


use Ixudra\Core\Services\Html\BaseViewFactory;

class AuthViewFactory extends BaseViewFactory {

    public function login($input = null)
    {
        if( $input == null ) {
            $input = array(
                'email'             => '',
                'remember'          => true,
            );
        }

        $this->addParameter('input', $input);

        return $this->makeView('bootstrap.auth.login');
    }

    public function changeEmail($user, $input = null)
    {
        if( $input == null ) {
            $input = array(
                'email_old'         => $user->email,
                'email_new'         => '',
                'email_confirm'     => '',
                'password'          => ''
            );
        }

        $requiredFields = array(
            'email_old',
            'email_new',
            'email_confirm',
            'password'
        );

        $this->addParameter('user', $user);
        $this->addParameter('input', $input);
        $this->addParameter('requiredFields', $requiredFields);

        return $this->makeView('bootstrap.auth.changeEmail');
    }

}