<?php namespace Ixudra\Authentication\Http\Controllers\Auth;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Ixudra\Core\Http\Controllers\BaseController;
use Ixudra\Authentication\Events\PasswordUpdatedEvent;
use Ixudra\Authentication\Events\PasswordResetEvent;
use Ixudra\Authentication\Http\Requests\Auth\ChangePasswordFormRequest;
use Ixudra\Authentication\Http\Requests\Auth\ResetPasswordFormRequest;
use Ixudra\Authentication\Services\Html\Auth\PasswordViewFactory;

use App;
use Event;
use Translate;

class PasswordController extends BaseController {

    protected $passwordViewFactory;


    public function __construct(Guard $auth, Registrar $registrar, PasswordViewFactory $passwordViewFactory)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->passwordViewFactory = $passwordViewFactory;
    }


    public function showChangePassword()
    {
        return $this->passwordViewFactory->changePassword( $this->auth->user() );
    }

    public function processChangePassword(ChangePasswordFormRequest $request)
    {
        $this->auth->user()->resetPassword( $request->input( 'password_new' ) );
        Event::fire( new PasswordUpdatedEvent( $this->auth->user() ) );

        return $this->redirect('index', array(), 'success', array(Translate::recursive('authentication.changePassword.success')));
    }

    public function showResetPassword()
    {
        return $this->passwordViewFactory->resetPassword();
    }

    public function processResetPassword(ResetPasswordFormRequest $request)
    {
        $userRepository = App::make('\Ixudra\Authentication\Repositories\Eloquent\EloquentUserRepository');
        $user = $userRepository->findByEmail( $request->getInput()[ 'email' ] );

        $user->resetPassword();
        Event::fire( new PasswordResetEvent( $user ) );

        return $this->redirect('index', array(), 'success', array(Translate::recursive('authentication.resetPassword.success')));
    }

}
