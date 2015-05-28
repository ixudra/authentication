<?php namespace Ixudra\Authentication\Http\Middleware;


use Illuminate\Contracts\Auth\Guard;
use Ixudra\Core\Traits\RedirectableTrait;

use Auth;
use Closure;
use Redirect;
use Translate;

class IsAdmin {

    use RedirectableTrait;


    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        if( is_null($this->auth->user()) || !$this->auth->user()->isAdmin() ) {
            return $this->redirect('index', array(), 'error', array(Translate::recursive('acl.error.adminRequired')));
        }

        return $next( $request );
    }

}
