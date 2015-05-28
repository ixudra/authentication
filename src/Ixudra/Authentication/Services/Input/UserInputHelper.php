<?php namespace Ixudra\Authentication\Services\Input;


use Ixudra\Core\Services\Input\BaseInputHelper;
use Ixudra\Authentication\Models\User;

class UserInputHelper extends BaseInputHelper {

    public function getDefaultInput($prefix = '')
    {
        return User::getDefaults();
    }

    public function getInputForSearch($input)
    {
        if( array_key_exists('query', $input) && $input[ 'query' ] != '' ) {
            $input[ 'query' ] = '%'. $input[ 'query' ] .'%';
        }

        return parent::getInputForSearch( $input );
    }

}