<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('anthony@projet.fr');
        $user->setLastName('PROJET');
        $user->setFirstName('Anthony');
        $user->setPassword($this->encoder->encodePassword($user, 'projet'));
        $user->setRoles(['ROLE_USER']);

        $user1 = new User();
        $user1->setEmail('admin@projet.fr');
        $user1->setLastName('PROJET ADMIN');
        $user1->setFirstName('Christophe');
        $user1->setPassword($this->encoder->encodePassword($user1, 'projetadmin'));
        $user1->setRoles(['ROLE_ADMIN', 'ROLE_USER']);

        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();
    }
}
