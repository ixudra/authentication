<?php namespace Ixudra\Authentication\Http\Middleware;


use Illuminate\Contracts\Auth\Guard;
use Ixudra\Core\Traits\RedirectableTrait;

use Closure;
use Redirect;

class HasPermission {

    use RedirectableTrait;


    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $route = $request->route();

        if( !$this->auth->user()->hasPermission( $this->getRoutePermissions( $route ) ) ) {
            return $this->redirect('index', array(), 'error', array(Translate::recursive('acl.error.notEnoughPermissions')));
        }

        return $next( $request );
    }

    protected function getRoutePermissions($route)
    {
        $permissions = array();
        if( array_key_exists( 'permissions', $route->getAction() ) ) {
            $permissions = $route->getAction()[ 'permissions' ];
        }

        return $permissions;
    }

}
