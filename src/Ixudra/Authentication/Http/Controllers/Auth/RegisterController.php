<?php namespace Ixudra\Authentication\Http\Controllers\Auth;


use Ixudra\Core\Http\Controllers\BaseController;
use Ixudra\Authentication\Events\UserRegisteredEvent;
use Ixudra\Authentication\Http\Requests\Auth\RegisterFormRequest;
use Ixudra\Authentication\Services\Factories\UserFactory;
use Ixudra\Authentication\Services\Html\Auth\RegisterViewFactory;

use App;
use Event;
use Translate;

class AuthController extends BaseController {

    protected $registerViewFactory;


    public function __construct(RegisterViewFactory $registerViewFactory)
    {
        $this->registerViewFactory = $registerViewFactory;
    }


    public function showRegister()
    {
        return $this->registerViewFactory->register();
    }

    public function processRegister(RegisterFormRequest $request, UserFactory $userFactory)
    {
        $user = $userFactory->make( $request->getInput() );
        Event::fire( new UserRegisteredEvent( $user ) );

        return $this->redirect('index', array(), 'success', array(Translate::recursive('authentication.register.success')));
    }

}
