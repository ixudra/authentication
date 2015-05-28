<?php namespace Ixudra\Authentication\Http\Controllers\Auth;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Ixudra\Core\Http\Controllers\BaseController;
use Ixudra\Authentication\Http\Requests\Auth\LoginFormRequest;
use Ixudra\Authentication\Http\Requests\Auth\ChangeEmailFormRequest;
use Ixudra\Authentication\Services\Factories\UserFactory;
use Ixudra\Authentication\Services\Html\Auth\AuthViewFactory;

use App;
use Event;
use Translate;

class AuthController extends BaseController {

    protected $authViewFactory;


    public function __construct(Guard $auth, Registrar $registrar, AuthViewFactory $authViewFactory)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->authViewFactory = $authViewFactory;
    }


    public function showLogin()
    {
        if( $this->auth->check() ) {
            return $this->redirect('index', array(), 'error', array(Translate::recursive('authentication.login.alreadyLoggedIn')));
        }

        return $this->authViewFactory->login();
    }

    public function processLogin(LoginFormRequest $request)
    {
        if( $this->auth->attempt( $request->only('email', 'password'), $request->getInput()['remember'] ) ) {
            $redirect = 'index';
            if( $this->auth->user()->isAdmin() ) {
                $redirect = 'admin.index';
            }

            return $this->redirect($redirect, array(), 'success', array(Translate::recursive('authentication.login.success')));
        }

        return $this->redirect('login', array(), 'error', array(Translate::recursive('authentication.login.dataIncorrect')));
    }

    public function logout()
    {
        $this->auth->logout();

        return $this->redirect('index', array(), 'success', array(Translate::recursive('authentication.logout.success')));
    }

    public function showChangeEmail()
    {
        return $this->authViewFactory->changeEmail( $this->auth->user() );
    }

    public function processChangeEmail(ChangeEmailFormRequest $request)
    {
        $this->auth->user()->changeEmail( $request->getInput() );

        return $this->redirect('index', array(), 'success', array(Translate::recursive('authentication.changeEmail.success')));
    }

}
