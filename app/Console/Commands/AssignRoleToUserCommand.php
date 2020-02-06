<?php

namespace App\Console\Commands;

use Digichange\Entities\Role;
use Digichange\Entities\User;
use Digichange\Repositories\PersistRepository;
use Digichange\Repositories\RoleRepository;
use Digichange\Repositories\UserRepository;
use Illuminate\Console\Command;

class AssignRoleToUserCommand extends Command
{
    protected $signature = 'blog:assign:role:to:user
                                {email : The user\'s email}
                                {role : The role\'s slug.}';

    protected $description = 'Assign role to user';

    public function handle(PersistRepository $persistRepository, UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        /** @var User $user */
        $user = $userRepository->getOneBy(['email' => $email]);

        /** @var Role $role */
        $role = $roleRepository->getOneBy(['slug' => $role]);

        $user->setRole($role);

        $persistRepository->save($user);

        $this->info('Role ' . $role->getSlug() . ' assign to user ' . $user->getEmail() . ' created successfully');
    }
}
