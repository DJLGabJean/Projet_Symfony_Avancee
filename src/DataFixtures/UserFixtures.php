<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            ['email' => 'admin@example.com', 'firstname' => 'Martin', 'lastname' => 'Dubois', 'roles' => ['ROLE_ADMIN'], 'password' => 'admin123'],
            ['email' => 'manager@example.com', 'firstname' => 'Sophie', 'lastname' => 'Dupont',  'roles' => ['ROLE_MANAGER'], 'password' => 'manager123'],
            ['email' => 'user@example.com', 'firstname' => 'Thomas', 'lastname' => 'Lemoine', 'roles' => ['ROLE_USER'], 'password' => 'user123'],
            ['email' => 'user2@example.com', 'firstname' => 'Julie', 'lastname' => 'Lefevre', 'roles' => ['ROLE_USER'], 'password' => 'user456'],
        ];

        foreach ($usersData as $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setRoles($data['roles']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
