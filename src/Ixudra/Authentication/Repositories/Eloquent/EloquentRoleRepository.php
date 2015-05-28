<?php namespace Ixudra\Authentication\Repositories\Eloquent;


use Ixudra\Core\Repositories\Eloquent\BaseEloquentRepository;
use Ixudra\Authentication\Models\Role;

class EloquentRoleRepository extends BaseEloquentRepository {

    protected function getModel()
    {
        return new Role;
    }

    protected function getTable()
    {
        return 'roles';
    }


    public function findByName($name)
    {
        return $this->findByFilter(
            array(
                'name'      => $name
            )
        )->first();
    }

    public function search($filters, $resultsPerPage = 25)
    {
        $results = $this->getModel();

        if( array_key_exists('query', $filters) && $filters[ 'query' ] != '' ) {
            $results = $results
                ->where('name', 'like', $filters[ 'query' ]);
        }

        return $this->paginated($filters, $resultsPerPage, $results);
    }

}
