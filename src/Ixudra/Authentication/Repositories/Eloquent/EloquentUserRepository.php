<?php namespace Ixudra\Authentication\Repositories\Eloquent;


use Ixudra\Core\Repositories\Eloquent\BaseEloquentRepository;
use Ixudra\Authentication\Models\User;

class EloquentUserRepository extends BaseEloquentRepository {

    protected function getModel()
    {
        return new User;
    }

    protected function getTable()
    {
        return 'users';
    }


    public function findByEmail($email)
    {
        return $this->findByFilter(
            array(
                'email'     => $email
            )
        )->first();
    }

    public function search($filters, $resultsPerPage = 25)
    {
        $results = $this->getModel();

        if( array_key_exists('query', $filters) && $filters[ 'query' ] != '' ) {
            $results = $results
                ->where('first_name', 'like', $filters[ 'query' ])
                ->orWhere('last_name', 'like', $filters[ 'query' ]);
        }

        return $results
            ->select($this->getTable() .'.*')
            ->orderBy('last_name', 'asc')
            ->paginate($resultsPerPage)
            ->appends($filters)
            ->appends('size', $resultsPerPage);
    }

}
