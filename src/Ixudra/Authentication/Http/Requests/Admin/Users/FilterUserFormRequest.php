<?php namespace Ixudra\Authentication\Http\Requests\Admin\Users;


use Ixudra\Core\Http\Requests\BaseRequest;

use App;

class FilterUserFormRequest extends BaseRequest {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return App::make('\Ixudra\Authentication\Services\Validation\UserValidationHelper')
            ->getFilterValidationRules();
    }

}
