<?php


use Illuminate\Database\Seeder;
use Ixudra\Authentication\Services\Factories\RoleFactory;

class RoleTableSeeder extends Seeder {

    protected $roleFactory;


    public function __construct(RoleFactory $roleFactory)
    {
        $this->roleFactory = $roleFactory;
    }


    public function run()
    {
        $this->roleFactory->make(
            array(
                'name'              => 'admin',
            ),
            array( 'admin' )
        );
    }

}
