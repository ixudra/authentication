<?php namespace Ixudra\Authentication\Services\Html\Auth;


use Ixudra\Core\Services\Html\BaseViewFactory;

class PasswordViewFactory extends BaseViewFactory {

    public function changePassword($user)
    {
        $requiredFields = array(
            'password_old',
            'password_new',
            'password_confirm',
        );

        $this->addParameter('user', $user);
        $this->addParameter('requiredFields', $requiredFields);

        return $this->makeView('bootstrap.password.changePassword');
    }

    public function resetPassword($input = null)
    {
        if( $input == null ) {
            $input = array(
                'email'         => ''
            );
        }

        $requiredFields = array(
            'email',
        );

        $this->addParameter('input', $input);
        $this->addParameter('requiredFields', $requiredFields);

        return $this->makeView('bootstrap.password.resetPassword');
    }

}