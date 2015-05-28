<?php namespace Ixudra\Authentication\Http\Controllers\Admin;


use Ixudra\Core\Http\Controllers\BaseController;
use Ixudra\Authentication\Services\Html\Admin\AdminViewFactory;

class AdminController extends BaseController {

    protected $adminViewFactory;


    public function __construct(AdminViewFactory $adminViewFactory)
    {
        $this->adminViewFactory = $adminViewFactory;
    }


    public function index()
    {
        return $this->adminViewFactory->index();
    }

}
