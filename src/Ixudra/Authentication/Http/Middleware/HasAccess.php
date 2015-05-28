<?php namespace Ixudra\Authentication\Http\Middleware;


use Illuminate\Contracts\Auth\Guard;
use Ixudra\Core\Traits\RedirectableTrait;

use Closure;
use Translate;

class HasAccess {

    use RedirectableTrait;


    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $route = $request->route();

        $parameterNames = $route->parameterNames();
        if( !empty($parameterNames) ) {
            $id = $parameterNames[ 0 ];
            $index = array_search( $route->getParameter($id), $request->segments() );

            $resource = $request->segments()[ $index-1 ];
            if( !$this->auth->user()->hasAccess( substr( $resource, 0, -1 ), $route->getParameter($id) ) ) {
                return $this->redirect( 'index', array(), 'error', array(Translate::recursive('acl.error.accessDenied')) );
            }
        }

        return $next( $request );
    }

}
