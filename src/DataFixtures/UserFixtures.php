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
        // Admin User
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword(
            $admin,
            'adminpass'
        ));
        $admin->setFirstName('Admin');
        $admin->setLastName('User');
        $manager->persist($admin);
        $this->addReference('admin-user', $admin); // Référence pour d'autres fixtures

        // Regular User
        $user1 = new User();
        $user1->setEmail('kaoutar.arare@example.com');
        // Les rôles sont gérés par le constructeur et getRoles() pour inclure ROLE_USER et PUBLIC_ACCESS par défaut
        // Si vous voulez explicitement ['ROLE_USER'] ici, décommentez :
        // $user1->setRoles(['ROLE_USER']); 
        $user1->setPassword($this->passwordHasher->hashPassword(
            $user1,
            'password123'
        ));
        $user1->setFirstName('Kaoutar');
        $user1->setLastName('Arare');
        $manager->persist($user1);
        $this->addReference('kaoutar-user', $user1);

        $user2 = new User();
        $user2->setEmail('mahalia.pires@example.com');
        $user2->setPassword($this->passwordHasher->hashPassword(
            $user2,
            'password123'
        ));
        $user2->setFirstName('Mahalia');
        $user2->setLastName('Pires');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('omar.aissi@example.com');
        $user3->setPassword($this->passwordHasher->hashPassword(
            $user3,
            'password123'
        ));
        $user3->setFirstName('Omar');
        $user3->setLastName('Aissi');
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail('aziz.makni@example.com');
        $user4->setPassword($this->passwordHasher->hashPassword(
            $user4,
            'password123'
        ));
        $user4->setFirstName('Aziz');
        $user4->setLastName('Makni');
        $manager->persist($user4);

        $manager->flush();
    }
} 