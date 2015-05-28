<?php namespace Ixudra\Authentication\Http\Requests\Admin\Roles;


use Ixudra\Core\Http\Requests\BaseRequest;

use App;

class UpdateRoleFormRequest extends BaseRequest {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return App::make('\Ixudra\Authentication\Services\Validation\RoleValidationHelper')
            ->getFormValidationRules( 'update' );
    }

}
