<?php namespace Ixudra\Authentication\Services\Validation;


use Ixudra\Core\Services\Validation\BaseValidationHelper;
use Ixudra\Authentication\Models\User;

class UserValidationHelper extends BaseValidationHelper {

    public function getFilterValidationRules()
    {
        return array(
            'query'                 => '',
        );
    }

    public function getFormValidationRules($formName)
    {
        return User::getRules();
    }

}