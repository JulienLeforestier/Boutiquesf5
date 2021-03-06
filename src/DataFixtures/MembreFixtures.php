<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use Doctrine\Persistence\ObjectManager;

class MembreFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $admin = new Membre;
        $admin->setEmail("admin@gmail.com");
        $admin->setPassword(password_hash("admin", PASSWORD_DEFAULT));
        $admin->setNom("Admin");
        $admin->setPrenom("Fixture");
        $admin->setAdresse("42 rue du Truc");
        $admin->setCp("76000");
        $admin->setVille("Rouen");
        $admin->setTel("0601020304");
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);

        $this->createMany(20, "membre", function ($num) {
            $membre = new Membre;
            $membre->setEmail("membre$num@yopmail.com");
            $membre->setPassword(password_hash("membre$num", PASSWORD_DEFAULT));
            $membre->setNom($this->faker->lastName);
            $membre->setPrenom($this->faker->firstName);
            $membre->setAdresse($this->faker->address);
            $membre->setCp(substr($this->faker->postcode, 0, 5));
            $membre->setVille($this->faker->city, 0, 100);
            $membre->setRoles(["ROLE_USER"]);
            return $membre;
        });

        $manager->flush();
    }
}
