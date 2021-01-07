<?php
/**
 * Country Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Country;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $france = new Country();
        $france->setId("fr");
        $france->setName("france");
        $manager->persist($france);
        $this->addReference("iso_fr", $france);

        $italie = new Country();
        $italie->setId("it");
        $italie->setName("italie");
        $manager->persist($italie);

        $manager->flush();
    }
}
