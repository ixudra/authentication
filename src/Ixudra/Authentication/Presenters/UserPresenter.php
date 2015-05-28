<?php namespace Ixudra\Authentication\Presenters;


use Ixudra\Core\Presenters\BasePresenter;

class UserPresenter extends BasePresenter implements CustomerPresenterInterface {

    public function fullName()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function segmentIcon()
    {
        return 'user';
    }

}