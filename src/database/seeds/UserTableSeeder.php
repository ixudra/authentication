<?php


use Illuminate\Database\Seeder;
use Ixudra\Authentication\Services\Factories\UserFactory;
use Ixudra\Authentication\Repositories\Eloquent\EloquentRoleRepository;

class UserTableSeeder extends Seeder {

    protected $userFactory;

    protected $roleRepository;


    public function __construct(UserFactory $userFactory, EloquentRoleRepository $roleRepository)
    {
        $this->userFactory = $userFactory;
        $this->roleRepository = $roleRepository;
    }


    public function run()
    {
        DB::table('users')->truncate();
        $adminRole = $this->roleRepository->findByName( 'admin' );

        $user1 = $this->userFactory->make(
            array(
                'first_name'            => 'Jan',
                'last_name'             => 'Oris',
                'email'                 => 'jan.oris@gmail.com',
                'password'              => 'FooBar',
                'roles'                 => array( $adminRole->id ),
            )
        );

        $user2 = $this->userFactory->make(
            array(
                'first_name'            => 'Jan',
                'last_name'             => 'Lenaerts',
                'email'                 => 'hello@janlenaerts.be',
                'password'              => 'FooBar',
                'roles'                 => array( $adminRole->id ),
            )
        );

        $user3 = $this->userFactory->make(
            array(
                'first_name'            => 'Steven',
                'last_name'             => 'Reekmans',
                'email'                 => 'steven.rkm@gmail.com',
                'password'              => 'FooBar',
                'roles'                 => array( $adminRole->id ),
            )
        );

        $user2 = $this->userFactory->make(
            array(
                'first_name'            => 'Marieke',
                'last_name'             => 'Stinckens',
                'email'                 => 'marieke.stinckens@gmail.com',
                'password'              => 'FooBar'
            )
        );
    }

}
