<?php namespace Ixudra\Authentication\Acl\Traits;


use App;
use Config;

trait AccessibleTrait {

    public function hasAccess($targetKey, $targetId)
    {
        $rules = Config::get('acl.access');
        if( array_key_exists( $this->aclKey, $rules ) && array_key_exists($targetKey, $rules[ $this->aclKey ] ) ) {
            return $this->checkCustomAccessHandler( $this->aclKey, $this->id, $targetKey, $targetId );
        }

        return $this->checkDefaultAccessHandler( $this->aclKey, $this->id, $targetKey, $targetId );
    }

    protected function checkDefaultAccessHandler($sourceKey, $sourceId, $targetKey, $targetId)
    {
        return $this->check( '\Ixudra\Authentication\Acl\Handlers\\'. ucfirst($targetKey .'AccessHandler'), $sourceKey .'HasAccess', $sourceId, $targetId );
    }

    protected function checkCustomAccessHandler($sourceKey, $sourceId, $targetKey, $targetId)
    {
        $matches = explode( '@', Config::get('acl.access')[ $sourceKey ][ $targetKey ] );

        return $this->check( $matches[ 0 ], $matches[ 1 ], $sourceId, $targetId );
    }

    protected function check($handler, $method, $sourceId, $targetId)
    {
        try {
            $accessHandler = App::make( $handler );
            if( !is_null($accessHandler) && is_callable(array($accessHandler, $method)) ) {
                return $accessHandler->{$method}( $sourceId, $targetId );
            }
        } catch(\Exception $e) {

        }

        return false;
    }

}