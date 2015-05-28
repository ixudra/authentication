<?php namespace Ixudra\Authentication\Services\Form;


use Ixudra\Core\Services\Form\BaseFormHelper;
use Ixudra\Authentication\Repositories\Eloquent\EloquentUserRepository;

use App;

class UserFormHelper extends BaseFormHelper {

    protected $repository;


    public function __construct(EloquentUserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }


    public function getSuggestionsForAutoComplete($query)
    {
        $models = $this->repository->search( array( 'query' => $query ) );

        return $this->convertToAutoComplete( $models );
    }

    protected function convertToSelectList($includeNull, $models)
    {
        $results = array();
        if( $includeNull ) {
            $results[ 0 ] = '';
        }

        foreach( $models as $model ) {
            $results[ $model->id ] = $model->present()->fullName;
        }

        return $results;
    }

    protected function convertToAutoComplete($models)
    {
        $results = array();
        foreach( $models as $model ) {
            $results[] = array(
                'data'          => $model->id,
                'value'         => $model->present()->fullName
            );
        }

        return $results;
    }

}