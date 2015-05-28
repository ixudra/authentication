<?php namespace Ixudra\Authentication\Services\Html\Admin;


use Ixudra\Core\Services\Html\BaseViewFactory;

class AdminViewFactory extends BaseViewFactory {

    public function index()
    {
        return $this->makeView('bootstrap.admin.index');
    }

}