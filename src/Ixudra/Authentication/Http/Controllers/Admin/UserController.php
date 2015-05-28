<?php namespace Ixudra\Authentication\Http\Controllers\Admin;


use Ixudra\Core\Http\Controllers\BaseController;
use Ixudra\Authentication\Http\Requests\Admin\Users\FilterUserFormRequest;
use Ixudra\Authentication\Http\Requests\Admin\Users\CreateUserFormRequest;
use Ixudra\Authentication\Http\Requests\Admin\Users\UpdateUserFormRequest;
use Ixudra\Authentication\Repositories\Eloquent\EloquentUserRepository;
use Ixudra\Authentication\Services\Html\Admin\UserViewFactory;
use Ixudra\Authentication\Services\Factories\UserFactory;

use Translate;

class UserController extends BaseController {

    protected $userViewFactory;


    public function __construct(EloquentUserRepository $userRepository, UserViewFactory $userViewFactory)
    {
        $this->userRepository = $userRepository;
        $this->userViewFactory = $userViewFactory;
    }


    public function index()
    {
        return $this->userViewFactory->index();
    }

    public function filter(FilterUserFormRequest $request)
    {
        return $this->userViewFactory->index( $request->getInput() );
    }

    public function create()
    {
        return $this->userViewFactory->create();
    }

    public function store(CreateUserFormRequest $request, UserFactory $userFactory)
    {
        $user = $userFactory->make( $request->getInput() );

        return $this->redirect( 'admin.users.show', array('id' => $user->id), 'success', array( Translate::model( 'user.create.success' ) ) );
    }

    public function show($id)
    {
        $user = $this->userRepository->find( $id );
        if( is_null($user) ) {
            return $this->modelNotFound();
        }

        return $this->userViewFactory->show( $user );
    }

    public function edit($id)
    {
        $user = $this->userRepository->find( $id );
        if( is_null($user) ) {
            return $this->modelNotFound();
        }

        return $this->userViewFactory->edit( $user );
    }

    public function update($id, UpdateUserFormRequest $request, UserFactory $userFactory)
    {
        $user = $this->userRepository->find( $id );
        if( is_null($user) ) {
            return $this->modelNotFound();
        }

        $userFactory->modify( $user, $request->getInput() );

        return $this->redirect( 'admin.users.show', array('id' => $id), 'success', array( Translate::model( 'user.edit.success' ) ) );
    }

    public function destroy($id)
    {
        $user = $this->userRepository->find( $id );
        if( is_null($user) ) {
            return $this->modelNotFound();
        }

        $user->delete();

        return $this->redirect( 'admin.users.index', array(), 'success', array( Translate::model( 'user.delete.success' ) ) );
    }

    protected function modelNotFound()
    {
        return $this->redirect( 'admin.users.index', array(), 'error', array( Translate::model( 'user.error.notFound' ) ) );
    }

}
